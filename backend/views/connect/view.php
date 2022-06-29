<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Connect */

$this->title = $model->phone;
$this->params['breadcrumbs'][] = ['label' => 'Telefon raqamlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-6">
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
                    'phone',
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            if ($model->status == 1) {
                                return "<span class='badge badge-success'>Faol</span>";
                            }
                            return "<span class='badge badge-danger'>Nofaol</span>";
                        },
                        'format' => 'raw',
                    
                    ],
                ],
            ]) ?>
        
        </div>
    </div>
</div>
