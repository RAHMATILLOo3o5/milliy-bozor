<?php

namespace frontend\controllers;

use common\models\Message;
use common\models\Product;
use common\models\User;
use common\models\View;
use Yii;
use yii\helpers\VarDumper;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ProductController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['index', 'new-product'],
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
        return $this->render('index');
    }

    public function actionView($id)
    {
        $product = $this->findModel($id);
        $product->img = explode(',', $product->img);
        $view = new View();
        $view->saved($product->id);
        $message = new Message();
        $alike = Product::find()->andWhere(['category_id' => $product->category_id])->andWhere(['!=', 'id', $product->id])->orderBy(['id' => SORT_DESC])->limit(9)->all();
        $alike_count = Product::find()->andWhere(['category_id' => $product->category_id])->andWhere(['!=', 'id', $product->id])->orderBy(['id' => SORT_DESC])->limit(9)->count();
        return $this->render('view', [
            'product' => $product,
            'alike' => $alike,
            'alike_count' => $alike_count,
            'message' => $message,
        ]);
    }

    public function actionNewProduct()
    {
        $model = new Product();
        $user = User::findOne(Yii::$app->user->id);
        if ($user->is_top == 1) {
            $model->is_top = 1;
        } else {
            $model->is_top = 0;
        }
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isPost && $user->load(Yii::$app->request->post())) {
                if ($model->status == 0) {
                    $model->saved($model);
                    $user->update();
                    return $this->redirect(['product/before-save', 'id' => $model->slug]);
                } else {
                    $model->saved($model);
                    $user->update();
                    return $this->redirect(['product/index']);
                }
            }
        }
        return $this->render('new-product', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    public function actionBeforeSave($id)
    {
        $model = $this->findModel($id);
        $model->img = explode(',', $model->img);
        return $this->render('before-save', [
            'model' => $model,
        ]);
    }

    public function actionSave($id)
    {
        $model = $this->findModel($id);
        $model->status = 1;
        $model->save();
        return $this->redirect(['product/index']);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['product/index']);
    }

    public function actionUpdated($id)
    {
        $model = $this->findModel($id);
        $model->img = explode(',', $model->img);
        $user = User::findOne(Yii::$app->user->id);
        if ($this->request->isPost && $model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
            $model->status = 1;
            $user->update();
            $model->updated($model);
            return $this->redirect(['product/index']);
        }
        return $this->render('updated', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    public function findModel($id)
    {
        if (($model = \common\models\Product::findOne(['slug' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(\Yii::t('app', 'Bunday e\'lon mavjud emas.'));
        }
    }
}