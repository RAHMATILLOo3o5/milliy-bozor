<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "search_like".
 *
 * @property int $id
 * @property int $user_id
 * @property string $query
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class SearchLike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'search_like';
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'query'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['query'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @param $query
     * @return bool
     */
    public function saved($query)
    {
        $this->query = $query;
        $this->user_id = Yii::$app->user->id;
        return $this->save();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'query' => 'Query',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return bool|int|string|null
     */
    public function getProduct()
    {
        return Product::find()->where(['like', 'name', $this->query])->count();
    }
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
