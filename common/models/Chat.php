<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

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

    public function getMessage()
    {
        return end($this->messages);
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

    public function getRenderMessage()
    {
        $messages = $this->messages;
        foreach ($messages as $message) {
            if ($message->status == 0) {
                if ($message->image != '') {
                    echo '<div class="chat-message_content interlocutor-message">
                            <div class="chat-message_content_text">
                            <img src="' . Yii::getAlias('@getimg') . '/' . $message->image . '" class="img-fluid">
                            ' . $message->message . '
                            </div>
                            <div class="chat-message_content_date">' . $message->time . '</div>
                           </div>';
                } else {
                    echo '<div class="chat-message_content interlocutor-message">
                            <div class="chat-message_content_text">' . $message->message . '</div>
                            <div class="chat-message_content_date">' . $message->time . '</div>
                           </div>';
                }
            } else {
                if ($message->image != '') {
                    echo '<div class="chat-message_content own-message" >
                        <div class="chat-message_content_text" ><img src="' . Yii::getAlias('@getimg') . '/' . $message->image . '" class="img-fluid">
                            ' . $message->message . '</div >
                        <div class="chat-message_content_date" >' . $message->time . '</div >
                     </div >';
                } else {
                    echo '<div class="chat-message_content own-message" >
                        <div class="chat-message_content_text" >' . $message->message . '</div >
                        <div class="chat-message_content_date" >' . $message->time . '</div >
                     </div >';
                }
            }
        }
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
