<?php

use frontend\models\Section;
use yii\helpers\Url;
use yii\bootstrap4\Breadcrumbs;

/**
 * @var $this \yii\web\View
 * @var $model \common\models\Product
 *
 */

$this->title = $model->name;
if (Yii::$app->language == 'ru') {
    $this->params['breadcrumbs'][] = ['label' => $model->section->name_ru, 'url' => ['/product/index']];
    $this->params['breadcrumbs'][] = ['label' => $model->category->name_ru, 'url' => ['/product/index']];
} else {
    $this->params['breadcrumbs'][] = ['label' => $model->section->name_uz, 'url' => ['/product/index']];
    $this->params['breadcrumbs'][] = ['label' => $model->category->name_uz, 'url' => ['/product/index']];
}
$this->params['breadcrumbs'][] = $this->title;
$slug = Yii::$app->security->generateRandomString(20);
?>

<div class="body px-lg-6 my-sm-5">

    <div class="row">

        <div class="col">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'homeLink' => [
                    'label' => '<i class="fa fa-arrow-left"></i> <b>' . Yii::t('app', 'Orqaga') . '</b>',
                    'url' => Yii::$app->homeUrl,
                    'encode' => false,
                ]
            ]) ?>
        </div>

    </div>

    <div class="row mb-4">
        <div class="col-md-5 offset-md-4 text-center">
            <a href="<?= Url::to(['/product/updated', 'id' => $model->slug, 's' => $slug]) ?>" class="btn btn-primary">
                <?= Yii::t('app', 'O\'zgartirish') ?>
                <i class="fa fa-pencil"></i>
            </a>
            <a href="<?= Url::to(['/product/save', 'id' => $model->slug, 's' => $slug]); ?>"
               class="btn btn-success mx-sm-3">
                <?= Yii::t('app', 'Saqlash') ?>
                <i class="fa fa-save"></i>
            </a>
            <a href="<?= Url::to(['/product/delete', 'id' => $model->slug, 's' => $slug]) ?>" class="btn btn-danger">
                <?= Yii::t('app', 'O\'chirish') ?>
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>

    <div class="row border rounded p-sm-5 mb-5">

        <div class="col-lg-7">
            <div id="carouselExampleIndicators" class="carousel slide single-product" data-ride="carousel">
                <ol class="carousel-indicators">

                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <?php for ($i = 1; $i < count($model->img); $i++) : ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>"></li>
                    <?php endfor; ?>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?= Yii::getAlias('@getimg') . '/' . $model->img[0] ?>"
                             class="d-block w-100 img-fluid rounded" alt="...">
                    </div>
                    <?php for ($i = 1; $i < count($model->img); $i++) : ?>
                        <div class="carousel-item">
                            <img src="<?= Yii::getAlias('@getimg') . '/' . $model->img[$i] ?>"
                                 class="d-block  w-100 img-fluid rounded" alt="...">
                        </div>
                    <?php endfor; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                        data-slide="prev">
                    <span class="carousel-control-prev-icon fa fa-arrow-circle-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                        data-slide="next">
                    <i class="carousel-control-next-icon fa fa-arrow-circle-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        </div>

        <div class="col-lg-5 danger rounded mx-3 m-sm-0">
            <div class="ribbon <?= ($model->is_top == 0) ? 'd-none' : ''; ?>">
                <i class="fa fa-crown"></i>
            </div>
            <div class="danger  rounded m-sm-0 p-sm-5">
                <div class="mb-3">
                    <p class="text-secondary m-0"><?= Yii::t('app', 'Joylashtirldi:') ?> <?= date('h:i  d.M.y', $model->created_at) ?></p>
                    <h4><?= $model->name ?></h4>
                </div>
                <div class="my-5 product-info">
                    <h3><?= number_format($model->price, 0, ' ', ' ') . ' sum' ?></h3>
                    <p class="mt-4 mb-0"><i class="fa-solid fa-user mr-3"></i> <?= Yii::t('app', 'Jismoniy shaxs') ?> </p>
                    <p><?= $model->user->username ?></p>
                </div>
                <h4><?= Yii::t('app', 'Tavsif:') ?></h4>
                <p class="text-secondary my-sm-5">
                    <?= $model->description ?>
                </p>
            </div>
        </div>
    </div>


</div>