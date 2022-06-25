<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Dayticket */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daytickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
// VarDumper::dump($model->optionuz, 10, true);
?>
<div class="card p-md-5">


    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute'=>'option_uz',
                'format'=>'html',
                'value'=>$model->optionuz
            ],
            [
                'attribute'=>'option_ru',
                'format'=>'html',
                'value'=>$model->optionru
            ],
            [
                'attribute'=>'limit_uz',
                'format'=>'html',
                'value'=>$model->limituz
            ],
            [
                'attribute'=>'limit_ru',
                'format'=>'html',
                'value'=>$model->limitru
            ],
            [
                'attribute' => 'sale',
                'value' => function ($model) {
                    return number_format($model->sale, 0, ' ', ' ') . ' sum';
                },
            ],
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return number_format($model->price, 0, ' ', ' ') . ' sum';
                },
            ],
            // 'order',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->statusLabel
            ],
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>