<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int|null $section_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Product[] $products
 * @property Section $section
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
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
            [['section_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::class, 'targetAttribute' => ['section_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
            'section_id' => 'Bo\'limi',
            'status' => 'Holati',
            'created_at' => 'Yaratilgan vaqti',
            'updated_at' => 'Yangilangan vaqti',
        ];
    }
    public function getStatusLabel()
    {
        if ($this->status == 1) {
            return "<span class='badge badge-success'>Faol</span>";
        }
        return "<span class='badge badge-danger'>Nofaol</span>";
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\search\ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * Gets query for [[Section]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\search\SectionQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::class, ['id' => 'section_id']);
    }

    /**
     * {@inheritdoc}
     * @return \backend\models\search\CategoryQuery the active query used by this AR class.
     */
//    public static function find()
//    {
//        return new \backend\models\search\CategoryQuery(get_called_class());
//    }
}
