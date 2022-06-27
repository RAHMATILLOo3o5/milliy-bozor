<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;

/**
 * @var $this yii\web\View
 * @var $model common\models\Offer
 * @var $form yii\widgets\ActiveForm
 * @var $coment common\models\OfferComent
 * @var $allComent common\models\OfferComent[]
 * @var $offer common\models\Offer
 */

$this->title = $offer['title_' . Yii::$app->language] . " - Milliy Bozor";

?>
<style>
    .date {
        font-size: 11px;
    }

    .comment-text {
        font-size: 14px;
    }

    .fs-12 {
        font-size: 12px;
    }

    .shadow-none {
        box-shadow: none;
    }

    .name {
        color: #007bff;
    }

    .cursor:hover {
        color: blue;
    }

    .cursor {
        cursor: pointer;
    }

    .textarea {
        resize: none;
    }

    .field-offercoment-content {
        width: 100% !important;

    }
</style>
<div class="px-lg-6">
    <div class="row my-4">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-3">
                <img class="card-img-top" src="<?= Yii::getAlias('@getimg') . '/' . $offer['img'] ?>"
                     alt="<?= $offer['title_' . Yii::$app->language] ?> image">
                <div class="card-body danger">
                    <h4 class="card-title"><?= $offer['title_' . Yii::$app->language] ?></h4>
                    <b><?= number_format($offer['price'], '0', ' ', ' ') ?> sum</b> <small
                            class="sale"><?= number_format($offer['sale'], '0', ' ', ' ') ?> sum</small>
                    <p class="card-text"><?= $offer['content_' . Yii::$app->language] ?></p>
                    <div class="text-center">
                        <a href="tel:<?= $offer['phone'] ?>"
                           class="btn btn-outline-light"><?= Yii::t('app', 'Qo\'ng\'iroq qilish') ?></a>
                    </div>
                </div>
            </div>
            <div class="card my-3">
                <div class="card-body danger">
                    <h5 class="card-title"><?= Yii::t('app', 'Bog\'lanish uchun') ?></h5>
                    <div class="row">
                        <div class="col-sm-4 text-center text-sm-left p-3">
                            <b><?= Yii::t('app', 'Egasi') ?>:</b>
                            <p><?= $offer['owner'] ?></p>
                            <b><?= Yii::t('app', 'Telefon') ?>:</b>
                            <p><?= $offer['phone'] ?></p>
                        </div>
                        <div class="col-sm-4 text-center text-sm-left p-3">
                            <b><?= Yii::t('app', 'Viloyat') ?>:</b>
                            <p><?= \common\models\Province::findOne($offer['province_id'])->name ?></p>
                            <b><?= Yii::t('app', 'Tuman') ?>:</b>
                            <p><?= \common\models\Tumanlar::findOne($offer['tuman_id'])->name ?></p>
                        </div>
                        <div class="col-sm-4 text-center text-sm-left p-3">
                            <b><?= Yii::t('app', 'Email') ?>:</b>
                            <p><?= $offer['email'] ?></p>
                            <b><?= Yii::t('app', 'Vaqti') ?>:</b>
                            <p><?= date('d.m.Y', $offer['created_at']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="d-flex justify-content-center row">
                    <div class="col-md-10">
                        <div class="d-flex flex-column comment-section">
                            <?php if ($allComent) :
                                foreach ($allComent as $c) : ?>
                                    <div class="bg-white p-2">
                                        <div class="d-flex flex-row user-info">
                                            <i class="fa fa-user mt-2" style="font-size: 24px;"></i>
                                            <div class="d-flex flex-column justify-content-start ml-2">
                                                <span class="d-block font-weight-bold name"><?= $c->user->username ?></span>
                                                <span class="date text-black-50"><?= Yii::$app->formatter->asRelativeTime($c->created_at) ?></span>
                                            </div>
                                        </div>
                                        <div class="mt-2 ml-3">
                                            <p class="comment-text"><?= $c->content ?></p>
                                        </div>
                                    </div>
                                <?php endforeach;
                            else : ?>
                            <?php endif; ?>
                            <?php $form = ActiveForm::begin() ?>
                            <div class="bg-light p-2">
                                <div class="d-flex flex-row align-items-start p-3">
                                    <?= $form->field($coment, 'content')->textarea(['placeholder' => Yii::t('app', 'Koment qoldirish'), 'rows' => 4, 'class' => 'form-control ml-1 w-100 shadow-none textarea'])->label(false) ?>
                                </div>
                                <div class="mt-2 text-right">
                                    <button class="btn btn-primary btn-sm shadow-none"
                                            type="submit"><?= Yii::t('app', 'Koment qoldirish') ?></button>
                                    <button class="btn btn-outline-primary btn-sm ml-1 shadow-none"
                                            type="reset"><?= Yii::t('app', 'Bekor qilish'); ?></button>
                                </div>
                            </div>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
