<?php
/**
 * @var $model \frontend\models\search\ProductQuery
 */

use common\models\Like;
use yii\helpers\Url;

?>

<div class="card shadow">
    <img src="<?= $model->images[0] ?>" alt="" class="card-img-top" height="250px"/>
    <div class="ribbon <?= ($model->is_top == 0) ? 'd-none' : ''; ?>">
        <i class="fa fa-crown"></i>
    </div>
    <div class="card-body">
        <div class="card-title d-flex">
            <a href="<?= Url::to(['product/view', 'id' => $model->slug]) ?>" class="card-link">
                <h4>
                    <?= $model->shortname; ?>
                </h4>
            </a>
            <a href="<?= Url::to(['/component/like', 'id' => $model->id]) ?>" class="card-link like ml-lg-5"
               data-toggle="tooltip" data-placement="right" title="Saralanganlarga qo'shish">
                <i class="fa fa-heart like-active <?php if (!Yii::$app->user->isGuest && Like::findOne(['user_id' => Yii::$app->user->id, 'product_id' => $model->id]) !== null) {
                    echo 'active';
                } else {
                    echo '';
                } ?>"></i>
            </a>
        </div>
        <b><?= $model->user->province->name ?> <i class="fa-solid fa-location-dot"></i></b>
        <p class="card-text mt-sm-5">
            <span><?= number_format($model->price, 0, ' ', ' ') . ' sum' ?></span>
            <a href="<?= Url::to(['product/view', 'id' => $model->slug]) ?>" class="btn btn-danger py-0 px-2 ml-sm-4"><?= Yii::t('app', 'batafsil') ?></a>
        </p>

    </div>
</div>
