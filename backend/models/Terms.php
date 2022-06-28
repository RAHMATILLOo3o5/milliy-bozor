<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "terms".
 *
 * @property int $id
 * @property string $content_uz
 * @property string $content_ru
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Terms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'terms';
    }
    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::class
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content_uz', 'content_ru'], 'required'],
            [['content_uz', 'content_ru'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'content_uz' => Yii::t('app', 'Matn Uz'),
            'content_ru' => Yii::t('app', 'matn Ru'),
            'created_at' => Yii::t('app', 'Yaratildi At'),
            'updated_at' => Yii::t('app', 'Yangilandi At'),
        ];
    }
}
