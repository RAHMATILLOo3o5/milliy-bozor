<?php

use common\models\Tumanlar;
use kartik\file\FileInput;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_uz')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content_ru')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'img')->widget(FileInput::class) ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
        'name' => 'phone',
        'mask' => '\+\9\9\8 99 999-99-99',
        'options' => [
            'placeholder' => '+998 99 999-99-99',
            'class' => 'form-control',
        ],
    ]); ?>

    <?= $form->field($model, 'province_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(\common\models\Province::find()->all(), 'id', 'name'),
        'options' => [
            'placeholder' => Yii::t('app', 'Viloyat tanlang')
        ]
    ]); ?>
    <?= $form->field($model, 'tuman_id')->widget(DepDrop::class, [
        'data' => ArrayHelper::map(Tumanlar::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Tuman tanlang')],
        'type' => DepDrop::TYPE_SELECT2,
        'pluginOptions' => [
            'depends' => ['service-province_id'],
            'url' => Url::to(['/offer/tuman'])
        ]
    ]); ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::class) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>