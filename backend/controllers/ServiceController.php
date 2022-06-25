<?php

namespace backend\controllers;

use backend\models\Service;
use backend\models\search\ServiceQuery;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends AllowsController
{

    /**
     * Lists all Service models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ServiceQuery();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Service model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Service();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->img = UploadedFile::getInstance($model, 'img');
                if (!empty($model->img)) {
                    $model->img->saveAs(Yii::getAlias('@saveimg') . '/' . time() . "." . $model->img->extension, true);
                    $model->img = time() . "." . $model->img->extension;
                } else {
                    $model->img = '02.png';
                }
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->img = UploadedFile::getInstance($model, 'img');
            if (!empty($model->img)) {
                if ($model->img == '02.png') {
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    unlink(Yii::getAlias('@saveimg') . '/' . $model->getOldAttribute('img'));
                    $model->img->saveAs(Yii::getAlias('@saveimg') . '/' . time() . "." . $model->img->extension, true);
                    $model->img = time() . "." . $model->img->extension;
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->img = $model->getOldAttribute('img');
                $model->update();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->img == '02.png') {
            $this->findModel($id)->delete();
        }
        unlink(Yii::getAlias('@saveimg') . '/' . $this->findModel($id)->img);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
