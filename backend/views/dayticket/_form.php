<?php

use kartik\widgets\SwitchInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Dayticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dayticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'option_uz')->textarea(['rows' => 6, 'placeholder'=>'Har bir imkoniyatdan so\'ng nuqta qo\'yishni unutmang!']) ?>

    <?= $form->field($model, 'option_ru')->textarea(['rows' => 6, 'placeholder'=>'Har bir imkoniyatdan so\'ng nuqta qo\'yishni unutmang!']) ?>

    <?= $form->field($model, 'limit_uz')->textarea(['rows' => 6, 'placeholder'=>'Har bir cheklovdan so\'ng nuqta qo\'yishni unutmang!']) ?>

    <?= $form->field($model, 'limit_ru')->textarea(['rows' => 6, 'placeholder'=>'Har bir cheklovdan so\'ng nuqta qo\'yishni unutmang!']) ?>

    <?= $form->field($model, 'sale')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::class) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
