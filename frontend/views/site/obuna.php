<?php

use yii\helpers\Url;

/**
 * @var $dticket \backend\models\Dayticket
 * @var $mticket \backend\models\Monthticket
 */

$this->title = Yii::t('app', 'Premium ta\'riflar') . ' - ' . Yii::$app->name;
?>

<div class="px-lg-6 my-sm-5">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 text-center">
            <h1 class="font-weight-bolder"><?= Yii::t('app', 'Premium sotib olish') ?></h1>
            <div class="text-secondary mb-5">
                <?= Yii::t('app', 'It\'s a one-time payment. Pay once, use for a lifetime') ?>
            </div>
        </div>
    </div>
    <?php if ($dticket) : ?>
        <div class="row justify-content-lg-between">
            <?php foreach ($dticket as $t) : ?>
                <div class="col-lg-3">
                    <div class="rounded border shadow-sm p-4">
                        <h4 class="mt-3 mb-4"><b><?= $t->name ?></b></h4>
                        <?php
                        if (Yii::$app->language == 'uz') {
                            echo $t->optionuz;
                            echo $t->limituz;
                        } else if (Yii::$app->language == 'ru') {
                            echo $t->optionru;
                            echo $t->limitru;
                        }
                        ?>
                        <div class="text-center">
                            <small class="text-black-50 text-decoration sale"><?= number_format($t->sale, 0, ' ', ' ') ?>
                                sum</small>
                            <p>
                            <h4><?= number_format($t->price, 0, ' ', ' ') ?> sum <b
                                        class="text-danger">/ <?= Yii::t('app', 'kun') ?></b></h4>
                            </p>
                            <a href="<?= Url::to(['component/top', 'id' => $t->id, 'order' => $t->order]) ?>"
                               class="btn btn-danger btn-block rounded"><?= Yii::t('app', 'Sotib olish') ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if ($mticket) : ?>
        <div class="row justify-content-lg-between mt-5">
            <?php foreach ($mticket as $t) : ?>
                <div class="col-lg-3">
                    <div class="rounded border shadow-sm p-4">
                        <h4 class="mt-3 mb-4"><b><?= $t->name ?></b></h4>
                        <?php
                        if (Yii::$app->language == 'uz') {
                            echo $t->optionuz;
                            echo $t->limituz;
                        } else if (Yii::$app->language == 'ru') {
                            echo $t->optionru;
                            echo $t->limitru;
                        }
                        ?>
                        <div class="text-center">
                            <small class="text-black-50 text-decoration sale"><?= number_format($t->sale, 0, ' ', ' ') ?>
                                sum</small>
                            <p>
                            <h4><?= number_format($t->price, 0, ' ', ' ') ?> sum <b
                                        class="text-danger">/ <?= Yii::t('app', 'oy') ?></b></h4>
                            </p>
                            <a href="<?= Url::to(['component/top', 'id' => $t->id, 'order' => $t->order]) ?>"
                               class="btn btn-danger btn-block rounded"><?= Yii::t('app', 'Sotib olish') ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="row rounded border mx-sm-1 my-sm-5 p-sm-5 justify-content-lg-around">
        <div class="col-lg-3">
            <a href="#">
                <img src="<?= Yii::getAlias('@defaultImgPath') ?>/click-01 1.png" alt="">
            </a>
        </div>
        <div class="col-lg-3">
            <a href="#">
                <img src="<?= Yii::getAlias('@defaultImgPath') ?>/payme-01 1.png" alt="">
            </a>
        </div>
        <div class="col-lg-3">
            <a href="#">
                <img src="<?= Yii::getAlias('@defaultImgPath') ?>/Uzcard-01 1.png" alt="">
            </a>
        </div>
        <div class="col-lg-3">
            <a href="#">
                <img src="<?= Yii::getAlias('@defaultImgPath') ?>/Humo-01 1.png" alt="">
            </a>
        </div>
    </div>
</div>
