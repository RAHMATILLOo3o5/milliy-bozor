<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "view".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $product_id
 * @property int|null $view_count
 * @property int|null $created_at
 *
 * @property Product $product
 * @property User $user
 */
class View extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'view_count', 'created_at'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
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
            'product_id' => 'Product ID',
            'view_count' => 'View Count',
            'created_at' => 'Created At',
        ];
    }

    public function saved( $product_id)
    {
        $view = View::findOne(['product_id' => $product_id]);
        if (!Yii::$app->user->isGuest){
            if (!$view) {
                $view = new View();
                $view->user_id = Yii::$app->user->id;
                $view->view_count = $view->view_count + 1;
                $view->product_id = $product_id;
                return $view->save();
            } else {
                $view->view_count = $view->view_count + 1;
                $view->created_at = time();
                return $view->save();
            }
        } else {
            if (!$view) {
                $view = new View();
                $view->user_id = null;
                $view->view_count = $view->view_count + 1;
                $view->product_id = $product_id;
                return $view->save();
            } else {
                $view->view_count = $view->view_count + 1;
                $view->created_at = time();
                return $view->save();
            }
        }
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
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
