<?php

namespace frontend\controllers;

use backend\models\Category;
use common\models\Like;
use common\models\Province;
use common\models\TopTime;
use common\models\Tumanlar;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ComponentController extends \yii\web\Controller
{
    /**
     * @return array[]
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['top', 'like'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param $id
     * @param $order
     * @return void
     * @throws NotFoundHttpException
     */
    public function actionTop($id, $order)
    {
        $model = new TopTime();
        if ($order == 1) {
            if ($model->saved(Yii::$app->user->id, 30, $id, $order)) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Kunlik "PREMIUM"ga Muvaffaqqiyatli qo\'shildingiz!'));
                $this->redirect(['/']);
            } else {
                throw new NotFoundHttpException(Yii::t('app', 'Sahifa topilmadi!'));
            }
        } else {
            if ($model->saved(Yii::$app->user->id, 3600 * 24 * 30, $id, $order)) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Oylik "PREMIUM"ga Muvaffaqqiyatli qo\'shildingiz!'));
                $this->redirect(['/']);
            } else {
                throw new NotFoundHttpException(Yii::t('app', 'Sahifa topilmadi!'));
            }
        }

    }

    public function actionCaty()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = Category::find()->andWhere(['section_id' => $id])->andWhere(['status' => 1])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $category) {
                    $out[] = ['id' => $category['id'], 'name' => $category['name_uz']];
                    if ($i == 0) {
                        $selected = $category['id'];
                    }
                }
                return ['output' => $out, 'selected' => $selected];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    /**
     * @return array
     */
    public function actionTuman()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = Tumanlar::find()->andWhere(['province_id' => $id])->orderBy(['name' => SORT_ASC])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $category) {
                    $out[] = ['id' => $category['id'], 'name' => $category['name']];
                    if ($i == 0) {
                        $selected = $category['id'];
                    }
                }
                return ['output' => $out, 'selected' => $selected];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    /**
     * @param $id
     * @return array
     */
    public function actionLike($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Like();
        if ($model->saved($id)) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }
}