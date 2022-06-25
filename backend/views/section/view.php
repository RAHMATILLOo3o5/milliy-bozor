<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Section */

$this->title = $model->name_uz;
\yii\web\YiiAsset::register($this);
?>
<div class="card p-3">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_uz',
            'name_ru',
            [
                'attribute' => 'img',
                'format' => 'html',
                'value' => $model->imgs
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->statusLabel
            ],
            'created_at:datetime',
            'updated_at:datetime'
        ],
    ]) ?>

</div>
