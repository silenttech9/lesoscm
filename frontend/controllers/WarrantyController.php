<?php

namespace frontend\controllers;

use Yii;
use common\models\Warranty;
use common\models\WarrantySearch;
use common\models\WarrantyLog;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\modules\malaysia\models\Customer;
use frontend\modules\malaysia\models\CustomerPic;
use frontend\modules\malaysia\models\SelangorInvoice;
use frontend\modules\malaysia\models\PenangInvoice;
use frontend\modules\malaysia\models\JohorInvoice;
use yii\data\ActiveDataProvider;
/**
 * WarrantyController implements the CRUD actions for Warranty model.
 */
class WarrantyController extends Controller
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
     * Lists all Warranty models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WarrantySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Warranty model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $invoice = SelangorInvoice::find()->where(['id'=>$id])->one();

        $dataProvider = new ActiveDataProvider([
            'query' => Warranty::find()
                    ->where(['invoice_id'=>$id]),
        ]);

        return $this->render('view', [
            'invoice' => $invoice,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Warranty model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id,$state_id)
    {
        $model = new Warranty();
        

            if ($state_id == 13) {
                 $invoice = SelangorInvoice::find()->where(['id'=>$id])->one();
            } elseif ($state_id == 23) {
                 $invoice = PenangInvoice::find()->where(['id'=>$id])->one();
            } elseif ($state_id == 22) {
                 $invoice = JohorInvoice::find()->where(['id'=>$id])->one();
            }

        if ($model->load(Yii::$app->request->post())) {

            $serial = count($_POST['Warranty']['serial_number']);

            for ($i=0; $i < $serial; $i++) { 
                $model =new Warranty();
                $model->serial_number = strtoupper($_POST['Warranty']['serial_number'][$i]);
                $model->warranty_period = $_POST['Warranty']['warranty_period'][$i];
                $model->delivery_mode_id = $_POST['Warranty']['delivery_mode_id'];
                $model->delivery_date = $_POST['Warranty']['delivery_date'];
                $model->consignment_number = $_POST['Warranty']['consignment_number'];
                $model->date_create = date('Y-m-d h:i:s');
                $model->enter_by= Yii::$app->user->identity->id;
                $model->customer_id = $_POST['Warranty']['customer_id'];
                $model->customer_pic_id = $_POST['Warranty']['customer_pic_id'];
                $model->invoice_id = $id;
                $model->state_id = $state_id;
                $model->reminder = 'Yes';
                $model->day_for_services = '305';

                $model->save();
                
                $log = new WarrantyLog();
                
             	$log->user = Yii::$app->user->identity->id;
            	$log->date_process = date('Y-m-d h:i:s A');
            	$log->warranty_id = $model->id;
            	$log->action = 'Add Serial Number';
            	$log->invoice_id = $id;

            	$log->save();
               
            }

            $invoice->status = 'Updated';
            $invoice->save();

            if ($state_id == 13) {
                return $this->redirect(['/malaysia/selangor-invoice/view', 'id' => $model->invoice_id,'state_id'=>$state_id]);
            } elseif ($state_id == 23) {
                return $this->redirect(['/malaysia/penang-invoice/view', 'id' => $model->invoice_id,'state_id'=>$state_id]);
            } elseif ($state_id == 22) {
                return $this->redirect(['/malaysia/johor-invoice/view', 'id' => $model->invoice_id,'state_id'=>$state_id]);
            }

           
        } else {
            return $this->render('create', [
                'model' => $model,
                'state_id' => $state_id,
            ]);
        }
    }

    /**
     * Updates an existing Warranty model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$state_id)
    {
        $model = $this->findModel($id);
        $log = new WarrantyLog();
        if ($model->load(Yii::$app->request->post())) {

            $model->date_update = date('Y-m-d h:i:s');
            $model->update_by= Yii::$app->user->identity->id;
            $model->save();

            $log->user = Yii::$app->user->identity->id;
            $log->date_process = date('Y-m-d h:i:s A');
            $log->warranty_id = $id;
            $log->action = 'Update Warranty';
            $log->invoice_id = $model->invoice_id;

            $log->save();

            if ($state_id == 13) {
                return $this->redirect(['/malaysia/selangor-invoice/view', 'id' => $model->invoice_id,'state_id'=>$state_id]);
            } elseif ($state_id == 23) {
                return $this->redirect(['/malaysia/penang-invoice/view', 'id' => $model->invoice_id,'state_id'=>$state_id]);
            } elseif ($state_id == 22) {
                return $this->redirect(['/malaysia/johor-invoice/view', 'id' => $model->invoice_id,'state_id'=>$state_id]);
            }


        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'state_id' => $state_id,
            ]);
        }
    }

    /**
     * Deletes an existing Warranty model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$state_id,$invoice_id)
    {
        $model2 = Warranty::find()
                ->where(['invoice_id'=>$invoice_id])
                ->andWhere(['state_id'=>$state_id])
                ->count();
        $model = $this->findModel($id);

        if ($model2 == 1) {
            if ($state_id == 13) {
                $invoice = SelangorInvoice::find()
                        ->where(['id'=>$invoice_id])
                        ->one();
                $invoice->status = '';
                $invoice->save();

            } elseif ($state_id == 23) {
                $invoice = PenangInvoice::find()
                        ->where(['id'=>$invoice_id])
                        ->one();
                $invoice->status = '';
                $invoice->save();

            } elseif ($state_id == 22) {
                $invoice = JohorInvoice::find()
                        ->where(['id'=>$invoice_id])
                        ->one();
                $invoice->status = '';
                $invoice->save();

            }
        }
        else{}

        $model->delete();

        $log = new WarrantyLog();
        $log->user = Yii::$app->user->identity->id;
        $log->date_process = date('Y-m-d h:i:s A');
        $log->warranty_id = $id;
        $log->action = 'Delete Warranty';
        $log->invoice_id = $invoice_id;

        $log->save();

        if ($state_id == 13) {
            return $this->redirect(['/malaysia/selangor-invoice/view', 'id' => $invoice_id,'state_id'=>$state_id]);
        } elseif ($state_id == 23) {
            return $this->redirect(['/malaysia/penang-invoice/view', 'id' => $invoice_id,'state_id'=>$state_id]);
        } elseif ($state_id == 22) {
            return $this->redirect(['/malaysia/johor-invoice/view', 'id' => $invoice_id,'state_id'=>$state_id]);
        }

    }
    /**
     * Finds the Warranty model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Warranty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Warranty::findOne($id)) !== null) {
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
        
        // $sql = $connection->createCommand('SELECT id,company_name AS text FROM customer WHERE company_name LIKE "%'.$q.'%" AND render_state_id = 13 OR render_state_id = 20 OR render_state_id = 21');

        $sql = $connection->createCommand('SELECT id,company_name AS text FROM customer WHERE company_name LIKE "%'.$q.'%" AND render_state_id IN ( 13,20,21 )');
       // $query = "SELECT * FROM `post` where `title` LIKE 'foo%' ";
        $model = $sql->queryAll();
        $out['results'] = array_values($model);

        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Customer::find($id)->company_name];
        }
        return $out;
    }

    public function actionCustp($q = null, $id = null){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT id,company_name AS text FROM customer WHERE company_name LIKE "%'.$q.'%" AND render_state_id = 23');

       // $query = "SELECT * FROM `post` where `title` LIKE 'foo%' ";
        $model = $sql->queryAll();
        $out['results'] = array_values($model);

        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Customer::find($id)->company_name];
        }
        return $out;
    }

    public function actionCustj($q = null, $id = null){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT id,company_name AS text FROM customer WHERE company_name LIKE "%'.$q.'%" AND render_state_id = 22');

       // $query = "SELECT * FROM `post` where `title` LIKE 'foo%' ";
        $model = $sql->queryAll();
        $out['results'] = array_values($model);

        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Customer::find($id)->company_name];
        }
        return $out;
    }


    public function actionCustsrk($q = null, $id = null){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT id,company_name AS text FROM customer WHERE company_name LIKE "%'.$q.'%" AND render_state_id = 21');

       // $query = "SELECT * FROM `post` where `title` LIKE 'foo%' ";
        $model = $sql->queryAll();
        $out['results'] = array_values($model);

        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Customer::find($id)->company_name];
        }
        return $out;
    }


    public function actionCustsbh($q = null, $id = null){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT id,company_name AS text FROM customer WHERE company_name LIKE "%'.$q.'%" AND render_state_id = 20');

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
           echo "<option value=''>Please Choose</option>";
           foreach ($posts as $post) {
               echo "<option value='".$post->id."'>".$post->name."</option>";
           }

        } else {

            echo "<option value=''>-</option>";
        }

    } 



    public function actionAction($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            if ($_POST['Warranty']['machine_end_of_life'] == "Yes") {
                
                $model->machine_end_of_life = $_POST['Warranty']['machine_end_of_life'];
                $model->service_required = "No";
                $model->reminder = "No";
               

            } else {


                

            }
                
             $model->save();


            
            return $this->redirect(['view', 'id' => $model->invoice_id]);
        } else {
            return $this->renderAjax('action', [
                'model' => $model,
            ]);
        }
    }


    public function actionWarrantypic($id){

        $connection = \Yii::$app->db;
        $sql2 = $connection->createCommand("SELECT * FROM customer_pic WHERE id = '".$id."'");

        $model = $sql2->queryAll();

        foreach ($model as $key => $value) {
            echo "<span class='font-red-soft font-md'>".$value['email']."</span>";
            echo "<br>";
            echo "<br>";
        }

    } 

    public function actionSearching($state_id)
    {

        return $this->render('searching',[
            'state_id' => $state_id,
        ]);
    }

    public function actionReturn(){

        $serial = $_POST['vals'];
        $invoice = $_POST['vali'];
        $state = $_POST['state'];

        if (!empty($serial)) {

            $connection = \Yii::$app->db;
            $sql = $connection->createCommand('SELECT * FROM warranty LEFT JOIN lookup_delivery_mode ON warranty.delivery_mode_id = lookup_delivery_mode.id
             WHERE warranty.serial_number = "'.$serial.'" ');
            $model = $sql->queryAll();
            foreach ($model as $key => $value) {
                $invoice_id = $value['invoice_id'];
                echo "<div class='about-quote'>";
                echo "<h4><b>SERIAL NO. : </b>".$value['serial_number']."</h4>";
                echo "<h4><b>DELIVERY MODE. : </b>".$value['delivery_type']."</h4>";
                echo "<h4><b>DELIVERY DATE. : </b>".$value['delivery_date']."</h4>";
                echo "<h4><b>CONSIGMENT NO. : </b>".$value['consignment_number']."</h4>";
                echo "<br>";
            }

            if ($state == 13) {
                $sql2 = \Yii::$app->db2->createCommand('SELECT * FROM selangor_invoice WHERE id = "'.$invoice_id.'" ');
                $model2 = $sql2->queryAll();

            } elseif ($state == 23) {
                $sql2 = \Yii::$app->db2->createCommand('SELECT * FROM penang_invoice WHERE id = "'.$invoice_id.'" ');
                $model2 = $sql2->queryAll();
            } elseif ($state == 22) {
                $sql2 = \Yii::$app->db2->createCommand('SELECT * FROM johor_invoice WHERE id = "'.$invoice_id.'" ');
                $model2 = $sql2->queryAll();
            }





            foreach ($model2 as $key => $value2) {

                echo "<h4><b>INVOICE NO. : </b>".$value2['ref_no']."</h4>";
                echo "<h4><b>ITEM NO. : </b>".$value2['item_no']."</h4>";
                echo "<h4><b>DESCRIPTION : </b>".$value2['description']."</h4>";
                echo "<h4><b>QUANTITY : </b>".$value2['quantity']."</h4>";
                echo "<h4><b>CUSTOMER : </b>".$value2['company_name']."</h4>";
                echo "<h4><b>AGENT : </b>".$value2['agent']."</h4>";
                echo "</div>";
                
            }


           
        } elseif (!empty($invoice)) {

            $connection = \Yii::$app->db;

            if ($state == 13) {
                $sql2 = \Yii::$app->db2->createCommand('SELECT * FROM selangor_invoice WHERE id = "'.$invoice_id.'" ');
                $model2 = $sql2->queryAll();

            } elseif ($state == 23) {
                $sql2 = \Yii::$app->db2->createCommand('SELECT * FROM penang_invoice WHERE id = "'.$invoice_id.'" ');
                $model2 = $sql2->queryAll();
            } elseif ($state == 22) {
                $sql2 = \Yii::$app->db2->createCommand('SELECT * FROM johor_invoice WHERE id = "'.$invoice_id.'" ');
                $model2 = $sql2->queryAll();
            }


            echo "<div class='about-quote'>";
            foreach ($model2 as $key => $value2) {
                $id = $value2['id'];
                
                echo "<h4><b>INVOICE NO. : </b>".$value2['ref_no']."</h4>";
                echo "<h4><b>ITEM NO. : </b>".$value2['item_no']."</h4>";
                echo "<h4><b>DESCRIPTION : </b>".$value2['description']."</h4>";
                echo "<h4><b>QUANTITY : </b>".$value2['quantity']."</h4>";
                echo "<h4><b>CUSTOMER : </b>".$value2['company_name']."</h4>";
                echo "<h4><b>AGENT : </b>".$value2['agent']."</h4>";
                
                echo "<br>";
                
            }
            echo "</div>";

            $sql = $connection->createCommand('SELECT * FROM warranty LEFT JOIN lookup_delivery_mode ON warranty.delivery_mode_id = lookup_delivery_mode.id
             WHERE warranty.invoice_id = "'.$id.'" ');
            $model = $sql->queryAll();


            echo "<table class='table'>";
            echo "<tr>";
            echo "<th>No</th><th>Serial No</th><th>Delivery Mode</th><th>Delivery Date</th><th>Consignment No.</th>";
            echo "</tr>";
            

           $i =0; foreach ($model as $key => $value) { $i++;
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$value['serial_number']."</td>";
                echo "<td>".$value['delivery_type']."</td>";
                echo "<td>".$value['delivery_date']."</td>";
                echo "<td>".$value['consignment_number']."</td>";
                echo "</tr>";

            }
            
            echo "</table>";


        } elseif (empty($serial) || empty($invoice) ) {
            
                echo $state;
                echo "<div class='about-quote'>";
                echo "<h4><b>NO DATA</b></h4>";
                echo "</div>";
        }



    }


    public function actionTestwizard($id,$state_id)
    {   
        $model = new Warranty();
        $log = new WarrantyLog();

            if ($state_id == 13) {
                 $invoice = SelangorInvoice::find()->where(['id'=>$id])->one();
            } elseif ($state_id == 23) {
                 $invoice = PenangInvoice::find()->where(['id'=>$id])->one();
            } elseif ($state_id == 22) {
                 $invoice = JohorInvoice::find()->where(['id'=>$id])->one();
            }

       

        if ($model->load(Yii::$app->request->post())) {

            $serial = count($_POST['Warranty']['serial_number']);

            for ($i=0; $i < $serial; $i++) { 
                $model =new Warranty();
                $model->serial_number = strtoupper($_POST['Warranty']['serial_number'][$i]);
                $model->warranty_period = $_POST['Warranty']['warranty_period'][$i];
                $model->delivery_mode_id = $_POST['Warranty']['delivery_mode_id'];
                $model->delivery_date = $_POST['Warranty']['delivery_date'];
                $model->consignment_number = $_POST['Warranty']['consignment_number'];
                $model->date_create = date('Y-m-d h:i:s');
                $model->enter_by= Yii::$app->user->identity->id;
                $model->customer_id = $_POST['Warranty']['customer_id'];
                $model->customer_pic_id = $_POST['Warranty']['customer_pic_id'];
                $model->invoice_id = $id;
                $model->state_id = $state_id;
                $model->reminder = 'Yes';
                $model->day_for_services = '305';

                $model->save();
                
            }

            $log->user = Yii::$app->user->identity->id;
            $log->date_process = date('Y-m-d h:i:s A');
            $log->warranty_id = $model->id;
            $log->action = 'Add Serial Number';
            $log->invoice_id = $id;

            $log->save();

            $invoice->status = 'Updated';
            $invoice->save();

            if ($state_id == 13) {
                return $this->redirect(['/malaysia/selangor-invoice/view', 'id' => $model->invoice_id,'state_id'=>$state_id]);
            } elseif ($state_id == 23) {
                return $this->redirect(['/malaysia/penang-invoice/view', 'id' => $model->invoice_id,'state_id'=>$state_id]);
            } elseif ($state_id == 22) {
                return $this->redirect(['/malaysia/johor-invoice/view', 'id' => $model->invoice_id,'state_id'=>$state_id]);
            }

           
        } else {
            return $this->render('testwizard', [
                'model' => $model,
                'state_id' => $state_id,
            ]);
        }

    }
    
    public function actionCustall($q = null, $id = null){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT id,company_name AS text FROM customer WHERE company_name LIKE "%'.$q.'%"');

       // $query = "SELECT * FROM `post` where `title` LIKE 'foo%' ";
        $model = $sql->queryAll();
        $out['results'] = array_values($model);

        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Customer::find($id)->company_name];
        }
        return $out;
    }






}
