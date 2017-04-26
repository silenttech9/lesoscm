<?php

namespace frontend\modules\thailand\controllers;

use Yii;
use frontend\modules\thailand\models\SalesActivity;
use frontend\modules\thailand\models\SalesActivitySearch;
use frontend\modules\thailand\models\SalesActivityLog;
use frontend\modules\thailand\models\SalesActivityLogSearch;
use frontend\modules\malaysia\models\CustomerPic;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\modules\thailand\models\Customer;
use frontend\models\Reminder;
use frontend\models\ReminderLog;
use frontend\models\Message;
use frontend\models\MessageLog;
/**
 * SalesActivityController implements the CRUD actions for SalesActivity model.
 */
class SalesActivityController extends Controller
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
     * Lists all SalesActivity models.
     * @return mixed
     */
    public function actionIndex($module_id)
    {
        $searchModel = new SalesActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['sales_activity.module_id'=>$module_id]);

        return $this->render('index', [
            'module_id' => $module_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SalesActivity model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SalesActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($module_id)
    {
        $model = new SalesActivity();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {


            $cust = $_POST['SalesActivity']['customer_id'];
            $check = SalesActivity::find()->where(['customer_id'=>$cust])->exists();
            $mdl = SalesActivity::find()->where(['customer_id'=>$cust])->one();

            if ($check == 1) {

                 return $this->redirect(['process', 'id' => $mdl->id]);

            } else {

                $model->date_create = date('Y-m-d h:i:s');
                $model->enter_by= Yii::$app->user->identity->id;
                $model->module_id = $module_id;

                 $model->save();
                return $this->redirect(['process', 'id' => $model->id]);

            }

        } else {
            return $this->renderAjax('create', [
                'module_id' => $module_id,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SalesActivity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$module_id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {


            $model->date_update = date('Y-m-d h:i:s');
            $model->update_by= Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['process', 'id' => $model->id]);
        } else {
            return $this->renderAjax('update', [
                'module_id' => $module_id,
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing SalesActivity model.
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
     * Finds the SalesActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SalesActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SalesActivity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCusts($q = null, $id = null){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT id,company_name AS text FROM customer WHERE company_name LIKE "%'.$q.'%" AND module_id = 3');

       // $query = "SELECT * FROM `post` where `title` LIKE 'foo%' ";
        $model = $sql->queryAll();
        $out['results'] = array_values($model);

        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Customer::find($id)->company_name];
        }
        return $out;
    }

    public function actionAddress($id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM customer WHERE id = '".$id."'");

        $address = $sql->queryAll();

        foreach ($address as $key => $value) {
            echo "<p> Address : <span class='font-blue-steel bold'>".$value['address']."</span></p>";
        }
    }


    public function actionProcess($id)
    {
        $searchModel = new SalesActivityLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id_sales_activity'=>$id]);
        $model2 = new SalesActivityLog();

        $model3 = new Reminder();
        $model4 = new ReminderLog();

        $model5 = new Message();
        $model6 = new MessageLog();

        $model7 = new Message();
        $model8 = new MessageLog();

        $mdl = SalesActivity::find()->where(['id'=>$id])->one();



        if ($model2->load(Yii::$app->request->post())) {

            $model2->date_create = date('Y-m-d h:i:s');
            $model2->enter_by= Yii::$app->user->identity->id;
            $model2->id_sales_activity = $id;


            $model2->save();
            if ($_POST['SalesActivityLog']['reminder'] == "Yes") {

                $model3->datetime_reminder = $_POST['SalesActivityLog']['reminder_time'];
                $model3->module = "Sales Activity";
                $model3->status = "Pending";
                $model3->notification = "unread";
                $model3->reminder_to = Yii::$app->user->identity->id;
                $model3->date_create = date('Y-m-d h:i:s');
                $model3->enter_by= Yii::$app->user->identity->id;


                if ($model3->save()) {
                    $last_id = Yii::$app->db->getLastInsertID();

                    $model4->reminder_id= $last_id;
                    $model4->id_module= $model2->id_sales_activity;
                    $model4->log_reminder = $_POST['SalesActivityLog']['reminder_remark'];
                    $model4->save();


                }

            }



            if ($_POST['SalesActivityLog']['sales_visit'] == "Yes") {
                $model5->module = "Sales Activity";
                $model5->sub_module = "Sales Visit";
                $model5->status = "Pending";
                $model5->message_from = Yii::$app->user->identity->id;
                $model5->message_to = $_POST['SalesActivityLog']['sales_specialist_id'];
                $model5->date_create = date('Y-m-d h:i:s');
                $model5->enter_by= Yii::$app->user->identity->id;
                $model5->notification = "Unread";
                $model5->id_module = $model2->id_sales_activity;


                if ($model5->save()) {
                   $last_id_sale_visit = Yii::$app->db->getLastInsertID();
                   $model6->message_id= $last_id_sale_visit;
                   $model6->log_message = $_POST['SalesActivityLog']['sales_visit_information'];
                   $model6->save();


                }
                
            } if ($_POST['SalesActivityLog']['quotation'] == "Yes") {
                $model7->module = "Sales Activity";
                $model7->sub_module = "Quotation";
                $model7->status = "Pending";
                $model7->message_from = Yii::$app->user->identity->id;
                $model7->message_to = $_POST['SalesActivityLog']['sales_agent'];
                $model7->date_create = date('Y-m-d h:i:s');
                $model7->enter_by= Yii::$app->user->identity->id;
                $model7->notification = "Unread";
                $model7->id_module = $model2->id_sales_activity;

                if ($model7->save()) {
                   $last_id_quotation = Yii::$app->db->getLastInsertID();
                   $model8->message_id= $last_id_quotation;
                   $model8->log_message = $_POST['SalesActivityLog']['remark'];
                   $model8->save();


                }
                
            }


            return $this->redirect(['process', 'id' => $id]);

        } else {

            return $this->render('process', [
                'model' => $this->findModel($id),
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model2' => $model2,
                'mdl' => $mdl,
            ]);
        }
    }


    public function actionShow($id)
    {
        $searchModel = new SalesActivityLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id_sales_activity'=>$id]);
        $model2 = new SalesActivityLog();


        return $this->render('show', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model2' => $model2,
        ]);



    }
    
    public function actionCreatemorepic($cust_id,$id)
    {
        $model = new CustomerPic();

        if ($model->load(Yii::$app->request->post())) {
            $model->name =  strtoupper($_POST['CustomerPic']['name']);
            $model->department =  strtoupper($_POST['CustomerPic']['department']);
            $model->date_create = date('Y-m-d h:i:s');
            $model->enter_by= Yii::$app->user->identity->id;
            $model->customer_id = $cust_id;

            $model->save();
                // Yii::$app->getSession()->setFlash('createPic_quote', 'Data Person In Charge <b>'.$model->name.'</b> Successful Saved');
            return $this->redirect(['process', 'id' => $id]);
        
        } else {
            return $this->renderAjax('createmorepic', [
                'model' => $model,
                // 'state_id'=>$state_id,
            ]);
        }

    }

    public function actionSalepic($id){

        $connection = \Yii::$app->db;
        $sql2 = $connection->createCommand("SELECT * FROM customer_pic WHERE id = '".$id."'");

        $model = $sql2->queryAll();

        foreach ($model as $key => $value) {
            echo "<span class='font-red-soft font-md'>".$value['country_code_phone'].$value['area_code_phone'].$value['telephone_no']."</span>";
            echo "<br>";
            echo "<br>";
        }

    }




}
