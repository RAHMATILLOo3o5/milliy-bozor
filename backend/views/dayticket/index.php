<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\DayticketQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kunlik obunalar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card p-2">

    <p>
        <a href="<?= Url::to(['create']) ?>" class="btn btn-outline-success"> <i class="fa fa-plus"></i> </a>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="table-respnsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            [
                'attribute' => 'sale',
                'value' => function ($model) {
                    return number_format($model->sale, 0, ' ', ' ') . ' sum';
                },
            ],
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return number_format($model->price, 0, ' ', ' ') . ' sum';
                },
            ],
            //'limit_ru:ntext',
            //'sale',
            //'price',
            //'order',
            //'status',
            'created_at:date',
            //'updated_at',
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