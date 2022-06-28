<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Footer */

$this->title = Yii::t('app', 'Yangilash: {name}', [
    'name' => $model->shortText,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Footers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->shortText, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Yangilash');
?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card p-md-3">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
