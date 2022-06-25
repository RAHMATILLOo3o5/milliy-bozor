<?php

namespace backend\controllers;

use backend\models\Admin;
use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends AllowsController
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'main-login';

        $model = new LoginForm();
        $admin = Admin::find()->one();
        if ($model->load(Yii::$app->request->post())) {
            if (!empty($admin->user->username) && $admin->user->username == $model->username) {
                if ($model->login()) {
                    return $this->goHome();
                } else {
                    return $this->redirect('http://milliy-bozor/');
                }
            } else {
                return $this->redirect('http://milliy-bozor/');
            }
        }
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('http://milliy-bozor/');
    }
}
