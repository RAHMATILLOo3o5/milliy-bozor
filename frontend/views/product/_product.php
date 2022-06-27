<?php
/**
 * @var $product \common\models\search\ProductQuery
 */

use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $product,
    'itemView' => '_items',
    'layout' => "{items}\n{pager}",
    'options' => [
        'class' => 'row mt-md-4'
    ],
    'itemOptions' => [
        'class' => 'col-md-4 p-md-5'
    ],
    'pager' => [
        'class' => \yii\bootstrap4\LinkPager::class,
        'maxButtonCount' => 8,
        'options' => [
            'class' => 'col-12 pl-5 mt-4'
        ]
    ]
]);

