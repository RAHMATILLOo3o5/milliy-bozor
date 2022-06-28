<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Footers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card p-2">
    <p>
        <a href="<?= Url::to(['create']) ?>" class="btn btn-outline-light"> <i class="fa fa-plus"></i> </a>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'title_uz',
                'format' => 'html',
                'value' => 'shortText'
            ],
            [
                'attribute' => 'title_ru',
                'format' => 'html',
                'value' => 'shortTextru'
            ],
            [
                'attribute' => 'Bog\'lanish',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->contact;
                }
            ],
            // 'twitter',
            // 'facebook',
            //'instagram',
            //'youtube',
            //'telegram',
            //'pinterest',
            //'status',
            'created_at:date',
            'updated_at:date',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>