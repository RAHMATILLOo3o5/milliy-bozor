<?php

namespace backend\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "footer".
 *
 * @property int $id
 * @property string|null $text_uz
 * @property string|null $text_ru
 * @property string|null $twitter
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $youtube
 * @property string|null $telegram
 * @property string|null $pinterest
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Footer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'footer';
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text_uz', 'text_ru'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['twitter', 'facebook', 'instagram', 'youtube', 'telegram', 'pinterest'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'text_uz' => Yii::t('app', 'Footer matni Uzbekcha'),
            'text_ru' => Yii::t('app', 'Footer matni Ruscha'),
            'twitter' => Yii::t('app', 'Twitter'),
            'facebook' => Yii::t('app', 'Facebook'),
            'instagram' => Yii::t('app', 'Instagram'),
            'youtube' => Yii::t('app', 'Youtube'),
            'telegram' => Yii::t('app', 'Telegram'),
            'pinterest' => Yii::t('app', 'Pinterest'),
            'status' => Yii::t('app', 'Holati'),
            'created_at' => Yii::t('app', 'Yaratilgan vaqti'),
            'updated_at' => Yii::t('app', 'Yangilangan vaqti'),
        ];
    }

    public function getStatusLabel()
    {
        return $this->status == 1 ? '<span class="badge badge-success">Faol</span>' : '<span class="badge badge-danger">Nofaol</span>';
    }
    public function getShortText()
    {
        return StringHelper::truncateWords($this->text_uz, 3);
    }
    public function getShortTextru()
    {
        return StringHelper::truncateWords($this->text_ru, 3);
    }

    public function getContact()
    {
        $contact = [
            'twitter' => $this->twitter,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'telegram' => $this->telegram,
            'pinterest' => $this->pinterest,
        ];
        $arr = [];
        foreach ($contact as $k=>$v) {
            if (!empty($contact[$k])) {
                $arr[] = '<a href="' . $v . '" target="_blank" class=" ml-2" style="font-size:20px;"><i class="fab fa-'.$k.'"> </i></a> ';
            }
        }
        return implode(' ', $arr);
    }
}
