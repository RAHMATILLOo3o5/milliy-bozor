<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var \common\models\VerifyEmail $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'sign');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="px-lg-6 my-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="text-center">
                <img src="<?= Url::base() . '/images/Component 1.svg' ?>" alt="">

                <h2 class="my-2"><?= Html::encode($this->title); ?></h2>

                <p><?= Yii::t('app', 'Iltimos ro\'yhatdan o\'tish uchun kerakli maydonlarni to\'ldiring!') ?></p>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                    <div class="row">
                        <div class="col-sm-6 offset-sm-3 p-4">

                            <?= $form->field($model, 'email', ['enableAjaxValidation' => true]) ?>
                            <?= $form->field($model, 'captcha')->widget(
                                \himiklab\yii2\recaptcha\ReCaptcha2::class,
                                [
                                    'siteKey' => '6Le6-qIgAAAAACOeRN6QfQI83kyn0e8hyfz_Ser9',
                                ]
                            )->label(false) ?>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-3 mt-3">
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'sign'), ['class' => 'btn btn-outline-danger btn-block', 'name' => 'signup-button']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
