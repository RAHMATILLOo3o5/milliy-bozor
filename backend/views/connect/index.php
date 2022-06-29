<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bog\'lanish telefon raqamlari';
$this->params['breadcrumbs'][] = ['label' => 'Dostavka reklamasi', 'url' => ['dostavka/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-10">
        <div class="card p-2">

            <p>
                <a href="<?= Url::to(['create']) ?>" class="btn btn-outline-success"> <i class="fa fa-plus"></i> </a>
            </p>

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
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
                        [
                            'class' => ActionColumn::class,
                            'urlCreator' => function ($action, $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>

        </div>
    </div>
</div>