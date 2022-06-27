<?php

namespace common\models;

use backend\models\Category;
use backend\models\Section;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\StringHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $slug
 * @property string $name
 * @property string|null $description
 * @property string|null $img
 * @property int|null $price
 * @property int|null $user_id
 * @property int|null $section_id
 * @property int|null $category_id
 * @property int|null $is_top
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Category $category
 * @property Like[] $likes
 * @property Section $section
 * @property User $user
 * @property View[] $views
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return [

            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false

            ],
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
            [['name', 'price', 'section_id', 'category_id'], 'required'],
            [['description'], 'string', 'max' => 500, 'min' => 40],
            [['status', 'is_top'], 'integer'],
            [['price'], 'integer', 'max' => 1000000000, 'tooBig' => Yii::t('app', Yii::t('app', 'Narx 1 MLRD dan katta bo\'lmasligi kerak'))],
            [['slug'], 'string', 'max' => 200],
            [['img'], 'file', 'extensions' => ['jpg', 'png', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 6],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::class, 'targetAttribute' => ['section_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'name' => Yii::t('app', 'Nomi'),
            'description' => Yii::t('app', 'Tavsifi'),
            'img' => Yii::t('app', 'Rasm'),
            'price' => Yii::t('app', 'Narxi'),
            'user_id' => Yii::t('app', 'Foydalanuvchi'),
            'section_id' => Yii::t('app', 'Bo\'lim'),
            'category_id' => Yii::t('app', 'Kategoriyasi'),
            'is_top' => Yii::t('app', 'Top'),
            'status' => Yii::t('app', 'Holati'),
            'created_at' => Yii::t('app', 'Yaratildi'),
            'updated_at' => Yii::t('app', 'Yangilandi'),
        ];
    }

    public function getStatusLabel()
    {
        if ($this->status == 1) {
            return "<span class='badge badge-success'>Faol</span>";
        }
        return "<span class='badge badge-danger'>Nofaol</span>";
    }

    public function getTopLabel()
    {
        if ($this->is_top == 1) {
            return "<span class='badge badge-success'><i class='fa fa-crown'></i> Premium </span>";
        }
        return "<span class='badge badge-warning'>Oddiy</span>";
    }

    public function getImages()
    {
        $img = explode(',', $this->img);
        $imgSrc = [];

        foreach ($img as $k) {
            $imgSrc[] = Yii::getAlias('@getimg') . "/" . $k;
        }

        return $imgSrc;

    }

    public function saved($model)
    {
        $this->img = UploadedFile::getInstances($model, 'img');
        if (!empty($this->img)) {
            $i = 1;
            $img = [];
            foreach ($this->img as $v) {
                if ($v->saveAs(Yii::getAlias('@saveimg') . "/" . time() . "($i)." . $v->extension, true)) {
                    $img[] = time() . "($i)." . $v->extension;
                    $i++;
                } else {
                    return false;
                }
            }
            $this->img = implode(',', $img);
        } else {
            $this->img = '02.png';
        }
        $this->slug = Yii::$app->security->generateRandomString(12);
        return $this->save();
    }

    /**
     * @return mixed|null
     */
    public function getViewCount()
    {
        return View::findOne(['product_id' => $this->id])->view_count;
    }

    public function updated($model)
    {
        $this->img = UploadedFile::getInstances($model, 'img');
        if (!empty($this->img)) {
            if ($this->getOldAttribute('img') != '02.png') {
                $imgpath = explode(',', $this->getOldAttribute('img'));
                foreach ($imgpath as $img) {
                    unlink(Yii::getAlias('@saveimg') . "/" . $img);
                }
            }
            $i = 1;
            $img = [];
            foreach ($this->img as $v) {
                if ($v->saveAs(Yii::getAlias('@saveimg') . "/" . time() . "($i)." . $v->extension, true)) {
                    $img[] = time() . "($i)." . $v->extension;
                    $i++;
                } else {
                    return false;
                }
            }
            $this->img = implode(',', $img);
            return $model->save();
        } else {
            $this->img = $this->getOldAttribute('img');
            return $model->save();
        }
    }

    /**
     * @return string
     */
    public function getShortname()
    {
        if (strlen($this->name) > 6) {
            return StringHelper::truncate($this->name, 6);
        }
        return $this->name;
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\LikeQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Section]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\SectionQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::class, ['id' => 'section_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Views]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\ViewQuery
     */
    public function getViews()
    {
        return $this->hasMany(View::class, ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\search\ProductQuery the active query used by this AR class.
     */
//    public static function find()
//    {
//        return new \common\models\search\ProductQuery(get_called_class());
//    }
}
