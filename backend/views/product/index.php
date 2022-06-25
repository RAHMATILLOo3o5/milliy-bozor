<?php

use backend\models\Section;
use yii\bootstrap4\LinkPager;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'E\'lonlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card p-2">

    <p>
        <a href="<?= Url::to(['create']) ?>" class="btn btn-outline-success"> <i class="fa fa-plus"></i> </a>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'name',
                [
                    'attribute' => 'is_top',
                    'format' => 'html',
                    'value' => 'topLabel',
                    'filter' => [
                        '1' => 'Premium',
                        '0' => 'Oddiy'
                    ]
                ],
                // 'description:ntext',
                [
                    'attribute' => 'img',
                    'format' => 'html',
                    'filter' => false,
                    'value' => function ($model) {
                        foreach ($model->images as $image) {
                            return Html::img($image, ['width' => '150px']);
                        }
                    }
                ],

                [
                    'attribute' => 'user_id',
                    'format' => 'html',
                    'value' => 'user.username',
                ],
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

                //'updated_at',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->slug]);
                    }
                ],
            ],
            'tableOptions' => [
                'class' => 'table table-bordered table-hover',
                'id' => 'table-id',
            ],
            'pager' => [
                'class' => LinkPager::class,
                'maxButtonCount' => 5,
            ],
        ]); ?>
    </div>

    <?php Pjax::end(); ?>

</div>
