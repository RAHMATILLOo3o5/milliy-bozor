<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string|null $title_uz
 * @property string|null $title_ru
 * @property string|null $description_uz
 * @property string|null $description_ru
 * @property string|null $price
 * @property string|null $currency
 * @property string|null $image
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_uz', 'title_ru', 'description_uz', 'description_ru', 'price', 'currency'], 'required'],
            [['description_uz', 'description_ru'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['title_uz', 'title_ru', 'price', 'currency'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title_uz' => Yii::t('app', 'Sarlavha Uz'),
            'title_ru' => Yii::t('app', 'Sarlavha Ru'),
            'description_uz' => Yii::t('app', 'Tavsif Uz'),
            'description_ru' => Yii::t('app', 'Tavsif Ru'),
            'price' => Yii::t('app', 'Narxi'),
            'currency' => Yii::t('app', 'Pul birligi'),
            'image' => Yii::t('app', 'Rasm'),
            'status' => Yii::t('app', 'Holat'),
            'created_at' => Yii::t('app', 'Yaratildi'),
            'updated_at' => Yii::t('app', 'Yangilandi'),
        ];
    }

    /**
     * @param $model
     * @return bool
     */
    public function saved($model)
    {
        $this->image = UploadedFile::getInstance($model, 'image');
        if ($this->image) {
            $this->image->saveAs(Yii::getAlias('@saveimg') . '/' . time() . '.' . $this->image->extension);
            $this->image = time() . '.' . $this->image->extension;
        }
        return $this->save();
    }
    public function updated($model)
    {
        $this->image = UploadedFile::getInstance($model, 'image');
        if (!empty($this->image)) {
                unlink(Yii::getAlias('@saveimg') . '/' . $this->getOldAttribute('image'));
                $this->image->saveAs(Yii::getAlias('@saveimg') . '/' . time() . "." . $this->image->extension, true);
                $this->image = time() . "." . $this->image->extension;
                return $this->save();
        } else {
            $this->image = $this->getOldAttribute('image');
            return $this->update();
        }
    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        if ($this->status == 1) {
            return "<span class='badge badge-success'>Faol</span>";
        }
        return "<span class='badge badge-danger'>Nofaol</span>";
    }
    /**
     * @return string|null
     */
    public function getShortDescription_uz(){
        if (strlen($this->description_uz) > 80) {
            return substr($this->description_uz, 0, 80) . '...';
        } else {
            return $this->description_uz;
        }
    }

    /**
     * @return string|null
     */
    public function getShortDescription_ru(){
        if (strlen($this->description_ru) > 80) {
            return substr($this->description_ru, 0, 80) . '...';
        } else {
            return $this->description_ru;
        }
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return Yii::getAlias('@getimg') . '/' . $this->image;
    }

}
