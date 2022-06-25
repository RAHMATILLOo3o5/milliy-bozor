<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var \frontend\models\SignupForm $model */

use kartik\widgets\DepDrop;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;

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
                        <div class="col-sm-6">
                            <?= $form->field($model, 'username')->textInput(['readonly' => 'readonly']) ?>

                            <?= $form->field($model, 'email')->textInput(['readonly' => 'readonly']) ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>
                            <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'province_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map(\common\models\Province::find()->all(), 'id', 'name'),
                                'options'=>[
                                    'placeholder' => Yii::t('app', 'Viloyat tanlang')
                                ]
                            ]); ?>
                            <?= $form->field($model, 'tuman_id')->widget(DepDrop::class, [
                                'data' => ArrayHelper::map(\common\models\Tumanlar::find()->all(), 'id', 'name'),
                                'options' => ['placeholder' => Yii::t('app', 'Tuman tanlang')],
                                'type' => DepDrop::TYPE_SELECT2,
                                'pluginOptions' => [
                                    'depends' => ['signupform-province_id'],
                                    'url' => Url::to(['/component/tuman'])
                                ]
                            ]); ?>
                            <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                                'name' => 'phone',
                                'mask' => '\+\9\9\8 99 999-99-99',
                                'options' => [
                                    'class' => 'form-control',
                                ],
                            ]); ?>

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