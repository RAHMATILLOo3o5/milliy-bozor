<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "seen".
 *
 * @property int $id
 * @property int $user_id
 * @property int $last_seen
 *
 * @property User $user
 */
class Seen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'last_seen'], 'required'],
            [['user_id', 'last_seen'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'last_seen' => 'Last Seen',
        ];
    }

    public function saved()
    {
        $this->last_seen = time();
        $this->user_id = Yii::$app->user->id;
        return $this->save();
    }

    public function updated()
    {
        if (!empty(Yii::$app->user->identity->password_hash)) {
            $seen = $this::findOne(['user_id' => Yii::$app->user->id]);
            $seen->last_seen = time();
            return $seen->update();
        }
    }

    /**
     * @return false|string
     */
    public function getFormatTime()
    {
        return date('H:i d.m.Y', $this->last_seen);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
