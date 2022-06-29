<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\DostavkaQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dostavka rekalmari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card p-2">

    <span class="mb-2">
        <a href="<?= Url::to(['create']) ?>" class="btn btn-outline-success"> <i class="fa fa-plus"></i> </a>
    </span>

    <span class="mb-2">
        <a href="<?= Url::to(['connect/index']) ?>" class="btn btn-outline-success"> <i class="fa fa-phone"></i> Bog'lanish uchun </a>
    </span>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'title_uz',
                'title_ru',
                [
                    'attribute'=>'description_uz',
                    'format'=>'ntext',
                    'value'=>'shortText'
                ],
                [
                    'attribute'=>'description_ru',
                    'format'=>'ntext',
                    'value'=>'shortTextru'
                ],

                [
                    'attribute'=>'status',
                    'filter'=>[
                        '1'=>'Faol',
                        '0'=>'Nofaol'
                    ],
                    'format'=>'html',
                    'value'=>'statusLabel'
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