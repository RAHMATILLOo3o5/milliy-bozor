<?php

use yii\helpers\Url;


if(Yii::$app->language == 'uz'){
    echo '<a href="'. Url::to(['product', 'id'=>$model->id]) .'" class="font-weight-bolder">'. $model->name_uz .'</a>';
} else{
    echo '<a href="'. Url::to(['product', 'id'=>$model->id]) .'" class="font-weight-bolder">'. $model->name_ru .'</a>';
}
?>

