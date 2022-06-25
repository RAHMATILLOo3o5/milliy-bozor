<?php

use yii\bootstrap4\LinkPager;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ContactQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contacts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card p-3">

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'name',
                'job',
                [
                    'attribute'=>'body',
                    'format'=>'ntext',
                    'value'=>'shortText'
                ],
                [
                    'attribute' => 'status',
                    'format' => 'html',
                    'value' => 'statusLabel',
                    'filter' => [
                        '1' => 'O\'qilgan',
                        '0' => 'O\'qilmagan'
                    ]
                ],
                //'user_id',
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
                'class' => LinkPager::class,
                'maxButtonCount' => 5,
            ],
        ]); ?>

    </div>

</div>