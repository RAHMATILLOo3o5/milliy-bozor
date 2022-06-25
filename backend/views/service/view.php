<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Service */

$this->title = $model->title_uz;
$this->params['breadcrumbs'][] = ['label' => 'Xizmatlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card p-3">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title_uz',
            'title_ru',
            'content_uz:ntext',
            'content_ru:ntext',
            [
                'attribute'=>'img',
                'format'=>'html',
                'value'=>$model->imgs
            ],

            'phone',
            [
                'attribute'=>'province_id',
                'value'=>$model->province->name
            ],
            [
                'attribute'=>'tuman_id',
                'value'=>$model->tuman->name
            ],

            [
                'attribute'=>'status',
                'format'=>'html',
                'value'=>$model->statusLabel
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
