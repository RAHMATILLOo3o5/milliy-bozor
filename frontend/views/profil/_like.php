<?php

use common\models\Like;
use yii\helpers\Url;
use yii\widgets\Pjax;

/**
 *
 * @var $model \common\models\Product
 */
?>

<div class="card shadow my-1 mx-5 my-sm-4 mx-md-0">
    <img src="<?= $model->product->images[0] ?>" alt="" class="card-img-top" height="240px"/>
    <div class="ribbon <?= ($model->product->is_top == 0) ? 'd-none' : ''; ?>">
        <i class="fa fa-crown"></i>
    </div>
    <div class="card-body text-dark">
        <div class="card-title d-flex">
            <a href="<?= Url::to(['product/view', 'id' => $model->product->slug]) ?>" class="card-link">
                <h4>
                    <?= $model->product->shortname; ?>
                </h4>
            </a>
        </div>
        <b> <?= $model->product->user->province->name ?> <i class=" fa-solid fa-location-dot"></i></b>
        <p class="card-text mt-sm-5">
            <span><?= number_format($model->product->price, 0, ' ', ' ') . ' sum' ?></span>
            <a href="<?= Url::to(['product/view', 'id' => $model->product->slug]) ?>"
               class="btn btn-danger py-0 px-2 ml-sm-3"><?= Yii::t('app', 'batafsil') ?></a>
        </p>
    </div>
</div>
