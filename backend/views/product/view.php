<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'E\'lonlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card p-3">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->slug], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->slug], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => [
            'class' => 'table table-bordered table-hover',
            'id' => 'table-id',
        ],
        'attributes' => [
            'id',
//            'slug',
            'name',
            [
                'attribute' => 'is_top',
                'format' => 'html',
                'value' => $model->topLabel,
            ],
            'description:ntext',
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => function ($model) {
                    return $this->render('_imgview', ['model' => $model]);
                }
            ],
            [
                'attribute' => 'price',
                'value' => number_format($model->price, 0, ' ', ' ') . ' sum',
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->username
            ],
            [
                'attribute' => 'section_id',
                'format' => 'html',
                'value' => $model->section->name_uz
            ],
            [
                'attribute' => 'category_id',
                'format' => 'html',
                'value' => $model->category->name_uz
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->statusLabel
            ],
            'created_at:dateTime',
            'updated_at:dateTime',
        ],
    ]) ?>

</div>
