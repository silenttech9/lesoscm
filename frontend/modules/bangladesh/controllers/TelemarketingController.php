<?php

namespace frontend\modules\bangladesh\controllers;

use Yii;
use frontend\modules\bangladesh\models\Telemarketing;
use frontend\modules\bangladesh\models\TelemarketingSearch;
use frontend\modules\bangladesh\models\TelemarketingCustomer;
use frontend\modules\bangladesh\models\TelemarketingCustomerSearch;
use frontend\modules\bangladesh\models\TelemarketingHistory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\modules\bangladesh\models\Customer;
use frontend\modules\bangladesh\models\CustomerPic;
use frontend\models\Reminder;
use frontend\models\ReminderLog;
use frontend\models\Message;
use frontend\models\MessageLog;

/**
 * TelemarketingController implements the CRUD actions for Telemarketing model.
 */
class TelemarketingController extends Controller
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
     * Lists all Telemarketing models.
     * @return mixed
     */
    public function actionIndex($module_id)
    {
        $searchModel = new TelemarketingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['telemarketing.module_id'=>$module_id]);

        return $this->render('index', [
            'module_id' => $module_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Telemarketing model.
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
     * Creates a new Telemarketing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate($module_id)
    {

        $model = new Telemarketing();
        
        if ($model->load(Yii::$app->request->post())) {

            $model->date_create = date('Y-m-d h:i:s');
            $model->enter_by= Yii::$app->user->identity->id;
            $model->module_id = $module_id;

            $model->save();
            return $this->redirect(['process', 'id' => $model->id]);

        } else {
            return $this->renderAjax('create', [
                'module_id' => $module_id,
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Telemarketing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->module_id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Telemarketing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$module_id)
    {
        $model = $this->findModel($id);
        $model2 = TelemarketingCustomer::find()
                ->where(['id_telemarketing'=>$id])
                ->limit(1)->one();
        $model3 = Message::find()
                ->where(['id_module'=>$id])
                ->limit(1)->one();
        $model4 = ReminderLog::find()
                ->where(['id_module'=>$id])
                ->limit(1)->one();
        
        if (isset($model2)) {
           TelemarketingHistory::deleteAll(['id_telemarketing_customer'=>$model2->id]);
            TelemarketingCustomer::deleteAll(['id_telemarketing'=>$id]);
        }
        
        if (isset($model3)) {
            MessageLog::deleteAll(['message_id'=>$model3->id]);
            Message::deleteAll(['id_module'=>$id]);
        }
        if (isset($model4)) {
            Reminder::deleteAll(['id'=>$model4->reminder_id]);
            ReminderLog::deleteAll(['id_module'=>$id]);
        }
        

        $model->delete();

        return $this->redirect(['index','module_id'=>$module_id]);
    }

    /**
     * Finds the Telemarketing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Telemarketing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Telemarketing::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionProcess($id)
    {

        $searchModel = new TelemarketingCustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id_telemarketing'=>$id]);
        $model2 = new TelemarketingCustomer();

        $model_history = new TelemarketingHistory();

        $model3 = new Reminder();
        $model4 = new ReminderLog();

        $model5 = new Message();
        $model6 = new MessageLog();

        $model7 = new Message();
        $model8 = new MessageLog();

        if ($model2->load(Yii::$app->request->post())) {


            $model2->date_create = date('Y-m-d h:i:s');
            $model2->enter_by= Yii::$app->user->identity->id;
            $model2->id_telemarketing = $id;



            $model2->save();

            $last_id = Yii::$app->db->getLastInsertID();



            if ($_POST['TelemarketingCustomer']['reminder'] == "Yes") {

                $model3->datetime_reminder = $_POST['TelemarketingCustomer']['datetime'];
                $model3->module = "Telemarketing";
                $model3->status = "Pending";
                $model3->notification = "unread";
                $model3->reminder_to = Yii::$app->user->identity->id;
                $model3->date_create = date('Y-m-d h:i:s');
                $model3->enter_by = Yii::$app->user->identity->id;

                if ($model3->save()) {
                    $last_id_telemarketing = Yii::$app->db->getLastInsertID();

                    $model4->reminder_id= $last_id_telemarketing;
                    $model4->id_module= $model2->id_telemarketing;
                    $model4->log_reminder = $_POST['TelemarketingCustomer']['remark_reminder'];
                    $model4->save();


                }

            }

            if ($_POST['TelemarketingCustomer']['sales_visit'] == "Yes") {

                $model5->module = "Telemarketing";
                $model5->sub_module = "Sales Visit";
                $model5->status = "Pending";
                $model5->message_from = Yii::$app->user->identity->id;
                $model5->message_to = $_POST['TelemarketingCustomer']['sales_specialist_id'];
                $model5->date_create = date('Y-m-d h:i:s');
                $model5->enter_by= Yii::$app->user->identity->id;
                $model5->notification = "Unread";
                $model5->id_module = $model2->id_telemarketing;


                if ($model5->save()) {
                   $last_id_sale_visit = Yii::$app->db->getLastInsertID();
                   $model6->message_id= $last_id_sale_visit;
                   $model6->log_message = $_POST['TelemarketingCustomer']['sales_visit_information'];
                   $model6->save();


                }
                
            }

if ($_POST['TelemarketingCustomer']['quotation'] == "Yes") {
                $model7->module = "Telemarketing";
                $model7->sub_module = "Quotation";
                $model7->status = "Pending";
                $model7->message_from = Yii::$app->user->identity->id;
                $model7->message_to = $_POST['TelemarketingCustomer']['sales_agent'];
                $model7->date_create = date('Y-m-d h:i:s');
                $model7->enter_by= Yii::$app->user->identity->id;
                $model7->notification = "Unread";
                $model7->id_module = $model2->id_telemarketing;

                if ($model7->save()) {
                   $last_id_quotation = Yii::$app->db->getLastInsertID();
                   $model8->message_id= $last_id_quotation;
                   $model8->log_message = $_POST['TelemarketingCustomer']['remark'];
                   $model8->save();


                }
                
            }



            $connection = \Yii::$app->db;
            $sql = $connection->createCommand("SELECT 
                customer.company_name AS company ,
                customer_pic.name AS pic,
                telemarketing_customer.activity,
                telemarketing_customer.reminder,
                telemarketing_customer.datetime,
                telemarketing_customer.remark_reminder,
                telemarketing_customer.sales_visit,
                telemarketing_customer.sales_visit_date,
                sp.username AS specialist_agent,
                telemarketing_customer.sales_visit_information,
                telemarketing_customer.quotation,
                ag.username AS sale_agent,
                telemarketing_customer.remark,
                telemarketing_customer.date_create,
                telemarketing_customer.date_update,
                en.username AS enterBy,
                up.username AS updateBy
                
            FROM telemarketing_customer 
            LEFT JOIN customer ON customer.id = telemarketing_customer.customer_id
            LEFT JOIN customer_pic ON customer_pic.id = telemarketing_customer.customer_pic_id
            LEFT JOIN user AS sp ON sp.id = telemarketing_customer.sales_specialist_id
            LEFT JOIN user AS ag ON ag.id = telemarketing_customer.sales_agent
            LEFT JOIN user AS en ON en.id = telemarketing_customer.enter_by
            LEFT JOIN user AS up ON up.id = telemarketing_customer.update_by
            WHERE telemarketing_customer.id  =  '".$last_id."'");

            $model_details = $sql->queryAll();

            $data_history = serialize($model_details);

            $model_history->history = $data_history;
            $model_history->date_create = date('Y-m-d h:i:s');
            $model_history->enter_by= Yii::$app->user->identity->id;
            $model_history->id_telemarketing_customer = $last_id;
            $model_history->save();

            return $this->redirect(['process', 'id' => $id]);
        } else {

            return $this->render('process', [
                'model' => $this->findModel($id),
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model2' => $model2,
            ]);
        }
    }

    public function actionChange($id)
    {

        $searchModel = new TelemarketingCustomerSearch();
        $model2 = TelemarketingCustomer::find()->where(['id'=>$id])->one();

        $id_telemarketing =  $model2->id_telemarketing;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['id_telemarketing'=>$id_telemarketing]);
        $model_history = new TelemarketingHistory();


        if ($model2->load(Yii::$app->request->post())) {

            $model2->date_update = date('Y-m-d h:i:s');
            $model2->update_by = Yii::$app->user->identity->id;
            $model2->save();

            $connection = \Yii::$app->db;
            $sql = $connection->createCommand("SELECT 
                customer.company_name AS company ,
                customer_pic.name AS pic,
                telemarketing_customer.activity,
                telemarketing_customer.reminder,
                telemarketing_customer.datetime,
                telemarketing_customer.remark_reminder,
                telemarketing_customer.sales_visit,
                telemarketing_customer.sales_visit_date,
                sp.username AS specialist_agent,
                telemarketing_customer.sales_visit_information,
                telemarketing_customer.quotation,
                ag.username AS sale_agent,
                telemarketing_customer.remark,
                telemarketing_customer.date_create,
                telemarketing_customer.date_update,
                en.username AS enterBy,
                up.username AS updateBy
                
            FROM telemarketing_customer 
            LEFT JOIN customer ON customer.id = telemarketing_customer.customer_id
            LEFT JOIN customer_pic ON customer_pic.id = telemarketing_customer.customer_pic_id
            LEFT JOIN user AS sp ON sp.id = telemarketing_customer.sales_specialist_id
            LEFT JOIN user AS ag ON ag.id = telemarketing_customer.sales_agent
            LEFT JOIN user AS en ON en.id = telemarketing_customer.enter_by
            LEFT JOIN user AS up ON up.id = telemarketing_customer.update_by
            WHERE telemarketing_customer.id  =  '".$id."'");

            $model_details = $sql->queryAll();

            $data_history = serialize($model_details);

            $model_history->history = $data_history;
            $model_history->date_update = date('Y-m-d h:i:s');
            $model_history->update_by= Yii::$app->user->identity->id;
            $model_history->id_telemarketing_customer = $id;
            $model_history->save();


            return $this->redirect(['process', 'id' => $id_telemarketing]);



        } else {

            return $this->render('change', [
                'model' => $this->findModel($id_telemarketing),
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model2' => $model2,
            ]);
        }




    }



    public function actionCusts($q = null, $id = null){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT id,company_name AS text FROM customer WHERE company_name LIKE "%'.$q.'%" AND module_id = 8');

       // $query = "SELECT * FROM `post` where `title` LIKE 'foo%' ";
        $model = $sql->queryAll();
        $out['results'] = array_values($model);

        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Customer::find($id)->company_name];
        }
        return $out;
    }


    public function actionShip($id){

        $countPosts = CustomerPic::find()
        ->where(['customer_id'=>$id])
        ->count();
        $posts = CustomerPic::find()
        ->where(['customer_id'=>$id])
        ->all();

        if ($countPosts>0) {
           echo "<option value='Please Choose'>Please Choose</option>";
           foreach ($posts as $post) {
               echo "<option value='".$post->id."'>".$post->name."</option>";
           }

        } else {

            echo "<option value=''>-</option>";
        }

    } 


    public function actionPic($id){

        $connection = \Yii::$app->db;
        $sql2 = $connection->createCommand("SELECT * FROM customer_pic WHERE id = '".$id."'");

        $model = $sql2->queryAll();

        foreach ($model as $key => $value) {
            echo "<span class='font-red-soft font-md'>".$value['telephone_no']."</span>";
            echo "<br>";
            echo "<br>";
        }

    } 

    public function actionShow($id)
    {

        $searchModel = new TelemarketingCustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id_telemarketing'=>$id]);
        $model2 = new TelemarketingCustomer();


        return $this->render('show', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model2' => $model2,
        ]);



    }



}
