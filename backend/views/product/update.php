<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = 'E\'lonni tahrirlash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'E\'lonlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->slug]];
$this->params['breadcrumbs'][] = 'tahrirlash';
?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card p-1">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
