<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Service */

$this->title =  $model->title_uz;
$this->params['breadcrumbs'][] = ['label' => 'Xizmatlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title_uz, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card p-2">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
