<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var \frontend\models\ContactForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Milliy Bozor ' . Yii::t('app', 'haqida fikringiz');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="px-lg-6 my-5">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="site-contact">
                <h2 class="text-center">
                    <?= Yii::t('app', 'Fikringiz') ?>
                </h2>
                <p class="text-center">
                    <?= Yii::t('app', 'Biz uchun sizning fikringiz muhim!'); ?>
                </p>

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'job') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>


                <?= $form->field($model, 'reCaptcha')->widget(
                    \himiklab\yii2\recaptcha\ReCaptcha3::class,
                    [
                        'siteKey' => '6LdK-qIgAAAAAKL2_92Q1o2LQyHbHPf5Tv9EyPOf',
                        'action' => 'homepage',
                    ]
                )->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Jo\'natish'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
