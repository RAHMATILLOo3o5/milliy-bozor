<?php

use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use yii\widgets\MaskedInput;

$this->title = Yii::t('app', 'Profil Setting');

/**
 * @var $model \common\models\User
 */

$slug = Yii::$app->security->generateRandomString(40);

?>

<div class="px-lg-6 mt-sm-3 mb-sm-5">
    <div class="row p-lg-5">
        <div class="col-sm-10 offset-sm-1">
            <div class="card">
                <div class="card-header danger">
                    <div class="card-title text-center">
                        <h3><?= Yii::$app->user->identity->username ?></h3>
                        <p><?= Yii::t('app', '"Milliy Bozor" ga tashrif buyurgan vaqti') ?>
                            <b><?= date('d.m.y', Yii::$app->user->identity->created_at) ?></b></p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-md-column flex-row nav-pills setting" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                   role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    <?= Yii::t('app', 'login2') ?>
                                </a>
                                <a class="nav-link" id="v-pills-parol-tab" data-toggle="pill" href="#v-pills-parol"
                                   role="tab" aria-controls="v-pills-parol" aria-selected="true">
                                    <?= Yii::t('app', 'parol') ?>
                                </a>
                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                                   role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                    <?= Yii::t('app', 'shaxsiy') ?>
                                </a>
                                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill"
                                   href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                                   aria-selected="false">
                                    <?= Yii::t('app', 'chiqish') ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                     aria-labelledby="v-pills-home-tab">
                                    <form action="<?= Url::to(['/setting/login-setting', 'id' => $model->id]) ?>"
                                          method="post">
                                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                                               value="<?= Yii::$app->request->csrfToken ?>">
                                        <div class="form-group row">
                                            <label for="inputName"
                                                   class="col-md-2 col-form-label"><?= Yii::t('app', 'login2') ?></label>
                                            <div class="col-md-10">
                                                <input type="text" name="username" readonly required id="inputName"
                                                       class="form-control" value="<?= $model->username ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="v-pills-parol" role="tabpanel"
                                     aria-labelledby="v-pills-parol-tab">
                                    <form class="form-horizontal"
                                          action="<?= Url::to(['/setting/password-setting', 'id' => $model->id]) ?>"
                                          method="post">
                                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                                               value="<?= Yii::$app->request->csrfToken ?>">
                                        <div class="form-group row">
                                            <label for="inputName"
                                                   class="col-md-5 col-form-label"><?= Yii::t('app', 'Yangi parol') ?></label>
                                            <div class="col-md-7">
                                                <input type="password" class="form-control" required name="password"
                                                       id="inputName"
                                                       placeholder="<?= Yii::t('app', 'Yangi parol') ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail"
                                                   class="col-md-5 col-form-label"><?= Yii::t('app', 'Parolni tasdiqlash') ?></label>
                                            <div class="col-md-7">
                                                <input type="password" class="form-control" required id="inputEmail"
                                                       placeholder="<?= Yii::t('app', 'Parolni tasdiqlash') ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail2"
                                                   class="col-md-5 col-form-label"><?= Yii::t('app', 'Joriy Parol') ?></label>
                                            <div class="col-md-7">
                                                <input type="password" class="form-control" required name="oldPassword"
                                                       id="inputEmail2"
                                                       placeholder="<?= Yii::t('app', 'Joriy Parol') ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-md-2 col-md-10 text-right">
                                                <?= Html::submitButton(Yii::t('app', 'O\'zgartirish'), ['class' => 'btn btn-primary']) ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                     aria-labelledby="v-pills-profile-tab">
                                    <?php $form = ActiveForm::begin([
                                        'action' => Url::to(['/setting/data-setting', 'id' => $model->id])
                                    ]); ?>

                                    <?= $form->field($model, 'province_id')->widget(Select2::class, [
                                        'data' => ArrayHelper::map(\common\models\Province::find()->all(), 'id', 'name'),
                                        'options' => [
                                            'placeholder' => Yii::t('app', 'Viloyat tanlang')
                                        ]
                                    ]); ?>
                                    <?= $form->field($model, 'tuman_id')->widget(DepDrop::class, [
                                        'data' => ArrayHelper::map(\common\models\Tumanlar::find()->all(), 'id', 'name'),
                                        'options' => ['placeholder' => Yii::t('app', 'Tuman tanlang')],
                                        'type' => DepDrop::TYPE_SELECT2,
                                        'pluginOptions' => [
                                            'depends' => ['user-province_id'],
                                            'url' => Url::to(['/component/tuman'])
                                        ]
                                    ]); ?>

                                    <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                                        'name' => 'phone',
                                        'mask' => '\+\9\9\8 99 999-99-99',
                                        'options' => [
                                            'placeholder' => '+998 99 999-99-99',
                                            'class' => 'form-control',
                                        ],
                                    ]); ?>

                                    <div class="form-group text-right">
                                        <?= Html::submitButton(Yii::t('app', Yii::t('app', 'O\'zgartirish')), ['class' => 'btn btn-primary']) ?>
                                    </div>
                                    <?php ActiveForm::end(); ?>

                                </div>
                                <div class="tab-pane text-center fade" id="v-pills-settings" role="tabpanel"
                                     aria-labelledby="v-pills-settings-tab">
                                    <?= Html::a(Yii::t('app', 'Akkauntdan chiqish'), ['site/logout'], [
                                        'class' => 'btn btn-warning',
                                        'data' => [
                                            'confirm' => 'Rostdan ham "Milliy Bozor" dan chiqmoqchimisiz?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                    <?= Html::a(Yii::t('app', Yii::t('app', 'Akkauntdan o\'chirish')), ['setting/delete-account', 'id' => $model->id, 's' => $slug], [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Rostdan ham "Milliy Bozor" ni tark etmoqchimisiz? Bu harakatingiz orqali "Milliy Bozor" dagi barcha ma\'lumotlaringizni o\'chirasiz.',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>