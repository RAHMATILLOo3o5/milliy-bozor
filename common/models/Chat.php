<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property int|null $from
 * @property int|null $to
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $from0
 * @property Message[] $messages
 * @property User $to0
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
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
            [['from', 'to', 'created_at', 'updated_at'], 'integer'],
            [['from'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['from' => 'id']],
            [['to'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['to' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function saved()
    {
        $this->save();
        return $this->id;
    }

    /**
     * Gets query for [[From0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrom0()
    {
        return $this->hasOne(User::class, ['id' => 'from']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::class, ['chat_id' => 'id']);
    }

    /**
     * Gets query for [[To0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTo0()
    {
        return $this->hasOne(User::class, ['id' => 'to']);
    }
}
