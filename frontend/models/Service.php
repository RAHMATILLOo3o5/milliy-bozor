<?php

namespace frontend\models;

use Yii;
use common\models\Province;
use common\models\Tumanlar;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string|null $title_uz
 * @property string|null $title_ru
 * @property string|null $content_uz
 * @property string|null $content_ru
 * @property string|null $img
 * @property string|null $phone
 * @property int|null $province_id
 * @property int|null $tuman_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Province $province
 * @property Tumanlar $tuman
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content_'.Yii::$app->language], 'string'],
            [['province_id', 'tuman_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title_'.Yii::$app->language, 'img', 'phone'], 'string', 'max' => 255],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::class, 'targetAttribute' => ['province_id' => 'id']],
            [['tuman_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tumanlar::class, 'targetAttribute' => ['tuman_id' => 'id']],
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
            'content_uz' => Yii::t('app', 'Content Uz'),
            'content_ru' => Yii::t('app', 'Content Ru'),
            'img' => Yii::t('app', 'Img'),
            'phone' => Yii::t('app', 'Phone'),
            'province_id' => Yii::t('app', 'Province ID'),
            'tuman_id' => Yii::t('app', 'Tuman ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery|\frontend\models\search\ProvinceQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::class, ['id' => 'province_id']);
    }

    /**
     * Gets query for [[Tuman]].
     *
     * @return \yii\db\ActiveQuery|\frontend\models\search\TumanlarQuery
     */
    public function getTuman()
    {
        return $this->hasOne(Tumanlar::class, ['id' => 'tuman_id']);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\search\ServiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\search\ServiceQuery(get_called_class());
    }
}
