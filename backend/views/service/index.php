<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ServiceQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Xizmatlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card p-2">
    <p>
        <a href="<?= Url::to(['create']) ?>" class="btn btn-outline-success"> <i class="fa fa-plus"></i> </a>
    </p>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'title_uz',
                // 'title_ru',
                'content_uz:ntext',
                // 'content_ru:ntext',
                //'img',
                //'phone',
                //'province_id',
                //'tuman_id',
                [
                    'attribute' => 'status',
                    'filter' => [
                        '1' => 'Faol',
                        '0' => 'Nofaol'
                    ],
                    'format' => 'html',
                    'value' => 'statusLabel'
                ],
                //'created_at',
                //'updated_at',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
            'pager' => [
                'class' => \yii\bootstrap4\LinkPager::class,
                'maxButtonCount' => 5
            ]
        ]); ?>
    </div>


</div>