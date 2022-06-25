<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "like".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $product_id
 * @property int|null $created_at
 *
 * @property Product $product
 * @property User $user
 */
class Like extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'created_at'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'product_id' => 'Product ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Save model function
     *
     * @param $id
     * @return boolean
     */

    public function saved($id)
    {
        $like = $this::findOne(['product_id' => $id, 'user_id' => Yii::$app->user->id]);
        if ($like) {
            if ($like->delete()) {
                return true;
            }
        }
        $this->created_at = time();
        $this->product_id = $id;
        $this->user_id = Yii::$app->user->id;
        return $this->save();
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
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
