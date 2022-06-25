<?php

use backend\models\Category;
use backend\models\Section;
use kartik\depdrop\DepDrop as DepDropAlias;
use kartik\editors\Summernote;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows'=>8]) ?>


    <?= $form->field($model, 'section_id')->widget(
        Select2::class,
        [
            'data' => ArrayHelper::map(Section::find()->where(['status' => 1])->all(), 'id', 'name_uz'),
            'options' => ['placeholder' => Yii::t('app', 'Bo\'limni tanlang').' ...'],
        ]
    ) ?>

    <?= $form->field($model, 'category_id')->widget(
        DepDrop::class,
        [
            'data' => ArrayHelper::map(Category::find()->where(['status' => 1])->all(), 'id', 'name_uz'),
            'options' => ['placeholder' => Yii::t('app', 'Kategoriyani tanlang').' ...'],
            'type' => DepDropAlias::TYPE_SELECT2,
            'pluginOptions' => [
                'depends' => ['product-section_id'],
                'url' => Url::to(['/product/caty']),
                'loadingText' => Yii::t('app', 'Kategoriyalar yuklanmoqda').' ...',
            ]
        ]
    ) ?>

    <?= $form->field($model, 'img[]')->widget(
        FileInput::class,
        [
            'options' => ['multiple' => true]
        ]
    ) ?>
    <?= $form->field($model, 'is_top')->widget(
        SwitchInput::class
    )->label('Premium yoki Premium emas ?') ?>
    <?= $form->field($model, 'status')->widget(
        SwitchInput::class
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>