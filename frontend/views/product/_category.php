<?php
/**
 * @var $model \backend\models\Category
 */
use yii\helpers\Url;


if(Yii::$app->language == 'uz'){
    echo '<a href="'. Url::to(['product/index', 'caty_id'=>$model->id]) .'" class="font-weight-bolder">'. $model->name_uz .' <i class="fa fa-sort-amount-down"></i> </a>';
} else{
    echo '<a href="'. Url::to(['product/index', 'caty_id'=>$model->id]) .'" class="font-weight-bolder">'. $model->name_ru .' | </a>';
}
?>

