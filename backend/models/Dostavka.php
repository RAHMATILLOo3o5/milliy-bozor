<?php

namespace backend\models;

use Yii;
use yii\helpers\StringHelper;


/**
 * This is the model class for table "dostavka".
 *
 * @property int $id
 * @property string $title_uz
 * @property string $title_ru
 * @property string $description_uz
 * @property string $description_ru
 * @property int|null $status
 */
class Dostavka extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dostavka';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_uz', 'title_ru', 'description_uz', 'description_ru'], 'required'],
            [['description_uz', 'description_ru'], 'string'],
            [['status'], 'integer'],
            [['title_uz', 'title_ru'], 'string', 'max' => 255],
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
            'status' => Yii::t('app', 'Holati'),
        ];
    }

    public function getStatusLabel()
    {
        return $this->status == 1 ? '<span class="badge badge-success">Faol</span>' : '<span class="badge badge-danger">Nofaol</span>';
    }

    public function getShortText()
    {
        return StringHelper::truncateWords($this->description_uz, 3);
    }
    public function getShortTextru()
    {
        return StringHelper::truncateWords($this->description_ru, 3);
    }

    /**
     * {@inheritdoc}
     * @return \backend\models\search\DostavkaQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new \backend\models\search\DostavkaQuery(get_called_class());
    // }
}
