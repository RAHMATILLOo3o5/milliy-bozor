<?php

namespace common\models;

use backend\models\Dayticket;
use backend\models\Monthticket;
use Yii;

/**
 * This is the model class for table "top_time".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $day_id
 * @property int|null $month_id
 * @property int|null $register_time
 * @property int|null $exp_time
 * @property int|null $status
 *
 * @property Dayticket $day
 * @property Monthticket $month
 * @property User $user
 */
class TopTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'top_time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'day_id', 'month_id', 'register_time', 'exp_time', 'status'], 'integer'],
            [['day_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dayticket::class, 'targetAttribute' => ['day_id' => 'id']],
            [['month_id'], 'exist', 'skipOnError' => true, 'targetClass' => Monthticket::class, 'targetAttribute' => ['month_id' => 'id']],
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
            'day_id' => 'Day ID',
            'month_id' => 'Month ID',
            'register_time' => 'Register Time',
            'exp_time' => 'Exp Time',
            'status' => 'Status',
        ];
    }

    /**
     * @param $user_id
     * @param $exp_time
     * @param $ticket_id
     * @param $order
     * @return bool
     */
    public function saved($user_id, $exp_time, $ticket_id, $order)
    {
        $this->user_id = $user_id;

        $this->register_time = time();
        $this->exp_time = $this->register_time + $exp_time;
        if ($order == 1) {
            $this->day_id = $ticket_id;
            $this->month_id = null;
        } else {
            $this->day_id = null;
            $this->month_id = $ticket_id;
        }
        $top_user = User::findOne($user_id);
        $top_user->is_top = 1;
        if ($this->validate() && $this->save() && $top_user->update()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $user_id
     * @return bool
     * @throws \yii\db\StaleObjectException
     */
    public function check($user_id)
    {
        $expired_count = $this::find()->where(['user_id' => $user_id, 'status' => 1])->andFilterCompare('exp_time', time(), '<')->count();
        if ($expired_count > 0) {
            $model = $this::find()->where(['user_id' => $user_id, 'status' => 1])->andFilterCompare('exp_time', time(), '<')->all();
            for ($i = 0; $i < $expired_count; $i++) {
                $model[$i]->status = 0;
                $top_user = User::findOne(['id' => $model[$i]->user_id]);
                $top_user->is_top = 0;
                $top_user->update();
                $model[$i]->update();
            }
            $no_exp = $this::find()->where(['user_id' => $user_id, 'status' => 1])->andFilterCompare('exp_time', time(), '>')->count();
            if ($no_exp > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            $no_exp = $this::find()->where(['user_id' => $user_id, 'status' => 1])->andFilterCompare('exp_time', time(), '>')->count();
            if ($no_exp > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Gets query for [[Day]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDay()
    {
        return $this->hasOne(Dayticket::class, ['id' => 'day_id']);
    }

    /**
     * Gets query for [[Month]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMonth()
    {
        return $this->hasOne(Monthticket::class, ['id' => 'month_id']);
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
