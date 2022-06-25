<?php

namespace frontend\controllers;

use common\models\Chat;
use common\models\Message;
use phpDocumentor\Reflection\Types\False_;
use Yii;
use yii\helpers\VarDumper;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class MessageController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'message-main';
        $messages = Chat::find()->orWhere(['from' => Yii::$app->user->id])->orWhere(['to' => Yii::$app->user->id])->all();
        return $this->render('index', [
            'messages' => $messages,
        ]);
    }

    public function actionSend()
    {
        $model = new Message();
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                if ($model->saved($model)) {
                    $data = [
                        'status' => 200,
                        'created_at' => date('h:i d.m/y', $model->created_at),
                    ];
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $data;
                } else {
                    $data = [
                        'status' => 'error',
                        'errors' => $model->getErrors(),
                    ];
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $data;
                }
            }
        } else {
            return $this->redirect(['/site/login']);
        }
    }
}