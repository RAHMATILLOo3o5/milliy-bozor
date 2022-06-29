<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Connect */

$this->title = 'Raqamni tahrirlash: ' . $model->phone;
$this->params['breadcrumbs'][] = ['label' => 'Raqamlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->phone, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Tahrirlash';
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