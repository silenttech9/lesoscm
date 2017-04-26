<?php

namespace frontend\modules\thailand\controllers;

use Yii;
use frontend\modules\thailand\models\TelemarketingHistory;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TelemarketingHistoryController implements the CRUD actions for TelemarketingHistory model.
 */
class TelemarketingHistoryController extends Controller
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
     * Lists all TelemarketingHistory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TelemarketingHistory::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TelemarketingHistory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
       // echo $id;

        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT telemarketing_history.*,enter.username AS enterBy,up.username AS updateBy FROM telemarketing_history 
LEFT JOIN user AS enter ON telemarketing_history.enter_by = enter.id
LEFT JOIN user AS up ON telemarketing_history.update_by = up.id
            WHERE telemarketing_history.id_telemarketing_customer = '".$id."'");

        $model_history = $sql->queryAll();



        return $this->renderAjax('view', [
             'model_history' => $model_history,
            //'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TelemarketingHistory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TelemarketingHistory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TelemarketingHistory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TelemarketingHistory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TelemarketingHistory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TelemarketingHistory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TelemarketingHistory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
