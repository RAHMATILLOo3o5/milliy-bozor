<?php

/**
 * @var yii\web\View $this
 * @var $section \frontend\models\Section
 * @var $topProduct \common\models\Product
 * @var $newProduct \common\models\Product
 * @var $oldProduct \common\models\Product
 * @var $offers \yii\data\ActiveDataProvider
 * @var $service \frontend\models\Service
 * @var $message \common\models\Contact
 */


use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = Yii::$app->name;
$carousel = $offers->getModels();
?>
<div class="px-lg-6 mt-sm-5 mb-sm-3">
    <div class="row">
        <div class="col">
            <div id="carouselExampleIndicators" class="carousel slide home-carousel my-carousel2" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <?php if ($offers->count > 1) : for ($i = 1; $i < $offers->count; $i++) : ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>"></li>
                    <?php endfor; endif; ?>
                </ol>

                <div class="carousel-inner">
                    <?php if ($carousel) : ?>
                        <div class="carousel-item active">
                            <div class="row my-item">
                                <div class="col-md-8 px-0">
                                    <div class="row offer-info">
                                        <div class="col-lg-8">
                                            <h1 class="pr-5"><b><?= $carousel[0]['title_' . Yii::$app->language] ?></b>
                                            </h1>
                                            <p><?= $carousel[0]['content_' . Yii::$app->language] ?></p>
                                        </div>
                                    </div>
                                    <div class="row mt-sm-2 ">
                                        <div class="col-md-5">
                                            <div class="danger rounded-top p-2">
                                                <nav>
                                                    <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                                                        <a class="nav-link active" id="nav-profile-tab"
                                                           data-toggle="tab"
                                                           href="#nav-profile" role="tab" aria-controls="nav-profile"
                                                           aria-selected="false"><?= Yii::t('app', 'Sotib olish') ?></a>
                                                    </div>
                                                </nav>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="danger" style="border-bottom-left-radius: 10px;">
                                                <div class="tab-content" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-profile"
                                                         role="tabpanel"
                                                         aria-labelledby="nav-profile-tab">
                                                        <div class="row p-3">
                                                            <div class="col-md-2">
                                                                <label for="viloyat"
                                                                       class="text-secondary"><?= Yii::t('app', 'Viloyat') ?>
                                                                    <i
                                                                            class="fa fa-sort-down"></i>
                                                                </label>
                                                                <input type="text" class="form-control" readonly
                                                                       value="<?= \common\models\Province::findOne($carousel[0]['province_id'])->name ?>">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="vKurs"
                                                                       class="text-secondary"><?= Yii::t('app', 'Pul birligi') ?>
                                                                    <i
                                                                            class="fa fa-sort-down"></i>
                                                                </label>
                                                                <input type="text" id="vKurs" class="form-control"
                                                                       readonly
                                                                       value="UZS">

                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="vKurs"
                                                                       class="text-secondary"><?= Yii::t('app', 'Narxlar') ?>
                                                                    <i
                                                                            class="fa fa-sort-down"></i>
                                                                </label>
                                                                <p>
                                                                    <?= number_format($carousel[0]['price'], '0', '.', ' ') ?>
                                                                    -
                                                                    <?= number_format($carousel[0]['sale'], '0', '.', ' ') ?>
                                                                    UZS
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-none d-md-block pl-0">
                                    <div class="carousel-img">
                                        <img src="<?= Yii::getAlias('@getimg') . '/' . $carousel[0]['img'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($offers->count > 1) : for ($i = 1; $i < $offers->count; $i++) : ?>
                            <div class="carousel-item">
                                <div class="row my-item">
                                    <div class="col-md-8 px-0">
                                        <div class="row offer-info">
                                            <div class="col-lg-8">
                                                <h1 class="pr-5">
                                                    <b><?= $carousel[$i]['title_' . Yii::$app->language] ?></b></h1>
                                                <p><?= $carousel[$i]['content_' . Yii::$app->language] ?></p>
                                            </div>
                                        </div>
                                        <div class="row mt-sm-2 ">
                                            <div class="col-md-5">
                                                <div class="danger rounded-top p-2">
                                                    <nav>
                                                        <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                                                            <a class="nav-link active" id="nav-profile-tab"
                                                               data-toggle="tab"
                                                               href="#nav-profile" role="tab"
                                                               aria-controls="nav-profile"
                                                               aria-selected="false"><?= Yii::t('app', 'Sotib olish') ?></a>
                                                        </div>
                                                    </nav>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="danger" style="border-bottom-left-radius: 10px;">
                                                    <div class="tab-content" id="nav-tabContent">
                                                        <div class="tab-pane fade show active" id="nav-profile"
                                                             role="tabpanel"
                                                             aria-labelledby="nav-profile-tab">
                                                            <div class="row p-3">
                                                                <div class="col-md-2">
                                                                    <label for="viloyat"
                                                                           class="text-secondary"><?= Yii::t('app', 'Viloyat') ?>
                                                                        <i
                                                                                class="fa fa-sort-down"></i>
                                                                    </label>
                                                                    <input type="text" class="form-control" readonly
                                                                           value="<?= \common\models\Province::findOne($carousel[$i]['province_id'])->name ?>">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="vKurs"
                                                                           class="text-secondary"><?= Yii::t('app', 'Pul birligi') ?>
                                                                        <i
                                                                                class="fa fa-sort-down"></i>
                                                                    </label>
                                                                    <input type="text" id="vKurs" class="form-control"
                                                                           readonly
                                                                           value="UZS">

                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="vKurs"
                                                                           class="text-secondary"><?= Yii::t('app', 'Narxlar') ?>
                                                                        <i
                                                                                class="fa fa-sort-down"></i>
                                                                    </label>
                                                                    <p>
                                                                        <?= number_format($carousel[$i]['price'], '0', '.', ' ') ?>
                                                                        -
                                                                        <?= number_format($carousel[$i]['sale'], '0', '.', ' ') ?>
                                                                        UZS
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-none d-md-block pl-0">
                                        <div class="carousel-img">
                                            <img src="<?= Yii::getAlias('@getimg') . '/' . $carousel[$i]['img'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; endif; ?>
                    <?php else: ?>
                        <div class="carousel-item active">
                            <div class="row my-item">
                                <div class="col-md-8 px-0">
                                    <div class="row offer-info">
                                        <div class="col-lg-8">
                                            <h1 class="pr-5"><b>Find the perfect
                                                    place to stay with
                                                    your family</b></h1>
                                            <p>Buying a home is a life-changing experience, so shouldn’t your real estate
                                                agent be a life changer</p>
                                        </div>
                                    </div>
                                    <div class="row mt-sm-2 ">
                                        <div class="col-md-5">
                                            <div class="danger rounded-top p-2">
                                                <nav>
                                                    <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                                                        <a class="nav-link active" id="nav-profile-tab"
                                                           data-toggle="tab"
                                                           href="#nav-profile" role="tab" aria-controls="nav-profile"
                                                           aria-selected="false"><?= Yii::t('app', 'Sotib olish') ?></a>
                                                    </div>
                                                </nav>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="danger" style="border-bottom-left-radius: 10px;">
                                                <div class="tab-content" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-profile"
                                                         role="tabpanel"
                                                         aria-labelledby="nav-profile-tab">
                                                        <div class="row p-3">
                                                            <div class="col-md-2">
                                                                <label for="viloyat"
                                                                       class="text-secondary"><?= Yii::t('app', 'Viloyat') ?>
                                                                    <i
                                                                            class="fa fa-sort-down"></i>
                                                                </label>
                                                                <input type="text" class="form-control" readonly
                                                                       value="Farg'ona">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="vKurs"
                                                                       class="text-secondary"><?= Yii::t('app', 'Pul birligi') ?>
                                                                    <i
                                                                            class="fa fa-sort-down"></i>
                                                                </label>
                                                                <input type="text" id="vKurs" class="form-control"
                                                                       readonly
                                                                       value="UZS">

                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="vKurs"
                                                                       class="text-secondary"><?= Yii::t('app', 'Narxlar') ?>
                                                                    <i
                                                                            class="fa fa-sort-down"></i>
                                                                </label>
                                                                <p>
                                                                    1.00-5.00 mln UZS
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-none d-md-block pl-0">
                                    <div class="carousel-img">
                                        <img src="images/unsplash_r6nNR124cVc.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($section) && Yii::$app->language == 'uz') :
        echo '<div class="row border rounded p-lg-2">';
        foreach ($section as $s) :
            ?>
            <div class="col-sm-3">
                <div class="danger rounded text-center py-5">
                    <a href="<?= Url::to(['/product/index', 'section' => $s->id]) ?>" class="text-white">
                        <h4>
                            <b>
                                <img src="<?= Url::base() ?>/img/<?= $s->img ?>" class="rounded-circle" width="30px"
                                     height="30px">
                                <?= $s->name_uz ?>
                            </b>
                        </h4>
                    </a>
                </div>
            </div>
        <?php
        endforeach;
        echo '</div>';
    endif;
    if (isset($section) && Yii::$app->language == 'ru') :
        echo '<div class="row border rounded p-lg-2">';
        foreach ($section as $s) :
            ?>
            <div class="col-sm-3">
                <div class="danger rounded text-center py-5">
                    <a href="<?= Url::to(['/product/index', 'section' => $s->id]) ?>" class="text-white">
                        <h4>
                            <b>
                                <img src="<?= Url::base() ?>/img/<?= $s->img ?>" class="rounded-circle" width="30px"
                                     height="30px">
                                <?= $s->name_ru ?>
                            </b>
                        </h4>
                    </a>
                </div>
            </div>
        <?php
        endforeach;
        echo '</div>';
    endif; ?>
