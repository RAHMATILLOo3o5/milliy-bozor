<?php

/**
 * @var $product \yii\data\ActiveDataProvider
 */

use common\models\Province;
use frontend\models\Section;
use kartik\select2\Select2;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;

$this->title = Yii::t('app', 'Barcha E\'lonlar') . ' - Milliy Bozor';

?>

<div class="body px-lg-6 my-sm-5">
    <div class="row mt-lg-3">
        <div class="col-lg-2">
            <label for="caty" class="font-weight-bolder"><?= Yii::t('app', 'Rukn:') ?></label>
            <?= Select2::widget([
                'name' => 'state_2',
                'data' => ArrayHelper::map(Section::find()->andWhere(['status'=>1])->all(), 'id', 'name_'.Yii::$app->language),
                'options'=>[
                    'placeholder'=>Yii::t('app', 'Rukn..')
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <label for="price" class="font-weight-bolder"><?= Yii::t('app', 'Narxi Sumda:') ?></label>
            <div class="d-flex">
                <input type="text" class="form-control " id="price" placeholder="<?= Yii::t('app', '...dan') ?>"/>
                <input type="text" class="form-control  ml-md-3" placeholder="..."/>
            </div>
        </div>
        <div class="col-lg-2">
            <label for="viloyat" class="font-weight-bolder"><?= Yii::t('app', 'Viloyat:') ?></label>
            <?= Select2::widget([
                'name'=>'province',
                'data'=> ArrayHelper::map(Province::find()->all(), 'id', 'name'),
                'options'=>[
                    'placeholder'=>Yii::t('app', 'Viloyat..')
                ]
            ]) ?>
        </div>
        <div class="col-lg-4 px-lg-5">
            <div class="form-group">
                <label for="sort" class="font-weight-bolder"><?= Yii::t('app', 'Saralash:') ?></label>
                <?= Select2::widget([
                    'name'=>'sort',
                    'data'=>[
                        'SORT_DESC' => Yii::t('app', 'Yangi'),
                        'SORT_ASC' => Yii::t('app', 'Eski'),
                        'PRICE_DESC' => Yii::t('app', 'Qimmat'),
                        'PRICE_ASC' => Yii::t('app', 'Arzon'),
                    ]
                ]) ?>
            </div>
        </div>
    </div>
    <div class="row mt-lg-1 d-none d-md-flex">
        <div class="col">
            <?= ListView::widget([
                'dataProvider'=>$category,
                'itemView'=>'_category',
                'options'=>[
                    'class'=>'sorts my-4 d-lg-flex justify-content-lg-around'
                ],
                'emptyText'=>'',
                'layout'=>"{items}\n",
            ]) ?>
        </div>
    </div>

    <div class="row mt-md-4">
        <div class="col sorts">
            <a href="#"><b>Uy va Bog' <span class="text-danger">12 </span></b>
            </a>
            <a href="#"><b>Elektr jihozlari' <span class="text-danger">122 </span></b>
            </a>
            <a href="#"><b>Elektronika <span class="text-danger">142 </span></b>
            </a>
        </div>
    </div>
    <?=
    ListView::widget([
        'dataProvider' => $product,
        'itemView' => '_items',
        'layout' => "{items}\n{pager}",
        'options' => [
            'class' => 'row mt-md-4'
        ],
        'itemOptions' => [
            'class' => 'col-md-4 p-md-5'
        ],
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class,
            'maxButtonCount'=>8,
            'options' => [
                'class'=>'col-12 pl-5 mt-4'
            ]
        ]
    ]);
    ?>

</div>
