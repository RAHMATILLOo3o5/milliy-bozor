<?php

use common\models\Like;
use yii\helpers\Url;


?>
<div class="row">
    <?php foreach ($model->product as $k) : ?>
        <div class="col-md-4">
            <div class="card md m-3" style="width: 18rem;">
                <img src="<?= $k->images[0] ?>" alt="" class="card-img-top imt" height="240px"/>
                <div class="card-body">
                    <div class="card-title d-flex">
                        <a href="<?= Url::to(['product/view-product', 'id' => $k->slug]) ?>" class="card-link">
                            <h4>
                                <?= $k->shortname; ?>
                            </h4>
                        </a>
                        <a href="<?= Url::to(['/component/like', 'id' => $k->id]) ?>" class="card-link like ml-lg-5"
                           data-toggle="tooltip" data-placement="right" title="Saralanganlarga qo'shish">
                            <i class="fa fa-heart like-active <?php if (!Yii::$app->user->isGuest && Like::findOne(['user_id' => Yii::$app->user->id, 'product_id' => $k->id]) !== null) {
                                echo 'active';
                            } else {
                                echo '';
                            } ?>"></i>
                        </a>
                    </div>
                    <b><?= $k->user->province->name ?> <i class="fa-solid fa-location-dot"></i></b>
                    <p class="card-text mt-sm-5">
                        <span><?= number_format($k->price, 0, ' ', ' ') . ' sum' ?></span>
                        <a href="<?= Url::to(['product/view-product', 'id' => $k->slug]) ?>"
                           class="btn btn-danger py-0 px-2 ml-sm-4"><?= Yii::t('app', 'Batafsil') ?></a>
                    </p>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

</div>