<?php

use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\Connect */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="connect-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
        'name' => 'phone',
        'mask' => '\+\9\9\8 99 999-99-99',
        'options' => [
            'placeholder' => '+998 99 999-99-99',
            'class' => 'form-control',
        ],
    ]); ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::class) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>