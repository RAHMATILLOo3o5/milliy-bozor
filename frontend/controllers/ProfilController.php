<?php

namespace frontend\controllers;

use common\models\Like;
use common\models\Product;
use common\models\SearchLike;
use common\models\Seen;
use common\models\TopTime;
use common\models\View;
use Yii;
use yii\data\ActiveDataProvider;
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
        if (!Yii::$app->user->isGuest) {
            $seen = new Seen();
            $seen->updated();

            $dt = new TopTime();
            $dt->check(Yii::$app->user->id);
        }

        $likeProduct = new ActiveDataProvider([
            'query' => Like::find()->andWhere(['user_id' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 9
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);
        $lastSeen = new ActiveDataProvider([
            'query' => View::find()->andWhere(['user_id' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 9
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]
        ]);
        $myAds = new ActiveDataProvider([
            'query' => Product::find()->andWhere(['user_id' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 9
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);
        $search = new ActiveDataProvider([
            'query' => SearchLike::find()->andWhere(['user_id' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);
        return $this->render('index', [
            'like' => $likeProduct,
            'view' => $lastSeen,
            'myAds' => $myAds,
            'search' => $search
        ]);
    }

    public function actionClear()
    {
        if (Like::deleteAll(['user_id' => Yii::$app->user->id])) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        Yii::$app->session->setFlash('danger', Yii::t('app', 'O\'chirib bo\'lmadi'));
        return $this->redirect(Yii::$app->request->referrer);
    }

}
