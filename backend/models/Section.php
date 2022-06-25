<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "section".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property string|null $img
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Category[] $categories
 * @property Product[] $products
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 240],
            [['img'], 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uz' => 'Nomi Uz',
            'name_ru' => 'Nomi Ru',
            'img' => 'Rasm',
            'status' => 'Holati',
            'created_at' => 'Yaratildi',
            'updated_at' => 'Yangilandi',
        ];
    }

    public function getStatusLabel()
    {
        if ($this->status == 1) {
            return "<span class='badge badge-success'>Faol</span>";
        }
        return "<span class='badge badge-danger'>Nofaol</span>";
    }

    public function saved($model)
    {
        $this->img = UploadedFile::getInstance($model, 'img');
        if (!empty($this->img)) {
            $this->img->saveAs(Yii::getAlias('@saveimg') . '/' . time() . "." . $this->img->extension, true);
            $this->img = time() . "." . $this->img->extension;
        } else {
            $this->img = '02.png';
        }
        return $this->save();
    }

    public function updated($model)
    {
        $this->img = UploadedFile::getInstance($model, 'img');
        if (!empty($this->img)) {
            if ($this->getOldAttribute('img') == '02.png') {
                $this->img->saveAs(Yii::getAlias('@saveimg') . '/' . time() . "." . $this->img->extension, true);
                $this->img = time() . "." . $this->img->extension;
                return $this->save();
            } else {
                unlink(Yii::getAlias('@saveimg') . '/' . $this->getOldAttribute('img'));
                $this->img->saveAs(Yii::getAlias('@saveimg') . '/' . time() . "." . $this->img->extension, true);
                $this->img = time() . "." . $this->img->extension;
                return $this->save();
            }

        } else {
            $this->img = $this->getOldAttribute('img');
            return $this->update();
        }
    }

    public function getImgs()
    {
        return '<img src="' . Yii::getAlias('@getimg') . "/" . $this->img . '" class="img-fluid w-25">';
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\search\CategoryQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['section_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\search\ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['section_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \backend\models\search\SectionQuery the active query used by this AR class.
     */
//    public static function find()
//    {
//        return new \backend\models\search\SectionQuery(get_called_class());
//    }
}
