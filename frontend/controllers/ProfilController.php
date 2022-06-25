<?php

namespace frontend\controllers;

use common\models\Seen;
use yii\filters\AccessControl;

class ProfilController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $seen = new Seen();
        $seen->updated();
        return $this->render('index');
    }

}
