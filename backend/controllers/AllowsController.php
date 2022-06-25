<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;


class AllowsController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['error', 'login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'caty', 'policy', 'tuman', 'index', 'create', 'term', 'create-ru', 'create-uz', 'update', 'delete', 'view', 'viewtop'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['POST'],
                ],
            ],

        ];
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout'=>'main-login'
            ],
        ];
    }
}
