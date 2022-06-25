<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Dayticket */

$this->title = Yii::t('app', 'Yangi kunlik obuna');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kunlik obunalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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