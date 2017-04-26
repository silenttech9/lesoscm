<?php

namespace frontend\modules\bangladesh\controllers;

use Yii;
use frontend\modules\bangladesh\models\CustomerPic;
use frontend\modules\bangladesh\models\CustomerPicSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerPicController implements the CRUD actions for CustomerPic model.
 */
class CustomerPicController extends Controller
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
     * Lists all CustomerPic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerPicSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerPic model.
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
     * Creates a new CustomerPic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id,$module_id)
    {

  
        $model = new CustomerPic();

        if ($model->load(Yii::$app->request->post())) {

            $model->date_create = date('Y-m-d h:i:s');
            $model->enter_by= Yii::$app->user->identity->id;
            $model->customer_id = $id;
            $model->save();


            Yii::$app->getSession()->setFlash('createPic', 'Data Person In Charge <b>'.$model->name.'</b> Successful Saved');
            if (Yii::$app->request->get('gotoview')) {
               return $this->redirect(['/bangladesh/customer/view', 'id' => $id]);
            }
            else{
                return $this->redirect(['/bangladesh/customer/update', 'id' => $id,'module_id'=>$module_id]);
            }
            

        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing CustomerPic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$module_id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->date_update = date('Y-m-d h:i:s');
            $model->update_by= Yii::$app->user->identity->id;
            $model->save();
            Yii::$app->getSession()->setFlash('updatePic', 'Data Person In Charge <b>'.$model->name.'</b> Successful Updated');

            return $this->redirect(['/bangladesh/customer/update', 'id' => $model->customer_id,'module_id'=>$module_id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CustomerPic model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$customer_id,$module_id)
    {
        $model = $this->findModel($id);
        $name = $model->name;
        $model->delete();

        Yii::$app->getSession()->setFlash('deletePic', 'Data Person In Charge <b>'.$name.'</b> Successful Deleted');
        return $this->redirect(['/bangladesh/customer/update', 'id' => $customer_id,'module_id'=>$module_id]);
    }


    /**
     * Finds the CustomerPic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerPic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerPic::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
