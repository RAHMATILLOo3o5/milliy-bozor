<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Footer */


$this->title = $model->shortText;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Footers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card p-2">
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
            'text_uz:ntext',
            'text_ru:ntext',
            [
                'attribute' => 'Bog\'lanish',
                'format' => 'html',
                'value' => $model->contact
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->statusLabel
            ],
            
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
