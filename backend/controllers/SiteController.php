<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\Offer;
use backend\models\Policy;
use backend\models\Service;
use backend\models\Terms;
use common\models\Connect;
use common\models\LoginForm;
use common\models\Product;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
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

        return $this->render('index', [
            'product' => Product::find()->count(),
            'user' => User::find()->count(),
            'offer' => Offer::find()->count(),
            'service' => Service::find()->count(),
            'connect' => new ActiveDataProvider([
                'query' => Connect::find()
            ]),
        ]);
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
                    return $this->redirect('https://milliy-bozor.com/');
                }
            } else {
                return $this->redirect('https://milliy-bozor.com/');
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

    public function actionTerm()
    {
        $model = (Terms::find()->one()) ? Terms::find()->one() : new Terms();
        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save()) {
                return $this->redirect($this->request->referrer);
            }
        }
        return $this->render('terms', compact('model'));
    }

    public function actionPolicy()
    {
        $model = (Policy::find()->one()) ? Policy::find()->one() : new Policy();
        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save()) {
                return $this->redirect($this->request->referrer);
            }
        }
        return $this->render('terms', compact('model'));
    }
}
