<?php

namespace frontend\controllers;

use common\models\Offercoment;
use common\models\Seen;
use common\models\Servicecoment;
use common\models\TopTime;
use frontend\models\Offer;
use frontend\models\Service;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class OfferController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                // 'only' => ['view-offer', 'view-service'],
                'rules' => [
                    [
                        'actions' => ['view-offer', 'view-service'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    public function actionViewOffer($id)
    {
            if (!Yii::$app->user->isGuest) {
                $seen = new Seen();
                $seen->updated();

                $dt = new TopTime();
                $dt->check(Yii::$app->user->id);
            }
            $offer = Offer::find()->where(['id' => $id])->asArray()->one();
            $coment = new Offercoment();
            $allComent = Offercoment::find()->where(['offer_id' => $id])->all();
            if (Yii::$app->request->isPost) {
                if ($coment->load($this->request->post())) {
                    if (!Yii::$app->user->isGuest) {
                        $coment->offer_id = $offer['id'];
                        $coment->save();
                        Yii::$app->session->setFlash('success', Yii::t('app', 'Izoh uchun rahmat!'));
                        return $this->redirect(Yii::$app->request->referrer);
                    } else {
                        return $this->redirect(['/site/login']);
                    }
                }
            }
            return $this->render('view-offer', compact('offer', 'coment', 'allComent'));
    }
    public function actionViewService($id)
    {
            if (!Yii::$app->user->isGuest) {
                $seen = new Seen();
                $seen->updated();

                $dt = new TopTime();
                $dt->check(Yii::$app->user->id);
            }
            $service = Service::find()->where(['id' => $id])->one();
            $coment = new Servicecoment();
            $allComent = Servicecoment::find()->where(['service_id' => $id])->all();
            if (Yii::$app->request->isPost) {
                if ($coment->load($this->request->post())) {
                    if (!Yii::$app->user->isGuest) {
                        $coment->service_id = $service['id'];
                        $coment->save();
                        Yii::$app->session->setFlash('success', Yii::t('app', 'Izoh uchun rahmat!'));
                        return $this->redirect(Yii::$app->request->referrer);
                    } else {
                        return $this->redirect(['/site/login']);
                    }
                }
            }
            return $this->render('view-service', compact('service', 'coment', 'allComent'));

    }
}
