<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var \common\models\LoginForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'login') . ' - Milliy Bozor';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="px-lg-6 my-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="text-center">
                <img src="<?= Yii::getAlias('@defaultImgPath').'/Component 1.svg' ?>" alt="">
                <h3 class="my-2"><?= Yii::t('app', 'Kirish - Bizga qo\'shiling') ?></h3>
                <p><?= Yii::t('app', 'Iltimos kirish uchun kerakli maydonlarni to\'ldiring!') ?></p>
            </div>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput() ?>

            <?= $form->field($model, 'password')->passwordInput() ?>


            <?= $form->field($model, 'rememberMe')->checkbox()->label(Yii::t('app', 'Meni eslab qol!')) ?>

            <div style="color:#999;" class=" text-center my-3">
                <?= Html::a(Yii::t('app', 'Avval ro\'yhatdan o\'tmagan bo\'lsangiz'), ['site/signup']) ?>
                <br>
            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'login'), ['class' => 'btn btn-danger btn-block', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
