<?php

namespace frontend\controllers;

use common\models\Seen;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;

class SettingController extends \yii\web\Controller
{
    /**
     * public function behaviors()
     * {
     * return [
     * [
     * 'access' => [
     * 'class' => AccessControl::class,
     * 'only' => ['index'],
     * 'rules' => [
     * [
     * 'actions' => ['index'],
     * 'allow' => true,
     * 'roles' => ['@']
     * ]
     * ]
     * ],
     * 'verbs' => [
     * 'class' => VerbFilter::class,
     * 'actions' => [
     * 'logout' => ['post'],
     * ],
     * ],
     * ]
     * ];
     * }
     */
    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = User::findOne(Yii::$app->user->id);
        return $this->render('index', compact('model'));
    }

    public function actionPasswordSetting($id)
    {
        $model = User::findOne($id);
        if (Yii::$app->request->isPost) {
            if ($model->validatePassword($_POST['oldPassword'])) {
                $model->password_hash = Yii::$app->security->generatePasswordHash($_POST['password']);
                if ($model->update()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', Yii::t('app', 'Parolingiz o\'zgartirldi!')));
                    return $this->redirect(Yii::$app->request->referrer);
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', Yii::t('app', 'Joriy parol noto\'g\'ri')));
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    public function actionDataSetting($id)
    {
        $model = User::findOne(['id' => $id]);
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->update()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Shaxsiy ma\'lumotlar o\'zgartirildi'));
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', Yii::t('app', 'O\'zgartirishda xatolik qaytadan urinib ko\'ring')));
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
    }

    public function actionDeleteAccount($id, $s)
    {
        if (isset($s) && strlen($s) == 40) {
            if (User::findOne($id)->delete()) {
                if (!Yii::$app->user->isGuest) {
                    $seen = Seen::findOne(['user_id' => Yii::$app->user->id]);
                    $seen->delete();
                }
                return $this->redirect('/');
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', Yii::t('app', 'O\'chirishda xatolik mavjud. Qaytadan urinib ko\'ring!')));
                return $this->redirect(Yii::$app->request->referrer);
            }
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'Sahifa topilmadi!', 404));
        }
    }

}