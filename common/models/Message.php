<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\StringHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int|null $chat_id
 * @property int|null $from
 * @property string|null $message
 * @property string|null $image
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Chat $chat
 * @property User $from0
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
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
            ['message', 'required'],
            [['chat_id', 'from', 'status', 'created_at', 'updated_at'], 'integer'],
            [['message'], 'string'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 3, 'maxSize' => 1024 * 1024 * 2],
            [['chat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chat::class, 'targetAttribute' => ['chat_id' => 'id']],
            [['from'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['from' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chat_id' => 'Chat ID',
            'from' => 'From',
            'message' => 'Message',
            'image' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @param $model
     * @return false|int
     */
    public function saved($model)
    {
        $model->image = UploadedFile::getInstances($model, 'image');
        if ($model->from == Yii::$app->user->id) {
            $model->status = 1;
        } else {
            $model->status = 0;
        }
        if ($model->image) {
            $i = 1;
            $img = [];
            foreach ($model->image as $v) {
                if ($v->saveAs(Yii::getAlias('@saveimg') . "/" . time() . "($i)." . $v->extension, true)) {
                    $img[] = time() . "($i)." . $v->extension;
                    $i++;
                } else {
                    return false;
                }
            }
            $model->image = implode(',', $img);
        } else {
            $model->image = null;
        }
        $chat = Chat::findOne(['from' => $model->from, 'to' => Yii::$app->user->id]);
        if (!empty($chat)) {
            $model->chat_id = $chat->id;
            return $model->save();
        } else {
            $chat = new Chat();
            $chat->from = $model->from;
            $chat->to = Yii::$app->user->id;
            $model->chat_id = $chat->saved();
            return $model->save();
        }
    }

    /**
     * Gets query for [[Chat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChat()
    {
        return $this->hasOne(Chat::class, ['id' => 'chat_id']);
    }

    public function getCreated()
    {
        return date('d.m.Y', $this->created_at);
    }
    public function getTime(){
        return date('H:i d.m.Y');
    }
    public function getShortMessage()
    {
        return StringHelper::truncate($this->message, 2);
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
}
