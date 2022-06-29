<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "connect".
 *
 * @property int $id
 * @property string|null $phone
 * @property int|null $status
 */
class Connect extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'connect';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Telefon raqam',
            'status' => 'Holati',
        ];
    }

    public function getStatusLabel()
    {
        if ($this->read == 1) {
            return "<span class='badge badge-success'>O'qilgan</span>";
        }
        return "<span class='badge badge-danger'>O'qilmagan</span>";
    }
}
