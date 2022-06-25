<?php

use kartik\spinner\Spinner;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\OfferQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Takliflar';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="card card-outline-primary p-2">

        <p>
            <a href="<?= Url::to(['create']) ?>" class="btn btn-outline-success create"> <i class="fa fa-plus"></i> </a>
        </p>

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => [
                'class' => 'table table-bordered'
            ],
            'options' => ['class' => 'table table-responsive'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title_uz',
//                'title_ru',
                'content_uz:ntext',
//                'content_ru:ntext',
                //'img',
//                'price',
//                'sale',
                'owner',
                //'phone',
                //'province_id',
                //'tuman_id',
                'email:email',
                [
                    'attribute' => 'status',
                    'format' => 'html',
                    'value' => function ($model) {
                        if ($model->status == 1) {
                            return '<span class="badge badge-success">FAOL</span>';
                        }
                        return '<span class="badge badge-danger">NOFAOL</span>';
                    },
                    'filter' => [
                        '1' => 'FAOL',
                        '0' => 'NOFAOL'
                    ],
                ],
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

        <?php Pjax::end(); ?>

    </div>
<?php
Modal::begin([
    'title' => '<h2>Taklif</h2>',
    'options' => [
        'class' => 'create-modal'
    ],
    'size' => 'modal-lg'
]);

echo '<div class="render-form p-sm-3">
      ' . Spinner::widget(['preset' => 'medium', 'align' => 'center', 'color' => 'blue']) . '</div>';

Modal::end();