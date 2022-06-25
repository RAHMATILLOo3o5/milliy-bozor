<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Offer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="offer-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title_uz',
            'title_ru',
            'content_uz:ntext',
            'content_ru:ntext',
            [
                'attribute' => 'img',
                'format' => 'html',
                'value' => function ($model) {
                    return '<img src="' . Yii::getAlias('@getimg') . '/' . $model->img . '" class="img-fluid" />';
                }
            ],
            [
                'attribute' => 'price',
                'value' => number_format($model->price, 0, ' ', ' ') . ' sum',
            ],
            [
                'attribute' => 'price',
                'value' => number_format($model->price, 0, ' ', ' ') . ' sum',
            ],
            'owner',
            'phone',
            [
                'attribute' => 'proince_id',
                'value' => $model->province->name
            ],
            [
                'attribute' => 'tuman_id',
                'value' => $model->tuman->name
            ],
            'email:email',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->status == 1) {
                        return '<span class="badge badge-success">FAOL</span>';
                    }
                    return '<span class="badge badge-danger">NOFAOL</span>';
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
