<?php

use Codeception\Lib\Generator\Actions;
use common\models\Like;
use common\models\Seen;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\bootstrap4\Breadcrumbs;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/**
 * @var $product \common\models\Product
 * @var $alike \common\models\Product[]
 * @var $alike_count int
 * @var $message \common\models\Message
 */

$this->title = $product->name;
if (Yii::$app->language == 'uz') {
    $this->params['breadcrumbs'][] = ['label' => $product->section->name_uz, 'url' => ['/product/index']];
    $this->params['breadcrumbs'][] = ['label' => $product->category->name_uz, 'url' => ['/product/index']];
} else {
    $this->params['breadcrumbs'][] = ['label' => $product->section->name_ru, 'url' => ['/product/index']];
    $this->params['breadcrumbs'][] = ['label' => $product->category->name_ru, 'url' => ['/product/index']];
}
$this->params['breadcrumbs'][] = $this->title;

//\yii\helpers\VarDumper::dump(, 10, true);
?>
<div class="row">
    <div class="col-2 offset-5">

    </div>
</div>
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
    <div class="row border rounded p-sm-5 mb-5">
        <div class="col-lg-7">
            <div id="carouselExampleIndicators" class="carousel slide single-product" data-ride="carousel">
                <ol class="carousel-indicators">

                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <?php for ($i = 1; $i < count($product->img); $i++) : ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>"></li>
                    <?php endfor; ?>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?= Yii::getAlias('@getimg') . '/' . $product->img[0] ?>"
                             class="d-block w-100 img-fluid rounded" alt="...">
                    </div>
                    <?php for ($i = 1; $i < count($product->img); $i++) : ?>
                        <div class="carousel-item">
                            <img src="<?= Yii::getAlias('@getimg') . '/' . $product->img[$i] ?>"
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
        <div class="col-lg-5 danger rounded p-4 mx-3 m-sm-0 p-sm-5">
            <div class="ribbon <?= ($product->is_top == 0) ? 'd-none' : ''; ?>">
                <i class="fa fa-crown"></i>
            </div>
            <h4><?= Yii::t('app', 'Foydalanuvchi:') ?></h4>
            <div class="row my-3">
                <div class="col-2">
                    <img src="<?= Yii::getAlias('@defaultImgPath') ?>/user_white.png">
                </div>
                <div class="col-8 user-info">
                    <b><?= $product->user->username ?></b>
                    <p class="text-black-50"><?= Yii::t('app', 'So\'ngi faollik') ?>
                        : <?= $product->user->seen->formatTime ?> </p>
                    <a href="#"><?= Yii::t('app', 'Foydalanuvchining boshqa e\'lonlari') ?></a>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <a href="tel:<?= $product->user->phone ?>" class="btn btn-light"> <i class="fa fa-phone"></i>
                        <b><?= Yii::t('app', 'Qo\'ng\'iroq qilish') ?></b> </a>
                </div>
                <div class="col-6">
                    <a href="#xabar" class="btn btn-outline-light"> <i class="fa fa-message"></i>
                        <b><?= Yii::t('app', 'Xabar yozish') ?></b> </a>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-6">
                    <h4><?= Yii::t('app', 'Joylashuv') ?>:</h4>
                    <p>
                        <a href="https://maps.google.com/maps?q=<?= $product->user->map ?>&t=&z=9&ie=UTF8&iwloc"
                           target="_blank" class="text-light"><?= Yii::t('app', 'Google xaritadan ochish') ?></a>
                    </p>
                    <div class="text-secondary">
                        <i class="fa fa-location-dot"></i>
                        <span><?= $product->user->province->name ?></span><span> / </span>
                        <span><?= $product->user->tuman->name ?> /</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mapouter">
                        <a href="https://maps.google.com/maps?q=<?= $product->user->map ?>&t=&z=9&ie=UTF8&iwloc"
                           target="_blank">
                            <div class="gmap_canvas">
                                <iframe width="160" height="110" id="gmap_canvas"
                                        src="https://maps.google.com/maps?q=<?= $product->user->map ?>&t=&z=9&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                <a href="https://www.whatismyip-address.com/divi-discount/">divi discount</a><br>
                                <style>.mapouter {
                                        position: relative;
                                        text-align: right;
                                        height: 110px;
                                        width: 160px;
                                    }</style>
                                <a href="https://www.embedgooglemap.net"></a>
                                <style>.gmap_canvas {
                                        overflow: hidden;
                                        background: none !important;
                                        height: 110px;
                                        width: 160px;
                                    }</style>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row border rounded mb-5 p-sm-5">
        <div class="col-lg-7">
            <div class="danger  rounded p-4 m-sm-0 p-sm-5">
                <div class="mb-3">
                    <p class="text-secondary m-0"><?= Yii::t('app', 'Joylashtirldi:') . ' ' . date('d.m.Y', $product->created_at) ?> </p>
                    <h4><?= $product->name ?></h4>
                </div>
                <div class="my-5 product-info">
                    <h3><?= number_format($product->price, 0, ' ', ' ') ?> sum</h3>
                    <i class="fa fa-heart"></i>
                    <a href=" <?= Url::to(['component/like', 'id' => $product->id]) ?>" class="text-secondary order">
                        <?php
                        if (!Yii::$app->user->isGuest && Like::findOne(['user_id' => Yii::$app->user->id, 'product_id' => $product->id]) !== null) {
                            echo Yii::t('app', 'Yoqtirilganlarga o\'chirish');
                        } else {
                            echo Yii::t('app', 'Yoqtirilganlarga qo\'shish');
                        }
                        ?>
                    </a>
                    <p class="mt-4"><i class="fa-solid fa-user mr-3"></i> <?= $product->user->username ?> </p>
                </div>
                <h4><?= Yii::t('app', 'Tavsif') ?>:</h4>
                <p class="text-secondary my-sm-5">
                    <?= $product->description ?>
                </p>
                <div class="bg-white rounded py-sm-3 px-sm-4 d-flex justify-content-between">
                    <b>ID : <?= $product->id ?></b>
                    <b><?= Yii::t('app', 'Ko\'rishlar') ?> : <?= $product->viewCount ?></b>
                    <b><i class="fa fa-flag text-danger mr-1"></i><a href="#" class="spam">Shikoyat qilish</a></b>
                </div>
            </div>
        </div>
        <div class="col-lg-5" id="xabar">
            <div class="danger rounded p-4 m-sm-0 p-sm-5 ">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible d-none" id="message-alert" role="alert">
                            <strong><?= Yii::t('app', 'Xabar yuborildi') ?>!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <h4><?= Yii::t('app', 'Foydalanuvchi:') ?></h4>
                <div class="row my-3">
                    <div class="col-2">
                        <img src="<?= Yii::getAlias('@defaultImgPath') ?>/user_white.png" alt="">
                    </div>
                    <div class="col-8 user-info">
                        <b><?= $product->user->username ?></b>
                        <p class="p-0 m-0"><?= $product->user->phone ?></p>
                        <p class="text-black-50 p-0 m-0"><?= Yii::t('app', 'So\'ngi faollik') ?>
                            : <?= $product->user->seen->formatTime ?> </p>
                    </div>
                </div>
                <div class="row">
                    <?php $form = ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => "{input}",
                            'options' => ['tag' => false],
                        ],
                        'options' => [
                            'id' => 'message-form',
                            'enctype' => 'multipart/form-data',
                        ],
                        'action' => Url::to(['/message/send']),
                    ]); ?>
                    <?= $form
                        ->field($message, 'message')
                        ->textarea(['placeholder' => Yii::t('app', Yii::t('app', "Xabar yozish...")), 'id' => 'message-text', 'class' => "rounded w-100", 'rows' => 6, 'style' => 'resize:none;'])
                        ->label(false);
                    ?>
                    <?= $form->field($message, 'from')->hiddenInput(['value' => $product->user->id]); ?>
                    <style>
                        .help-block {
                            display: none !important;
                        }
                    </style>
                    <div class="mt-3 d-flex justify-content-sm-between">
                        <label class="mr-sm-5 form-label">
                            <i class="fa fa-file-alt"></i>
                            <?= Yii::t('app', 'Fayl biriktirish') ?>
                            <?= $form->field($message, 'image')->fileInput(['class' => 'file', 'multiple' => true])->label(false); ?>
                        </label>
                        <?= \yii\bootstrap4\Html::submitInput(Yii::t('app', 'Yuborish'), ['class' => 'btn disabled btn-outline-light ml-sm-5 py-1 px-4 send']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>
    </div>

    <!--    <div class="row border rounded mb-5 p-sm-5">-->
    <!--        <div class="row">-->
    <!--            <p class="title">O’xshash e’lonlar:</p>-->
    <!--        </div>-->
    <!--        <div class="owl-carousel owl-carouse_2 owl-theme owl-loaded">-->
    <!--            <div class="owl-stage-outer">-->
    <!--                <div class="owl-stage">-->
    <!--                    <div class="owl-item">-->
    <!--                        <img src="./images/acer.jpg" alt="">-->
    <!--                        <div class="margin">-->
    <!--                            <div class="titles">-->
    <!--                                <p class="title">Acer Gaming i7</p>-->
    <!--                                <i class="fa fa-heart" aria-hidden="true"></i>-->
    <!--                            </div>-->
    <!--                            <div class="state">-->
    <!--                                <p href="#">Toshkent</p>-->
    <!--                                <i class="fa-solid fa-location-dot" aria-hidden="true"></i>-->
    <!--                            </div>-->
    <!--                            <div class="prices">-->
    <!--                                <p class="price"> 1.000.000 UZS</p>-->
    <!--                                <a href="" class="btn">Batafsil</a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="owl-item">-->
    <!--                        <img src="./images/rtx.jpg" alt="">-->
    <!--                        <div class="margin">-->
    <!--                            <div class="titles">-->
    <!--                                <p class="title">Acer Gaming i7</p>-->
    <!--                                <i class="fa fa-heart" aria-hidden="true"></i>-->
    <!--                            </div>-->
    <!--                            <div class="state">-->
    <!--                                <p href="#">Toshkent</p>-->
    <!--                                <i class="fa-solid fa-location-dot" aria-hidden="true"></i>-->
    <!--                            </div>-->
    <!--                            <div class="prices">-->
    <!--                                <p class="price"> 1.000.000 UZS</p>-->
    <!--                                <a href="" class="btn">Batafsil</a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="owl-item">-->
    <!--                        <img src="./images/asus.jpg" alt="">-->
    <!--                        <div class="margin">-->
    <!--                            <div class="titles">-->
    <!--                                <p class="title">Acer Gaming i7</p>-->
    <!--                                <i class="fa fa-heart" aria-hidden="true"></i>-->
    <!--                            </div>-->
    <!--                            <div class="state">-->
    <!--                                <p href="#">Toshkent</p>-->
    <!--                                <i class="fa-solid fa-location-dot" aria-hidden="true"></i>-->
    <!--                            </div>-->
    <!--                            <div class="prices">-->
    <!--                                <p class="price"> 1.000.000 UZS</p>-->
    <!--                                <a href="" class="btn">Batafsil</a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="owl-item">-->
    <!--                        <img src="./images/asus.jpg" alt="">-->
    <!--                        <div class="margin">-->
    <!--                            <div class="titles">-->
    <!--                                <p class="title">Acer Gaming i7</p>-->
    <!--                                <i class="fa fa-heart" aria-hidden="true"></i>-->
    <!--                            </div>-->
    <!--                            <div class="state">-->
    <!--                                <p href="#">Toshkent</p>-->
    <!--                                <i class="fa-solid fa-location-dot" aria-hidden="true"></i>-->
    <!--                            </div>-->
    <!--                            <div class="prices">-->
    <!--                                <p class="price"> 1.000.000 UZS</p>-->
    <!--                                <a href="" class="btn">Batafsil</a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="owl-item">-->
    <!--                        <img src="./images/asus.jpg" alt="">-->
    <!--                        <div class="margin">-->
    <!--                            <div class="titles">-->
    <!--                                <p class="title">Acer Gaming i7</p>-->
    <!--                                <i class="fa fa-heart" aria-hidden="true"></i>-->
    <!--                            </div>-->
    <!--                            <div class="state">-->
    <!--                                <p href="#">Toshkent</p>-->
    <!--                                <i class="fa-solid fa-location-dot" aria-hidden="true"></i>-->
    <!--                            </div>-->
    <!--                            <div class="prices">-->
    <!--                                <p class="price"> 1.000.000 UZS</p>-->
    <!--                                <a href="" class="btn">Batafsil</a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
</div>
<?php
Modal::begin([
    'title' => '<h2>Batafsil</h2>',
    'toggleButton' => [
        'tag' => 'button',
        'class' => 'btn btn-danger py-0 px-2 ml-sm-4',
        'label' => 'Batafsil'
    ],
    'id' => 'modal',
    'size' => 'modal-lg',
    'footer' => '<button class="btn btn-danger" data-dismiss="modal">Batafsil</button>',
]);

Modal::end();

$js = <<<JS

$('.order').on('click', function(e) {
  e.preventDefault();
  let like = $(this); 
  let url = $(this).attr('href');
  $.ajax({
        type:'POST',
        url:url,
        dataType:'json',
        success:function(data) {
          if (data.status === 'success'){
              like.text('Yoqtirilganlardan o\'chirish');
          }
        },
        error:function (data){
            console.log(data);
            return false;
        }
    });
});

JS;
$this->registerJs($js);
?>
