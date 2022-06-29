<?php
/**
 * @var $product \common\models\Product
 * @var $offer \frontend\models\Offer
 * @var $service \frontend\models\Service
 * @var $q
 */

use yii\helpers\Url;

if (!empty($product)) {
    foreach ($product as $p) {
        echo '<a href="' . Url::to(['product/index', 'q' => $q]) . '" class="list-group-item list-group-item-action" >' . $p->name . '</a>';
    }
}
if (!empty($offer)) {
    foreach ($offer as $p) {
        echo '<a href="' . Url::to(['offer/view-offer', 'id' => $p['id']]) . '" class="list-group-item list-group-item-action" >' . $p['title_' . Yii::$app->language] .' <br> <small>' . Yii::t('app', 'taklif') .'</small> </a>';
    }
}

if (!empty($service)) {
    foreach ($service as $p) {
        echo '<a href="' . Url::to(['offer/view-offer', 'id' => $p['id']]) . '" class="list-group-item list-group-item-action" >' . $p['title_' . Yii::$app->language] .' <br> <small>' . Yii::t('app', 'Qo’shimcha xizmatlar') .'</small> </a>';
    }
}
echo '<a href="' . Url::to(['product/index', 'q' => $q]) . '" class="list-group-item list-group-item-action list-group-item-primary">' . Yii::t('app', 'Barchasi ko\'rish') . ' <i class="fa fa-arrow-alt-circle-right"></i> </a>';


