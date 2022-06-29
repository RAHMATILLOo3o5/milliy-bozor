<?php

namespace frontend\models;

use Yii;

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
            [['title_' . Yii::$app->language, 'description_' . Yii::$app->language], 'required'],
            [['description_' . Yii::$app->language], 'string'],
            [['status'], 'integer'],
            [['title_' . Yii::$app->language], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title_uz' => Yii::t('app', 'Title Uz'),
            'title_ru' => Yii::t('app', 'Title Ru'),
            'description_uz' => Yii::t('app', 'Description Uz'),
            'description_ru' => Yii::t('app', 'Description Ru'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\search\DostavkaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\search\DostavkaQuery(get_called_class());
    }
}
