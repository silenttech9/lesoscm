<?php

namespace frontend\controllers;

use Yii;
use common\models\LookupValidity;
use common\models\LookupValiditySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LookupValidityController implements the CRUD actions for LookupValidity model.
 */
class LookupValidityController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LookupValidity models.
     * @return mixed
     */
    public function actionIndex($module_id)
    {
        $searchModel = new LookupValiditySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['module_id'=>$module_id]);

        return $this->render('index', [
            'module_id' => $module_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LookupValidity model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LookupValidity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($module_id)
    {
        $model = new LookupValidity();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->date_create = date('Y-m-d h:i:s');
            $model->enter_by= Yii::$app->user->identity->id;
            $model->module_id= $module_id;

            $model->save();
            return $this->redirect(['index', 'module_id' => $module_id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LookupValidity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {


            $model->date_update = date('Y-m-d h:i:s');
            $model->update_by= Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['index', 'module_id' => $model->module_id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LookupValidity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$module_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'module_id' => $module_id]);
    }


    /**
     * Finds the LookupValidity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LookupValidity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LookupValidity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
