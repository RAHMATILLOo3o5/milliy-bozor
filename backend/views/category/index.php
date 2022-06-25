<?php

use backend\models\Section;
use kartik\widgets\Spinner;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CategoryQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategoriyalar';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="card p-3">
        <p>
            <a href="<?= Url::to(['create']) ?>" class="btn btn-outline-success create"> <i class="fa fa-plus"></i> </a>
        </p>

        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    'name_uz',
                    'name_ru',
                    [
                        'attribute' => 'section_id',
                        'format' => 'html',
                        'value' => 'section.name_uz',
                        'filter' => ArrayHelper::map(Section::find()->where(['status' => 1])->all(), 'id', 'name'),
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'html',
                        'value' => 'statusLabel',
                        'filter' => [
                            '1' => 'Faol',
                            '0' => 'Nofaol'
                        ]
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => 'dateTime',
                        'filter' => false
                    ],
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
                    'class' => LinkPager::class,
                    'maxButtonCount' => 5,
                ],
            ]); ?>
        </div>


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
      '. Spinner::widget(['preset' => 'medium', 'align' => 'center', 'color' => 'blue']) .'</div>';

Modal::end();