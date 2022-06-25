<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tumanlar".
 *
 * @property int $id
 * @property string $name
 * @property int|null $province_id
 *
 * @property Province $province
 * @property Userdata[] $userdatas
 */
class Tumanlar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tumanlar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['province_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'province_id' => Yii::t('app', 'Province ID'),
        ];
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\ProvinceQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }

    /**
     * Gets query for [[Userdatas]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\UserdataQuery
     */
    public function getUserdatas()
    {
        return $this->hasMany(Userdata::className(), ['tuman_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\search\TumanlarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\search\TumanlarQuery(get_called_class());
    }
}
