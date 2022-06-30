<?php
/**
 * @var $this yii\web\View
 * @var $like \yii\data\ActiveDataProvider
 * @var $view \yii\data\ActiveDataProvider
 * @var $myAds \yii\data\ActiveDataProvider
 * @var $search \yii\data\ActiveDataProvider
 */

use yii\widgets\ListView;

$this->title = Yii::t('app', 'Profil - ') . Yii::$app->name;

$html = '<div class="col-lg-8 text-center py-sm-5 offset-lg-2">
               <img src="' . Yii::getAlias('@defaultImgPath') . '/undraw_inspiration_lecl 1.svg" alt="">
                  <h3 class="my-sm-5">' . Yii::t('app', 'Siz kuzatilgan reklamalarni saqlamaysiz') . '</h3>
                   <p>' . Yii::t('app', 'logs') . '</p>
           </div>';


?>
<div class="danger">
    <div class="px-lg-6">
        <div class="row">
            <div class="col">
                <h3 class="py-5"><?= Yii::t('app', 'Saralangan e\'lonlar') ?></h3>
                <nav>
                    <div class="nav nav-tabs" id="profil" role="tablist">
                        <a class="nav-link active" id="like-tab" data-toggle="tab" href="#like" role="tab"
                           aria-controls="like" aria-selected="true">
                            <b><?= Yii::t('app', 'Saralangan e\'lonlar') ?></b> <span
                                    class="badge badge-warning"><?= $like->count ?></span>
                        </a>
                        <a class="nav-link" id="search-tab" data-toggle="tab" href="#search" role="tab"
                           aria-controls="search" aria-selected="false">
                            <b><?= Yii::t('app', 'Saralangan qidiruv natijalari') ?></b> <span
                                    class="badge badge-warning"> <?= $search->count ?></span>
                        </a>
                        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                           aria-controls="nav-contact" aria-selected="false">
                            <b><?= Yii::t('app', 'Yaqinda ko\'rilgan') ?></b> <span
                                    class="badge badge-warning"><?= $view->count ?></span>
                        </a>
                        <a class="nav-link" id="nav-elon-tab" data-toggle="tab" href="#nav-elon" role="tab"
                           aria-controls="nav-elon" aria-selected="false">
                            <b><?= Yii::t('app', 'E\'lonlarim') ?></b> <span
                                    class="badge badge-warning"><?= $myAds->count ?></span>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="px-lg-6">
    <div class="tab-content my-2 my-sm-5">
        <div class="tab-pane fade show active" id="like" role="tabpanel" aria-labelledby="like-tab">
            <div class="row <?= ($like->count == 0) ? 'd-none' : ''; ?>">
                <div class="col-12">
                    <a href="<?= \yii\helpers\Url::to(['profil/clear']) ?>"
                       class="btn btn-danger <?= ($like->count == 0) ? 'disabled' : ''; ?>"><i
                                class="fa fa-trash-can"></i> <?= Yii::t('app', 'Tozalash') ?></a>
                </div>
            </div>
            <?= ListView::widget([
                'dataProvider' => $like,
                'itemView' => '_like',
                'layout' => "{items}\n{pager}",
                'options' => [
                    'class' => 'row my-2 my-sm-5'
                ],
                'emptyText' => $html,
                'itemOptions' => [
                    'class' => 'col-md-3'
                ],
                'pager' => [
                    'class' => \yii\bootstrap4\LinkPager::class
                ]
            ]); ?>
        </div>

        <div class="tab-pane fade " id="search" role="tabpanel" aria-labelledby="search-tab">
            <?= ListView::widget([
                'dataProvider' => $search,
                'itemView' => 'search',
                'layout' => "{items}\n{pager}",
                'options' => [
                    'class' => 'row my-2 my-sm-5 view'
                ],
                'emptyText' => $html,
                'itemOptions' => [
                    'class' => 'col-md-8 offset-md-2'
                ],
                'pager' => [
                    'class' => \yii\bootstrap4\LinkPager::class
                ]
            ]); ?>
        </div>

        <div class="tab-pane fade " id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <?= ListView::widget([
                'dataProvider' => $view,
                'itemView' => '_like',
                'layout' => "{items}\n{pager}",
                'options' => [
                    'class' => 'row my-2 my-sm-5 view'
                ],
                'emptyText' => $html,
                'itemOptions' => [
                    'class' => 'col-md-3'
                ],
                'pager' => [
                    'class' => \yii\bootstrap4\LinkPager::class
                ]
            ]); ?>
        </div>

        <div class="tab-pane fade " id="nav-elon" role="tabpanel" aria-labelledby="nav-elon-tab">
            <?= ListView::widget([
                'dataProvider' => $myAds,
                'itemView' => '_product',
                'layout' => "{items}\n{pager}",
                'options' => [
                    'class' => 'row my-2 my-sm-5 view'
                ],
                'emptyText' => $html,
                'itemOptions' => [
                    'class' => 'col-md-3'
                ],
                'pager' => [
                    'class' => \yii\bootstrap4\LinkPager::class
                ]
            ]); ?>
        </div>
    </div>
</div>