<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $job
 * @property string $body
 * @property int|null $status
 * @property int|null $user_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $user
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'job', 'body'], 'required'],
            [['body'], 'string'],
            [['status', 'user_id', 'created_at', 'updated_at', 'read'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['job'], 'string', 'max' => 220],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Ism'),
            'job' => Yii::t('app', 'Kasb'),
            'body' => Yii::t('app', 'Fikr'),
            'status' => Yii::t('app', 'Holati'),
            'read' => Yii::t('app', 'O\'qilgan / O\'qilmagan'),
            'user_id' => Yii::t('app', 'Foydalanuvchi'),
            'created_at' => Yii::t('app', 'Yozilgan vaqt'),
            'updated_at' => Yii::t('app', 'Yangilangan vaqt'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function getStatusLabel()
    {
        if ($this->read == 1) {
            return "<span class='badge badge-success'>O'qilgan</span>";
        }
        return "<span class='badge badge-danger'>O'qilmagan</span>";
    }
    public function getHolat()
    {
        if ($this->status == 1) {
            return "<span class='badge badge-success'>Faol</span>";
        }
        return "<span class='badge badge-danger'>Nofaol</span>";
    }

    public function getShortText(){
        return StringHelper::truncateWords($this->body, 6);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\search\ContactQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new \common\models\search\ContactQuery(get_called_class());
    // }
}
