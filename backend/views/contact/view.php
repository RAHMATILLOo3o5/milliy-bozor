<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card p-4">

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
            'job',
            'body:ntext',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->holat
            ],
            [
                'attribute' => 'read',
                'format' => 'html',
                'value' => $model->statusLabel
            ],
            [
                'attribute' => 'user_id',
                'format' => 'html',
                'value' => $model->user->username
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
