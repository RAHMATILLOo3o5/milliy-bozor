<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = Yii::$app->name;
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $product ?></h3>

                    <p>E'lonlar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?= Url::to(['product/']) ?>" class="small-box-footer">Batafsil <i
                            class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $user ?></h3>

                    <p>Foydalanuvchilar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= Url::to(['user/']) ?>" class="small-box-footer">Batafsil <i
                            class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $offer ?></h3>

                    <p>Maxsus takliflar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?= Url::to(['offer/']) ?>" class="small-box-footer">Batafsil <i
                            class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $service ?></h3>

                    <p>Xizmatlar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?= Url::to(['service/']) ?>" class="small-box-footer">Batafsil <i
                            class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h2 class="card-title">Saytning kalit so'zlari</h2> <br>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card  card-success">
                <div class="card-header">
                    <h3 class="card-title">Bog'lanish ma'lumotlari</h3>
                </div>
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $connect,
                        'options' => ['class' => 'table-responsive'],
                        'tableOptions' => ['class' => 'table'],
                        'layout' => "\n{items}\n{pager}",
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
                <div class="card-footer clearfix">
                    <a href="<?= Url::to(['connect/create']) ?>" class="btn btn-primary float-right">
                        <i class="fa fa-plus"></i>
                        Qo'shish
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>