</div>
<div class="danger pb-3 my-1">
    <div class="px-lg-6">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1 class=""><b><?= Yii::t('app', 'Premium E’lonlar') ?></b></h1>
                <nav>
                    <div class="nav nav-tabs border-0 row justify-content-center" id="product" role="tablist">
                        <a class="nav-link active" id="top-product-tab" data-toggle="tab" href="#top-product" role="tab"
                           aria-controls="top-product" aria-selected="true">
                            <?= Yii::t('app', 'TOP tovarlar') ?>
                        </a>
                        <a class="nav-link" id="new-product-tab" data-toggle="tab" href="#new-product" role="tab"
                           aria-controls="new-product" aria-selected="false">
                            <?= Yii::t('app', 'Yangi tovarlar') ?>
                        </a>
                        <a class="nav-link" id="old-product-tab" data-toggle="tab" href="#old-product" role="tab"
                           aria-controls="old-product" aria-selected="false">
                            <?= Yii::t('app', 'Eski tovarlar') ?>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="top-product" role="tabpanel"
                         aria-labelledby="top-product-tab">
                        <?= ListView::widget([
                            'dataProvider' => $topProduct,
                            'itemView' => '_product',
                            'layout' => "{items}",
                            'options' => [
                                'class' => 'row justify-content-center my-2 my-sm-5'
                            ],
                            'itemOptions' => [
                                'class' => 'col-md-4 p-md-5'
                            ],
                            'emptyText' => '<div class="col-lg-12  text-center py-sm-5">
                            <h4 class=" ml-sm-5 text-center">' . Yii::t('app', 'Hech qanday e\'lon qo\'shilmagan!') . '😥</h4>
                            </div>',
                            'summary' => false
                        ]) ?>
                    </div>
                    <div class="tab-pane fade" id="new-product" role="tabpanel" aria-labelledby="new-product-tab">
                        <?= ListView::widget([
                            'dataProvider' => $newProduct,
                            'itemView' => '_product',
                            'layout' => "{items}",
                            'options' => [
                                'class' => 'row justify-content-center my-2 my-sm-5'
                            ],
                            'itemOptions' => [
                                'class' => 'col-md-4 p-md-5'
                            ],
                            'emptyText' => '<div class="col-lg-12  text-center py-sm-5">
                            <h4 class=" ml-sm-5 text-center">' . Yii::t('app', 'Hech qanday e\'lon qo\'shilmagan!') . '😥</h4>
                            </div>',
                            'summary' => false
                        ]) ?>
                    </div>
                    <div class="tab-pane fade" id="old-product" role="tabpanel" aria-labelledby="old-product-tab">
                        <?= ListView::widget([
                            'dataProvider' => $oldProduct,
                            'itemView' => '_product',
                            'layout' => "{items}",
                            'options' => [
                                'class' => 'row justify-content-center my-2 my-sm-5'
                            ],
                            'itemOptions' => [
                                'class' => 'col-md-4 p-md-5'
                            ],
                            'emptyText' => '<div class="col-lg-12  text-center py-sm-5">
                            <h4 class=" ml-sm-5 text-center">' . Yii::t('app', 'Hech qanday e\'lon qo\'shilmagan!') . '😥</h4>
                            </div>',
                            'summary' => false
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="<?= Url::to(['/product/']) ?>" class="btn btn-light btn-app px-5">
                    <?= Yii::t('app', 'all') ?>
                    <i class="fa fa-arrow-alt-circle-right text-danger"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="px-lg-6 mt-sm-5 mb-sm-3">

    <div class="row my-4">
        <div class="col-12 text-center">
            <h1><b class="text-uppercase"><?= Yii::t('app', 'Maxsus taklif') ?></b></h1>
        </div>
        <div class="col-12">
            <?= ListView::widget([
                'dataProvider' => $offers,
                'itemView' => '_offer',
                'itemOptions' => [
                    'class' => 'col-md-6 py-2 py-sm-5'
                ],
                'layout' => "{items}",
                'options' => [
                    'class' => 'row offer-view'
                ],
                'emptyText' => '',
                'summary' => false
            ]) ?>
        </div>
    </div>
    <?php if ($message) : ?>
        <div class="row my-5">
            <div class="col-12 text-center">
                <h1><b class="text-uppercase"><?= Yii::t('app', 'Mijozlarning fikrlari') ?></b></h1>
            </div>
            <div class="col">
                <div id="myCarousel5" class="carousel slide " data-ride="carousel">

                    <div class="carousel-inner">

                        <div class="carousel-item active" data-interval="3000">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <div class="text-center ">
                                        <h1><i class="fa fa-user my-sm-5"></i></h1>
                                        <p>
                                            <?= $message[0]->body ?>
                                        </p>
                                        <h5><b class="text-danger font-weight-bold"><?= $message[0]->name ?></b></h5>
                                        <b><?= $message[0]->job ?></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php for ($i = 1; $i < count($message); $i++) : ?>
                            <div class="carousel-item" data-interval="2000">
                                <div class="row">
                                    <div class="col-6 offset-3">
                                        <div class="text-center ">
                                            <h1><i class="fa fa-user my-sm-5"></i></h1>
                                            <p>
                                                <?= $message[$i]->body ?>
                                            </p>
                                            <h5><b class="text-danger font-weight-bold"><?= $message[$i]->name ?></b>
                                            </h5>
                                            <b><?= $message[$i]->job ?></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>

                    <button class="carousel-control-prev" type="button" data-target="#myCarousel5" data-slide="prev">
                        <i class="carousel-control-prev-icon fa fa-arrow-alt-circle-left" aria-hidden="true"></i>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#myCarousel5" data-slide="next">
                        <i class="carousel-control-next-icon fa fa-arrow-alt-circle-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row my-4">
        <div class="col-12 text-center">
            <h1><b class="text-uppercase"><?= Yii::t('app', 'Qo’shimcha xizmatlar') ?></b></h1>
        </div>
        <div class="col-12">
            <?= ListView::widget([
                'dataProvider' => $service,
                'itemView' => '_service',
                'itemOptions' => [
                    'class' => 'col-md-6 py-sm-5'
                ],
                'layout' => "{items}",
                'options' => [
                    'class' => 'row offer-view'
                ],
                'emptyText' => '',
                'summary' => false
            ]) ?>
        </div>
    </div>
</div>