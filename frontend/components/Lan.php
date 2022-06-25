<?php

namespace frontend\components;

use yii\base\Application as ApplicationAlias;

class Lan extends \yii\base\Behavior
{
    public function events()
    {
        return [
          ApplicationAlias::EVENT_BEFORE_REQUEST=>'lan',
        ];
    }
    public function lan(){
        if (\Yii::$app->session->has('lan')){
            \Yii::$app->language = \Yii::$app->session->get('lan');
        }
    }
}