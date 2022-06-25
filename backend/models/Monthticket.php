<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "monthticket".
 *
 * @property int $id
 * @property string $name
 * @property string $option_uz
 * @property string $option_ru
 * @property string $limit_uz
 * @property string $limit_ru
 * @property int|null $sale
 * @property int $price
 * @property int $order
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 */
class Monthticket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'monthticket';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'option_uz', 'option_ru', 'price'], 'required'],
            [['option_uz', 'option_ru', 'limit_uz', 'limit_ru'], 'string'],
            [['sale', 'order', 'price', 'order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'option_uz' => Yii::t('app', 'Imkoniyatlar Uz'),
            'option_ru' => Yii::t('app', 'Imkoniyatlar Ru'),
            'limit_uz' => Yii::t('app', 'Cheklovlar Uz'),
            'limit_ru' => Yii::t('app', 'Cheklovlar Ru'),
            'sale' => Yii::t('app', 'Asl narxi'),
            'price' => Yii::t('app', 'Chegirmali narxi'),
            'order' => Yii::t('app', 'Order'),
            'status' => Yii::t('app', 'Holati'),
            'created_at' => Yii::t('app', 'Yaratilgan vaqti'),
            'updated_at' => Yii::t('app', 'Yangilangan vaqti'),
        ];
    }

    public function getStatusLabel()
    {
        return $this->status == 1 ? '<span class="badge badge-success">Faol</span>' : '<span class="badge badge-danger">Nofaol</span>';
    }

    public function getOptionuz()
    {
        $option = explode('.', $this->option_uz);
        $result = [];
        for ($i = 0; $i < count($option); $i++) {
            $result[] = '<p class="p-0 m-0"><i class="fa fa-check-circle mr-2 text-success"></i> ' . $option[$i] . ' </p>';
        }
        return implode(' ', $result);
    }

    public function getLimituz()
    {
        if (!empty($this->limit_ru)) {
            $option = explode('.', $this->limit_uz);
            $result = [];
            for ($i = 0; $i < count($option); $i++) {
                $result[] = '<p class="p-0 m-0"><i class="ion-close-circled mr-2 text-danger"></i> ' . $option[$i] . ' </p>';
            }
            return implode(' ', $result);
        }
    }

    public function getOptionru()
    {
        $option = explode('.', $this->option_ru);
        $result = [];
        for ($i = 0; $i < count($option); $i++) {
            $result[] = '<p class="p-0 m-0"><i class="fa fa-check-circle mr-2 text-success"></i> ' . $option[$i] . ' </p>';
        }
        return implode(' ', $result);
    }

    public function getLimitru()
    {
        if (!empty($this->limit_ru)) {

            $option = explode('.', $this->limit_ru);
            $result = [];
            for ($i = 0; $i < count($option); $i++) {
                $result[] = '<p class="p-0 m-0"><i class="ion-close-circled mr-2 text-danger"></i> ' . $option[$i] . ' </p>';
            }
            return implode(' ', $result);
        }
    }
    /**
     * {@inheritdoc}
     * @return \backend\models\search\MonthticketQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new \backend\models\search\MonthticketQuery(get_called_class());
    // }
}
