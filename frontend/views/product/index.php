<?php

/**
 * @var $product \yii\data\ActiveDataProvider
 * @var $category \yii\data\ActiveDataProvider
 * @var $section Section
 */

use common\models\Province;
use frontend\models\Section;
use kartik\select2\Select2;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = Yii::t('app', 'Barcha E\'lonlar') . ' - Milliy Bozor';

?>

<div class="body px-lg-6 my-sm-5">
    <?php if (Yii::$app->request->get('q') && !empty(Yii::$app->request->get('q'))) : ?>
        <div class="row my-sm-3">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible d-none" id="success" role="alert">
                    <strong><?= Yii::t('app', 'Qidiruvga saqlandi!') ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="col-sm-6">
                <b style="font-size: 17px"><?= Yii::t('app', 'Sizning qidiruvingiz bo\'yicha topilgan e\'lonlar soni') . ' -  ' . $product->count ?></b>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?= Url::to(['component/search-like', 'q' => Yii::$app->request->get('q')]) ?>"
                   class="btn btn-danger search-like">
                    <?= Yii::t('app', 'Qidiruvni saqlash') ?>
                    <i class="fa fa-heart"></i>
                </a>
            </div>
        </div>
    <?php endif; ?>
    <div class="row mt-lg-3">
        <div class="col-lg-2">
            <label for="caty" class="font-weight-bolder"><?= Yii::t('app', 'Rukn:') ?></label>
            <?= Select2::widget([
                'name' => 'ProductQuery[section_id]',
                'data' => ArrayHelper::map(Section::find()->andWhere(['status' => 1])->all(), 'id', 'name_' . Yii::$app->language),
                'options' => [
                    'placeholder' => Yii::t('app', 'Rukn..'),
                    'id' => 'section-product',
                    'onchange' => '$.get("' . Url::to(['/product/index']) . '", {section: $(this).val()})
                        .done(function(data) {
                            $("#render-product").html(data);
                        });'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <label for="price" class="font-weight-bolder"><?= Yii::t('app', 'Narxi Sumda:') ?></label>
            <div class="d-flex">
                <?= Html::input('text', 'narx', null, [
                    'placeholder' => Yii::t('app', '...dan'),
                    'class' => 'form-control',
                    'style' => 'box-shadow:none;',
                    'onchange' => '
                        $.post( "' . Url::to(['product/index']) . '?price="+$(this).val(), function( data ) {
                            $("#render-product").html(data);
                        });'
                ]) ?>
                <?= Html::input('text', 'narx', null, [
                    'placeholder' => Yii::t('app', 'gacha'),
                    'class' => 'form-control ml-3',
                    'style' => 'box-shadow:none;',
                    'onchange' => '
                     $.post( "' . Url::to(['product/index']) . '?price="+$(this).val(), function( data ) {
                       $("#render-product").html(data);
                      });'
                ]) ?>
            </div>
        </div>
        <div class="col-lg-2">
            <label for="viloyat" class="font-weight-bolder"><?= Yii::t('app', 'Viloyat:') ?></label>
            <?= Select2::widget([
                'name' => 'province',
                'data' => ArrayHelper::map(Province::find()->all(), 'id', 'name'),
                'options' => [
                    'placeholder' => Yii::t('app', 'Viloyat..'),
                    'onchange' => '
                        $.get("' . Url::to(['/product/index']) . '", {province: $(this).val()})
                        .done(function(data) {
                            $("#render-product").html(data);
                        });'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4 px-lg-5">
            <div class="form-group">
                <label for="sort" class="font-weight-bolder"><?= Yii::t('app', 'Saralash:') ?></label>
                <?= Select2::widget([
                    'name' => 'sort',
                    'hideSearch' => true,
                    'data' => [
                        'SORT_DESC' => Yii::t('app', 'Yangi'),
                        'SORT_ASC' => Yii::t('app', 'Eski'),
                        'PRICE_DESC' => Yii::t('app', 'Qimmat'),
                        'PRICE_ASC' => Yii::t('app', 'Arzon'),
                    ],
                    'options' => [
                        'onchange' => '$.get("' . Url::to(['/product/index']) . '", {sort: $(this).val()})
                            .done(function(data) {
                                $("#render-product").html(data);
                            });'
                    ]
                ]) ?>
            </div>
        </div>
    </div>
    <div class="row mt-lg-1 d-none d-md-flex">
        <div class="col">
            <?= ListView::widget([
                'dataProvider' => $category,
                'itemView' => '_category',
                'options' => [
                    'class' => 'sorts my-4 row'
                ],
                'itemOptions' => [
                    'class' => 'p-2'
                ],
                'emptyText' => '',
                'layout' => "{items}\n",
            ]) ?>
        </div>
    </div>

    <div class="row mt-md-4">
        <div class="col sorts">
            <?php if ($section) : foreach ($section as $s) : ?>
                <a href="<?= Url::to(['product/index', 'section' => $s->id]) ?>"><b><?= $s->name_uz ?> <span
                                class="text-danger"><?= count($s->products) ?></span></b>
                </a>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
    <?php \yii\widgets\Pjax::begin(['id' => 'render-product']) ?>
    <?= $this->render('_product', compact('product')) ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
<?php
$js = <<<JS
    $('.search-like').click(function(e) {
      e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: 'POST',
            success: function(data) {
                if (data.status === 'success') {
                    $('#success').removeClass('d-none');
                }
            }
        });
    });
JS;
$this->registerJs($js);
?>

