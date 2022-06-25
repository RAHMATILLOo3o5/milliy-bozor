<?php

namespace frontend\models;

use common\models\Province;
use common\models\Tumanlar;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "offer".
 *
 * @property int $id
 * @property string|null $title_uz
 * @property string|null $title_ru
 * @property string|null $content_uz
 * @property string|null $content_ru
 * @property string|null $img
 * @property int|null $price
 * @property int|null $sale
 * @property string $owner
 * @property string $phone
 * @property int $province_id
 * @property int $tuman_id
 * @property string $email
 * @property int|null $status
 *
 * @property Province $province
 * @property Tumanlar $tuman
 *
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offer';
    }

    public function behaviors()
    {
        return [
            'class'=>TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content_' . Yii::$app->language], 'string'],
            [['price', 'sale', 'province_id', 'tuman_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['owner', 'phone', 'province_id', 'tuman_id', 'email'], 'required'],
            [['title_' . Yii::$app->language], 'string', 'max' => 250],
            ['img', 'file', 'extensions' => ['jpg', 'png', 'jpeg']],
            [['owner', 'email'], 'string', 'max' => 240],
            [['phone'], 'string', 'max' => 120],
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
            'price' => Yii::t('app', 'Price'),
            'sale' => Yii::t('app', 'Sale'),
            'owner' => Yii::t('app', 'Owner'),
            'phone' => Yii::t('app', 'Phone'),
            'province_id' => Yii::t('app', 'Province ID'),
            'tuman_id' => Yii::t('app', 'Tuman ID'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
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
}
