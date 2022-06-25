<?php

use backend\models\Section;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'section_id')->widget(
        Select2::class,
        [
            'data'=>ArrayHelper::map(Section::find()->where(['status'=>1])->all(), 'id', 'name_uz'),
            'options' => ['placeholder' => 'Bo\'limni tanlang ...'],
        ]
    ) ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::class) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
