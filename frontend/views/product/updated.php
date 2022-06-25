<?php

use backend\models\Category;
use frontend\models\Section;
use kartik\widgets\DepDrop;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

$this->title = Yii::t('app', 'Yangi e\'lon qo\'shish') . ' | ' . Yii::$app->name;

/**
 * @var $model \common\models\Product
 * @var $form yii\bootstrap4\ActiveForm
 * @var $user \common\models\User
 */
?>
<style>
    .invalid-feedback {
        color: #ffe1e4 !important;
    }
</style>
<div class="px-lg-6 mt-sm-5 mb-sm-3">
    <?php $form = ActiveForm::begin([
        'id' => 'new-product-form',
        'options' => [
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>
    <div class="row">
        <div class="text-center text-md-left">
            <div class="col-12">
                <h3><b><?= Yii::t('app', 'E\'lon joylashtirish') ?></b></h3>
            </div>
        </div>
        <div class="col-12 rounded danger p-5">
            <h5><?= Yii::t('app', 'Bizga e\'loningiz haqida gapirib bering') ?></h5>
            <div class="row ">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group my-sm-5">
                                <?= $form->field($model, 'name')->textInput(['placeholder' => Yii::t('app', "Masalan, iPhone 13 kafolati bilan")])->label(false) ?>
                            </div>
                            <div class="form-group my-sm-5">
                                <?= $form->field($model, 'price')->textInput(['placeholder' => Yii::t('app', "Mahsulotingizga narx belgilang")])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?= $form->field($model, 'section_id')->widget(
                                        Select2::class,
                                        [
                                            'data' => ArrayHelper::map(Section::find()->where(['status' => 1])->all(), 'id', 'name_' . Yii::$app->language),
                                            'options' => ['placeholder' => Yii::t('app', 'Bo\'limni tanlang') . ' ...'],
                                        ]
                                    ) ?>
                                </div>
                                <div class="col-lg-6">
                                    <?= $form->field($model, 'category_id')->widget(
                                        DepDrop::class,
                                        [
                                            'data' => ArrayHelper::map(Category::find()->where(['status' => 1])->all(), 'id', 'name_' . Yii::$app->language),
                                            'options' => ['placeholder' => Yii::t('app', 'Kategoriyani tanlang') . ' ...'],
                                            'type' => DepDrop::TYPE_SELECT2,
                                            'pluginOptions' => [
                                                'depends' => ['product-section_id'],
                                                'url' => Url::to(['/component/caty']),
                                                'loadingText' => Yii::t('app', 'Kategoriyalar yuklanmoqda') . ' ...',
                                            ]
                                        ]
                                    ) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-12 rounded danger my-sm-3 p-5">
            <h5><?= Yii::t('app', 'Rasmlar') ?></h5>
            <div class="row ">
                <div class="col-lg-8 p-4 bg-white rounded">
                    <?= $form->field($model, 'img[]')->widget(FileInput::class,
                        [
                            'options' => [
                                'accept' => 'image/*',
                                'multiple' => true,
                            ],
                        ]) ?>
                </div>
            </div>
        </div>
        <div class="col-12 rounded danger my-sm-3 p-5">
            <h5><?= Yii::t('app', 'Tavsif') ?></h5>
            <div class="row ">
                <div class="col-lg-8">
                    <div class="form-group">
                        <?= $form->field($model, 'description')->textarea([
                            'placeholder' => Yii::t('app', "O’zingizni shu e'lonni ko’rayotgan odam o’rniga qo’ying va tavsif yozing"),
                            'rows' => 10
                        ])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 rounded danger my-sm-3 p-5">
            <h5 class="my-2"><?= Yii::t('app', 'Aloqa uchun ma’lumotlar') ?></h5>
            <div class="row ">
                <div class="col-md-5">
                    <div class="form-group">
                        <?= $form->field($user, 'province_id')->widget(Select2::class, [
                            'data' => ArrayHelper::map(\common\models\Province::find()->all(), 'id', 'name'),
                            'options' => [
                                'placeholder' => Yii::t('app', 'Viloyat tanlang')
                            ]
                        ]) ?>
                        <?= $form->field($user, 'tuman_id')->widget(DepDrop::class, [
                            'data' => ArrayHelper::map(\common\models\Tumanlar::find()->all(), 'id', 'name'),
                            'options' => ['placeholder' => Yii::t('app', 'Tuman tanlang')],
                            'type' => DepDrop::TYPE_SELECT2,
                            'pluginOptions' => [
                                'depends' => ['signupform-province_id'],
                                'url' => Url::to(['/component/tuman'])
                            ]
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label for=""><?= Yii::t('app', 'Murojaat qiluvchi shaxs*') ?> </label>
                        <?= $form->field($user, 'username')->textInput(['readonly' => 'readonly'])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <label for=""> <?= Yii::t('app', 'Email*') ?> </label>
                        <?= $form->field($user, 'email')->textInput(['readonly' => 'readonly'])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($user, 'phone')->widget(MaskedInput::class, [
                            'name' => 'phone',
                            'mask' => '\+\9\9\8 99 999-99-99',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ]); ?>
                    </div>
                    <div class="d-flex justify-content-md-between">
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'E\'lonni joylashtirish'), ['class' => 'btn btn-light', 'name' => 'signup-button']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

