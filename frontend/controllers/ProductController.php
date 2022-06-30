<?php

namespace frontend\controllers;

use backend\models\Category;
use common\models\Message;
use common\models\Product;
use frontend\models\Offer;
use frontend\models\search\ProductQuery;
use common\models\Seen;
use common\models\TopTime;
use common\models\User;
use common\models\View;
use frontend\models\Section;
use frontend\models\Service;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ProductController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['new-product'],
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
        $section = Section::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->limit(6)->all();

        $searchModel = new ProductQuery();
        $product = $searchModel->search($this->request->queryParams);
        $category = new ActiveDataProvider([
            'query' => Category::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])
        ]);

        if ($this->request->get('section')) {
            $section_id = $this->request->get('section');
            $product = new ActiveDataProvider([
                'query' => Product::find()->where(['section_id' => $section_id])->orderBy(['id' => SORT_DESC]),
                'pagination' => [
                    'pageSize' => 12
                ],
            ]);
        } else if ($this->request->get('price')) {
            $product = new ActiveDataProvider([
                'query' => Product::find()->where(['status' => '1'])->andWhere(['like', 'price', Yii::$app->request->get('price')]),
                'pagination' => [
                    'pageSize' => 12
                ],
            ]);
        } else if ($this->request->get('caty_id')) {
            $category_id = $this->request->get('caty_id');
            $product = new ActiveDataProvider([
                'query' => Product::find()->where(['category_id' => $category_id])->orderBy(['id' => SORT_DESC]),
                'pagination' => [
                    'pageSize' => 12
                ],
            ]);
        } else if ($this->request->get('sort')) {
            $sort = $this->request->get('sort');
            if ($sort == 'SORT_DESC') {
                $product = new ActiveDataProvider([
                    'query' => Product::find()->where(['status' => '1'])->orderBy(['id' => SORT_DESC]),
                    'pagination' => [
                        'pageSize' => 12
                    ],
                ]);
            } else if ($sort == 'SORT_ASC') {
                $product = new ActiveDataProvider([
                    'query' => Product::find()->where(['status' => '1'])->orderBy(['id' => SORT_ASC]),
                    'pagination' => [
                        'pageSize' => 12
                    ],
                ]);
            } else if ($sort == 'PRICE_ASC') {
                $product = new ActiveDataProvider([
                    'query' => Product::find()->where(['status' => '1'])->orderBy(['price' => SORT_ASC]),
                    'pagination' => [
                        'pageSize' => 12
                    ],
                ]);
            } else if ($sort == 'PRICE_DESC') {
                $product = new ActiveDataProvider([
                    'query' => Product::find()->where(['status' => '1'])->orderBy(['price' => SORT_DESC]),
                    'pagination' => [
                        'pageSize' => 12
                    ],
                ]);
            }
        } else if ($this->request->get('province')) {
            $users = new ActiveDataProvider([
                'query' => User::find()->where(['province_id' => Yii::$app->request->get('province'), 'status' => 10]),
                'pagination' => [
                    'pageSize' => 9
                ]
            ]);
            return $this->renderAjax('user', [
                'users' => $users,
            ]);
        } else if ($this->request->get('q')){
            $q = trim($this->request->get('q'), ' ');
            $product = new ActiveDataProvider([
                'query' => Product::find()->where(['status' => '1'])->andWhere(['like', 'name', $q]),
                'pagination' => [
                    'pageSize' => 12
                ],
            ]);

        } else {
            $product = new ActiveDataProvider([
                'query' => Product::find()->where(['status' => '1'])->orderBy(['id' => SORT_DESC]),
                'pagination' => [
                    'pageSize' => 12
                ],
            ]);
        }

        if ($this->request->isAjax) {
            return $this->renderAjax('_product', ['product' => $product]);
        }

        return $this->render('index', compact('product', 'category', 'section'));
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
        if (!Yii::$app->user->isGuest) {
            $seen = new Seen();
            $seen->updated();

            $dt = new TopTime();
            $dt->check(Yii::$app->user->id);
        }

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
        if (!Yii::$app->user->isGuest) {
            $seen = new Seen();
            $seen->updated();

            $dt = new TopTime();
            $dt->check(Yii::$app->user->id);
        }
        $model = $this->findModel($id);
        $model->img = explode(',', $model->img);
        return $this->render('before-save', [
            'model' => $model,
        ]);
    }

    public function actionSave($id)
    {
        if (!Yii::$app->user->isGuest) {
            $seen = new Seen();
            $seen->updated();

            $dt = new TopTime();
            $dt->check(Yii::$app->user->id);
        }
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
        if (!Yii::$app->user->isGuest) {
            $seen = new Seen();
            $seen->updated();

            $dt = new TopTime();
            $dt->check(Yii::$app->user->id);
        }
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

    /**
     * @return array|Response
     */
    public function actionSearch()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($this->request->isAjax) {
            $q = Yii::$app->request->get('q');
            $product = Product::find()->andFilterWhere(['like', 'name', trim($q, ' ')])->andWhere(['status' => 1])->all();
            $offer = Offer::find()->andFilterWhere(['like', 'title_' . Yii::$app->language, trim($q, ' ')])->andWhere(['status' => 1])->all();
            $service = Service::find()->andFilterWhere(['like', 'title_' . Yii::$app->language, trim($q, ' ')])->andWhere(['status' => 1])->all();
            $data = [
                'status' => 200,
                'content' => $this->renderAjax('_search', compact('product', 'offer', 'service', 'q')),
            ];
            return $data;
        } else {
            return $this->redirect(['product/index', 'q' => Yii::$app->request->get('q')]);
        }
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
