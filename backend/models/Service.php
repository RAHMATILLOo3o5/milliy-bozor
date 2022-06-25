<?php

namespace backend\models;

use common\models\Province;
use common\models\Tumanlar;
use Yii;
use yii\behaviors\TimestampBehavior;

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
 * @property ServiceComent[] $serviceComents
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
     * @return \string[][]
     */
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
            [['province_id', 'tuman_id','phone', 'title_uz', 'title_ru',], 'required'],
            [['content_uz', 'content_ru'], 'string'],
            [['province_id', 'tuman_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title_uz', 'title_ru', 'phone'], 'string', 'max' => 255],
            ['img', 'file', 'extensions' => ['jpg', 'jpeg', 'png']],
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
            'title_uz' => Yii::t('app', 'Sarlavha | Uz'),
            'title_ru' => Yii::t('app', 'Sarlavha | Ru'),
            'content_uz' => Yii::t('app', 'Mazmun | Uz'),
            'content_ru' => Yii::t('app', 'Mazmun | Ru'),
            'img' => Yii::t('app', 'Rasm'),
            'phone' => Yii::t('app', 'Phone'),
            'province_id' => Yii::t('app', 'Viloyat'),
            'tuman_id' => Yii::t('app', 'Tuman'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Yaratilgan vaqt'),
            'updated_at' => Yii::t('app', 'Yangilangan vaqt'),
        ];
    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        return $this->status == 1 ? '<span class="badge badge-success">Faol</span>' : '<span class="badge badge-danger">Nofaol</span>';
    }

    /**
     * @return string
     */
    public function getImgs()
    {
        return '<img src="' . Yii::getAlias('@getimg') . "/" . $this->img . '" class="img-fluid w-25">';
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\search\ProvinceQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }

    /**
     * Gets query for [[ServiceComents]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\search\ServiceComentQuery
     */
    public function getServiceComents()
    {
        return $this->hasMany(ServiceComent::className(), ['service_id' => 'id']);
    }

    /**
     * Gets query for [[Tuman]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\search\TumanlarQuery
     */
    public function getTuman()
    {
        return $this->hasOne(Tumanlar::className(), ['id' => 'tuman_id']);
    }

}
