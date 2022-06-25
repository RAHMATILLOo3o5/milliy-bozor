<?php

use kartik\widgets\Spinner;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="card p-2">

        <p>
            <a href="<?= Url::to(['create']) ?>" class="btn btn-outline-success create"> <i class="fa fa-plus"></i> </a>
        </p>

        <?php Pjax::begin(); ?>
        <div class="table-responsive-md">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    [
                        'attribute' => 'title_uz',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return \yii\helpers\StringHelper::truncateWords($model->title_uz, 5);
                        },
                    ],
                    [
                        'attribute' => 'title_ru',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return \yii\helpers\StringHelper::truncateWords($model->title_ru, 5);
                        },
                    ],
                    [
                        'attribute' => 'description_uz',
                        'format' => 'ntext',
                        'value' => 'shortDescription_uz',
                    ],

                    //'price',
                    //'currency',
                    //'image',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => 'statusLabel',
                    ],
                    //'created_at',
                    //'updated_at',
                    [
                        'class' => ActionColumn::class,
                        'urlCreator' => function ($action, $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'buttons' => [
                            'view' => function ($url) {
                                return Html::a('<i class="fa fa-eye"></i>', $url, [
                                    'class' => 'view-modal',
                                    'data-toggle' => "tooltip", 'data-placement' => "top", 'title' => "Ko'rish"
                                ]);
                            },
                            'update' => function ($url) {
                                return Html::a('<i class="fa fa-pencil-alt"></i>', $url, [
                                    'class' => 'updated-modal',
                                    'data-toggle' => "tooltip", 'data-placement' => "top", 'title' => "Yangilash"
                                ]);
                            },
                            'delete' => function ($url) {
                                return Html::a('<i class="fa fa-trash"></i>', $url, [
                                    'data-toggle' => "tooltip", 'data-placement' => "top", 'title' => "O'chirish",
                                    'data-method'=>'post'
                                ]);
                            }
                        ],
                    ],
                ],
                'pager' => [
                    'class' => \yii\bootstrap4\LinkPager::class,
                    'maxButtonCount' => 5
                ]
            ]); ?>
        </div>


        <?php Pjax::end(); ?>

    </div>
<?php
Modal::begin([
    'title' => '<h2>Bo\'lim</h2>',
    'options' => [
        'class' => 'create-modal'
    ],
    'size' => 'modal-lg'
]);

echo '<div class="render-form p-sm-3">
 ' . Spinner::widget(['preset' => 'medium', 'align' => 'center', 'color' => 'blue']) . '
</div>';

Modal::end();
