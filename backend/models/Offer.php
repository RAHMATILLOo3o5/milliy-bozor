<?php

namespace backend\models;

use common\models\Province;
use common\models\Tumanlar;
use Yii;
use yii\web\UploadedFile;

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
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content_uz', 'content_ru'], 'string'],
            [['price', 'sale', 'province_id', 'tuman_id', 'status'], 'integer'],
            [['owner', 'phone', 'province_id', 'tuman_id', 'email'], 'required'],
            [['title_uz', 'title_ru'], 'string', 'max' => 250],
            ['img', 'file', 'extensions'=>['jpg', 'jpeg', 'png']],
            [['owner', 'email'], 'string', 'max' => 240],
            [['phone'], 'string', 'max' => 120],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['tuman_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tumanlar::className(), 'targetAttribute' => ['tuman_id' => 'id']],
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
            'content_uz' => Yii::t('app', 'Tavsif Uz'),
            'content_ru' => Yii::t('app', 'Tavsif Ru'),
            'img' => Yii::t('app', 'Rasm'),
            'price' => Yii::t('app', 'Chegirmali narxi'),
            'sale' => Yii::t('app', 'Asl narxi'),
            'owner' => Yii::t('app', 'Egasi'),
            'phone' => Yii::t('app', 'Telefon'),
            'province_id' => Yii::t('app', 'Viloyat'),
            'tuman_id' => Yii::t('app', 'Tuman'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Holat'),
        ];
    }

    /**
     * @param $model
     * @return bool
     */
    public function saved($model){
        $this->img = UploadedFile::getInstance($model, 'img');
        if ($this->img){
            $this->img->saveAs(Yii::getAlias('@saveimg') . '/' . time() . "." . $this->img->extension, true);
            $this->img = time() . "." . $this->img->extension;
        } else {
            $this->img = '02.png';
        }
        return $this->save();
    }

    /**
     * @param $model
     * @return bool|int
     * @throws \yii\db\StaleObjectException
     */
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
     * Gets query for [[Tuman]].
     *
     * @return \yii\db\ActiveQuery|\backend\models\search\TumanlarQuery
     */
    public function getTuman()
    {
        return $this->hasOne(Tumanlar::className(), ['id' => 'tuman_id']);
    }

}
