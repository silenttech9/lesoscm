<?php

namespace frontend\controllers;

use Yii;
use frontend\models\JobOrder;
use frontend\models\JobOrderSearch;
use frontend\models\JoborderLog;
use frontend\models\NotifyJoborder;
use frontend\modules\malaysia\models\Customer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\modules\malaysia\models\CustomerPic;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use kartik\mpdf\Pdf;
use yii\helpers\Json;
use yii\db\Query;
/**
 * JobOrderController implements the CRUD actions for JobOrder model.
 */
class JobOrderController extends Controller
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
     * Lists all JobOrder models.
     * @return mixed
     */
    public function actionIndex($render_state_id)
    {
        $searchModel = new JobOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['job_order.render_state_id'=>$render_state_id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'render_state_id'=>$render_state_id,

        ]);
    }

    public function actionBystatus($render_state_id,$status)
    {
        $searchModel = new JobOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['job_order.status'=>$status]);
        $dataProvider->query->andWhere(['job_order.render_state_id'=>$render_state_id]);

        return $this->render('bystatus', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'render_state_id'=>$render_state_id,
            'status'=>$status,

        ]); 
    }

    /**
     * Displays a single JobOrder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model2 = CustomerPic::find()
                ->where(['id'=>$model->customer_name])
                ->one();
        $model4 = NotifyJoborder::find()
                ->where(['job_order_id'=>$id])
                ->max('id');

        $model5 = NotifyJoborder::find()
                ->where(['id'=>$model4])
                ->one();
        $model6 = JoborderLog::find()
                ->where(['job_order_id'=>$id])
                ->limit(1)->one();

        if (Yii::$app->request->get('notify') == true) {
             $model3 = NotifyJoborder::find()
                ->where(['id'=>Yii::$app->request->get('notify')])
                ->one();

            $model3->read_notify = 'read';
            $model3->save();
        }
        else{}
       
        // $dataProvider = new ActiveDataProvider([
        //     'query' => CustomerPic::find()
        //             ->where(['id'=>$model->customer_name])
        // ]);

        return $this->render('view', [
            'model' => $model,
            'model2'=>$model2,
            'model5'=>$model5,
            'model6'=>$model6,
        ]);
    }

    /**
     * Creates a new JobOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($render_state_id)
    {
        $model = new JobOrder();
        $model2 = new JoborderLog();

        //render selangor
        if ($render_state_id == 13) {
            $getJobno = JobOrder::find()
                        ->where(['render_state_id'=>13])
                        ->orderBy(['id'=>SORT_DESC])
                        ->limit(1)->one();

            if (empty($getJobno->job_order_no)) {
                $runNo = 0001;
                $invID = str_pad($runNo, 4, '0', STR_PAD_LEFT);
                $jobno = 'KL-'.$invID.'';
                
            }
            else{
                $no = substr($getJobno->job_order_no, 3);
                $new = $no + 1;
                $newNo = str_pad($new, 4, '0', STR_PAD_LEFT);
                $runninNo = $newNo;

                $jobno = 'KL-'.$runninNo;
                // print($jobno);
            }
            // exit();
            $model->job_order_no = $jobno;
            $model->enter_by = Yii::$app->user->identity->id;
            $model->created_at = date('Y-m-d h:i:s');
            $model->date_joborder = date('d/m/Y h:i:s A');
            $model->render_state_id = $render_state_id;
            $model->status = 'Awaiting Troubleshoot';

            if ($model->load(Yii::$app->request->post()) ) {

                $model->brand = strtoupper($_POST['JobOrder']['brand']);
                $model->model = strtoupper($_POST['JobOrder']['model']);
                $model->serial_no = strtoupper($_POST['JobOrder']['serial_no']);
                $model->accessory = strtoupper($_POST['JobOrder']['accessory']);
                $model->receiver_name = strtoupper($_POST['JobOrder']['receiver_name']);

                if ($model->save()) {
                    $model2->status = $model->status;
                    $model2->job_order_id = $model->id;
                    $model2->date_joborder = date('d/m/Y h:i:s A');
                    $model2->enter_by = $model->enter_by;
                    $model2->job_order_no = $model->job_order_no;  
                }

                $model2->save();
                return $this->redirect(['index','render_state_id'=>$render_state_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'render_state_id'=>$render_state_id,
                ]);
            }
        }
        //render pulau pinang
        elseif($render_state_id == 23)
        {
            $getJobno = JobOrder::find()
                        ->where(['render_state_id'=>23])
                        ->orderBy(['id'=>SORT_DESC])
                        ->limit(1)->one();

            if (empty($getJobno->job_order_no)) {
                $runNo = 0001;
                $invID = str_pad($runNo, 4, '0', STR_PAD_LEFT);
                $jobno = 'PG-'.$invID.'';
            }
            else{
                $no = substr($getJobno->job_order_no, 3);
                $new = $no + 1;
                $newNo = str_pad($new, 4, '0', STR_PAD_LEFT);
                $runninNo = $newNo;

                $jobno = 'PG-'.$runninNo;
            }
            $model->job_order_no = $jobno;
            $model->enter_by = Yii::$app->user->identity->id;
            $model->created_at = date('Y-m-d h:i:s');
            $model->date_joborder = date('d/m/Y h:i:s A');
            $model->render_state_id = $render_state_id;
            $model->status = 'Awaiting Troubleshoot';

            if ($model->load(Yii::$app->request->post())) {
                $model->brand = strtoupper($_POST['JobOrder']['brand']);
                $model->model = strtoupper($_POST['JobOrder']['model']);
                $model->serial_no = strtoupper($_POST['JobOrder']['serial_no']);
                $model->accessory = strtoupper($_POST['JobOrder']['accessory']);
                $model->receiver_name = strtoupper($_POST['JobOrder']['receiver_name']);

                if ($model->save()) {
                    $model2->status = $model->status;
                    $model2->job_order_id = $model->id;
                    $model2->date_joborder = date('d/m/Y h:i:s A');
                    $model2->enter_by = $model->enter_by;
                    $model2->job_order_no = $model->job_order_no;  
                }
                $model2->save();

                return $this->redirect(['index','render_state_id'=>$render_state_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'render_state_id'=>$render_state_id,
                ]);
            }
        }
        //render johor
        elseif ($render_state_id == 22) {
            $getJobno = JobOrder::find()
                        ->where(['render_state_id'=>22])
                        ->orderBy(['id'=>SORT_DESC])
                        ->limit(1)->one();

            if (empty($getJobno->job_order_no)) {
                $runNo = 0001;
                $invID = str_pad($runNo, 4, '0', STR_PAD_LEFT);
                $jobno = 'JB-'.$invID.'';
            }
            else{
                $no = substr($getJobno->job_order_no, 3);
                $new = $no + 1;
                $newNo = str_pad($new, 4, '0', STR_PAD_LEFT);
                $runninNo = $newNo;

                $jobno = 'JB-'.$runninNo;
            }
            $model->job_order_no = $jobno;
            $model->enter_by = Yii::$app->user->identity->id;
            $model->created_at = date('Y-m-d h:i:s');
            $model->date_joborder = date('d/m/Y h:i:s A');
            $model->render_state_id = $render_state_id;
            $model->status = 'Awaiting Troubleshoot';

            if ($model->load(Yii::$app->request->post()) ) {

                $model->brand = strtoupper($_POST['JobOrder']['brand']);
                $model->model = strtoupper($_POST['JobOrder']['model']);
                $model->serial_no = strtoupper($_POST['JobOrder']['serial_no']);
                $model->accessory = strtoupper($_POST['JobOrder']['accessory']);
                $model->receiver_name = strtoupper($_POST['JobOrder']['receiver_name']);
                
                // $model2->status = $model->status;
                // $model2->job_order_id = $model->id;
                // $model2->date_joborder = date('d/m/Y h:i:s A');
                // $model2->enter_by = $model->enter_by;
                // $model2->job_order_no = $model->job_order_no;

                if ($model->save()) {
                    $model2->status = $model->status;
                    $model2->job_order_id = $model->id;
                    $model2->date_joborder = date('d/m/Y h:i:s A');
                    $model2->enter_by = $model->enter_by;
                    $model2->job_order_no = $model->job_order_no;  
                }

                $model2->save();
                return $this->redirect(['index','render_state_id'=>$render_state_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'render_state_id'=>$render_state_id,
                ]);
            }
        }
        
    }

    /**
     * Updates an existing JobOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$render_state_id)
    {
        $model = $this->findModel($id);
        $model2 = NotifyJoborder::find()
                ->where(['job_order_id'=>$id])
                ->one();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->brand = strtoupper($_POST['JobOrder']['brand']);
            $model->model = strtoupper($_POST['JobOrder']['model']);
            $model->serial_no = strtoupper($_POST['JobOrder']['serial_no']);
            $model->accessory = strtoupper($_POST['JobOrder']['accessory']);
            $model->receiver_name = strtoupper($_POST['JobOrder']['receiver_name']);

            
            // if (isset($model2)) {
            //     $model2->user_id = $model->indoor;
            //     $model2->save();
            // }

            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'render_state_id'=>$render_state_id,
            ]);
        }
    }

    /**
     * Deletes an existing JobOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $render_state_id = $model->render_state_id;
        NotifyJoborder::deleteAll('job_order_id = :job_order_id', [':job_order_id' => $id]);
        JoborderLog::deleteAll('job_order_id = :job_order_id',[':job_order_id'=>$id]);
        //Output Query
        //DELETE FROM `tbl_user` WHERE status = 'active' AND age > 20
        $model->delete();

        return $this->redirect(['index','render_state_id'=>$render_state_id]);
    }

    public function actionCusts($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT id,company_name AS text FROM customer WHERE company_name LIKE "%'.$q.'%" ');

       // $query = "SELECT * FROM `post` where `title` LIKE 'foo%' ";
        $model = $sql->queryAll();
        $out['results'] = array_values($model);

        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Customer::find($id)->company_name];
        }
        return $out;
    }

    public function actionUpdatestatus($id,$render_state_id)
    {
        $model = $this->findModel($id);
        $model3 = NotifyJoborder::find()
                    ->where(['job_order_id'=>$id])
                    ->one();

        //if (empty($model2)) {
        $model2 = new NotifyJoborder();
        $model4 = new JoborderLog();

        if ($model->load(Yii::$app->request->post())  ) {
            if (isset($_POST['tukarstatus'])) {
                if ($_POST['tukarstatus'] == 'yes') {
                    $model->done_by = strtoupper($_POST['JobOrder']['done_by']);
                    $model->checked_by = strtoupper($_POST['JobOrder']['checked_by']);
                    $model->send_out_by = strtoupper($_POST['JobOrder']['send_out_by']);

                    if ($_POST['JobOrder']['status'] == 'Awaiting To Quote') {
                        if ($model->save()) {
                            $model2->text = $_POST['NotifyJoborder']['text'];
                            $model2->user_id = $_POST['NotifyJoborder']['user_id'];
                            $model2->date_receive = date('Y-m-d h:i:s');
                            $model2->job_order_id = $model->id;
                            $model2->read_notify = 'unread';
                            $model4->status = $model->status;
                            $model4->job_order_id = $model->id;
                            $model4->date_joborder = date('d/m/Y h:i:s A');
                            $model4->enter_by = Yii::$app->user->identity->id;
                            $model4->job_order_no = $model->job_order_no;
                            $model4->save();
                            $model2->save();
                        }
                        
                    }
                    elseif ($_POST['JobOrder']['status'] == 'Beyond Repair') {
                        if ($model->save()) {
                            $model2->text = $_POST['NotifyJoborder']['text'];
                            $model2->user_id = $_POST['NotifyJoborder']['user_id'];
                            $model2->date_receive = date('Y-m-d h:i:s');
                            $model2->job_order_id = $model->id;
                            $model2->read_notify = 'unread';
                            $model4->status = $model->status;
                            $model4->job_order_id = $model->id;
                            $model4->date_joborder = date('d/m/Y h:i:s A');
                            $model4->enter_by = Yii::$app->user->identity->id;
                            $model4->job_order_no = $model->job_order_no;
                            $model4->save();
                            $model2->save();
                        }
                    }
                    elseif ($_POST['JobOrder']['status'] == 'Send To Supplier') {
                        if ($model->save()) {
                            $model2->text = $_POST['NotifyJoborder']['text'];
                            $model2->user_id = $_POST['NotifyJoborder']['user_id'];
                            $model2->date_receive = date('Y-m-d h:i:s');
                            $model2->job_order_id = $model->id;
                            $model2->read_notify = 'unread';
                            $model4->status = $model->status;
                            $model4->job_order_id = $model->id;
                            $model4->date_joborder = date('d/m/Y h:i:s A');
                            $model4->enter_by = Yii::$app->user->identity->id;
                            $model4->job_order_no = $model->job_order_no;
                            $model4->save();
                            $model2->save();
                        }
                    }
                    elseif ($_POST['JobOrder']['status'] == 'Warranty Claim') {
                        if ($model->save()) {
                            $model2->text = $_POST['NotifyJoborder']['text'];
                            $model2->user_id = $_POST['NotifyJoborder']['user_id'];
                            $model2->date_receive = date('Y-m-d h:i:s');
                            $model2->job_order_id = $model->id;
                            $model2->read_notify = 'unread';
                            $model4->status = $model->status;
                            $model4->job_order_id = $model->id;
                            $model4->date_joborder = date('d/m/Y h:i:s A');
                            $model4->enter_by = Yii::$app->user->identity->id;
                            $model4->job_order_no = $model->job_order_no;
                            $model4->save();
                            $model2->save();
                        }
                    }
                    elseif ($_POST['JobOrder']['status'] == 'Arrange Delivery') {
                        if ($model->save()) {
                            $model2->text = $_POST['NotifyJoborder']['text'];
                            $model2->user_id = $_POST['NotifyJoborder']['user_id'];
                            $model2->date_receive = date('Y-m-d h:i:s');
                            $model2->job_order_id = $model->id;
                            $model2->read_notify = 'unread';
                            $model4->status = $model->status;
                            $model4->job_order_id = $model->id;
                            $model4->date_joborder = date('d/m/Y h:i:s A');
                            $model4->enter_by = Yii::$app->user->identity->id;
                            $model4->job_order_no = $model->job_order_no;
                            $model4->save();
                            $model2->save();
                        }
                    }
                    else{
                        if ($model->save()) {
                            $model4->status = $model->status;
                            $model4->job_order_id = $model->id;
                            $model4->date_joborder = date('d/m/Y h:i:s A');
                            $model4->enter_by = Yii::$app->user->identity->id;
                            $model4->job_order_no = $model->job_order_no;
                            $model4->save();
                        }
                    }

                }
                else{
                    $model->done_by = strtoupper($_POST['JobOrder']['done_by']);
                    $model->checked_by = strtoupper($_POST['JobOrder']['checked_by']);
                    $model->send_out_by = strtoupper($_POST['JobOrder']['send_out_by']);

                    $model->save();
                }
            }
            else{
                $model->done_by = strtoupper($_POST['JobOrder']['done_by']);
                $model->checked_by = strtoupper($_POST['JobOrder']['checked_by']);
                $model->send_out_by = strtoupper($_POST['JobOrder']['send_out_by']);

                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('updatestatus', [
                'model' => $model,
                'model2'=>$model2,
                'model4'=>$model4,
            ]);
        }
    }

    public function actionUpdatestatus_indoor($id,$render_state_id)
    {
        $model = $this->findModel($id);
        $model3 = NotifyJoborder::find()
                    ->where(['job_order_id'=>$id])
                    ->one();

        //if (empty($model2)) {
        $model2 = new NotifyJoborder();
        $model4 = new JoborderLog();
        $model6 = JoborderLog::find()
                ->where(['job_order_id'=>$id])
                ->limit(1)->one();

        if ($model->load(Yii::$app->request->post())  ) {
            if ($_POST['tukarstatus'] == 'yes') {
                if ($_POST['JobOrder']['status'] == 'Quoted') {
                    if ($model->save()) {
                        $model2->text = $_POST['NotifyJoborder']['text'];
                        $model2->user_id = $_POST['NotifyJoborder']['user_id'];
                        $model2->date_receive = date('Y-m-d h:i:s');
                        $model2->job_order_id = $model->id;
                        $model2->read_notify = 'unread';
                        $model4->status = $model->status;
                        $model4->job_order_id = $model->id;
                        $model4->date_joborder = date('d/m/Y h:i:s A');
                        $model4->enter_by = Yii::$app->user->identity->id;
                        $model4->job_order_no = $model->job_order_no;
                        $model4->save();
                        $model2->save();
                    }
                }
                elseif ($_POST['JobOrder']['status'] == 'Customer Confirm') {
                    if ($model->save()) {
                        $model2->text = $_POST['NotifyJoborder']['text'];
                        $model2->user_id = $_POST['NotifyJoborder']['user_id'];
                        $model2->date_receive = date('Y-m-d h:i:s');
                        $model2->job_order_id = $model->id;
                        $model2->read_notify = 'unread';
                        $model4->status = $model->status;
                        $model4->job_order_id = $model->id;
                        $model4->date_joborder = date('d/m/Y h:i:s A');
                        $model4->enter_by = Yii::$app->user->identity->id;
                        $model4->job_order_no = $model->job_order_no;
                        $model4->save();
                        $model2->save();
                    }
                }
                elseif ($_POST['JobOrder']['status'] == 'Customer Reject') {
                    if ($model->save()) {
                        $model2->text = $_POST['NotifyJoborder']['text'];
                        $model2->user_id = $_POST['NotifyJoborder']['user_id'];
                        $model2->date_receive = date('Y-m-d h:i:s');
                        $model2->job_order_id = $model->id;
                        $model2->read_notify = 'unread';
                        $model4->status = $model->status;
                        $model4->job_order_id = $model->id;
                        $model4->date_joborder = date('d/m/Y h:i:s A');
                        $model4->enter_by = Yii::$app->user->identity->id;
                        $model4->job_order_no = $model->job_order_no;
                        $model4->save();
                        $model2->save();
                    }
                }
                elseif ($_POST['JobOrder']['status'] == 'Awaiting Spare Part') {
                    if ($model->save()) {
                        $model2->text = $_POST['NotifyJoborder']['text'];
                        $model2->user_id = $_POST['NotifyJoborder']['user_id'];
                        $model2->date_receive = date('Y-m-d h:i:s');
                        $model2->job_order_id = $model->id;
                        $model2->read_notify = 'unread';
                        $model4->status = $model->status;
                        $model4->job_order_id = $model->id;
                        $model4->date_joborder = date('d/m/Y h:i:s A');
                        $model4->enter_by = Yii::$app->user->identity->id;
                        $model4->job_order_no = $model->job_order_no;
                        $model4->save();
                        $model2->save();
                    }
                }
                else{
                    if ($model->save()) {
                        $model4->status = $model->status;
                        $model4->job_order_id = $model->id;
                        $model4->date_joborder = date('d/m/Y h:i:s A');
                        $model4->enter_by = Yii::$app->user->identity->id;
                        $model4->job_order_no = $model->job_order_no;
                        $model4->save();
                    }
                }
            }
            else{

            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else{
            return $this->render('updatestatus_indoor', [
                'model' => $model,
                'model2'=>$model2,
                'model4'=>$model4,
                'model6'=>$model6,
            ]);
        }
    }

    public function actionNotify_joborder()
    {
        $user =  Yii::$app->user->identity->id;

        $connection = \Yii::$app->db;

        $sql = $connection->createCommand("SELECT n.text,n.job_order_id,n.id,n.date_receive,j.job_order_no,n.joborder_desc FROM notify_joborder n LEFT JOIN job_order j on j.id = n.job_order_id WHERE DATE_FORMAT(n.date_receive,'%Y-%m-%d') = CURDATE() AND n.user_id = '".$user."' ORDER BY n.date_receive DESC");
        $model = $sql->queryAll();

        $sql2 = $connection->createCommand("SELECT * FROM notify_joborder n LEFT JOIN job_order j on j.id = n.job_order_id WHERE n.user_id = '".$user."' ORDER BY n.date_receive DESC");
        $model2 = $sql2->queryAll();

        // $model2 = NotifyJoborder::find()
        //         ->where(['user_id'=>$user])
        //         ->all();

        $model3 = NotifyJoborder::find()
                ->where(['user_id'=>$user])
                ->count();
        return $this->render('notify_joborder',[
            'model'=>$model,
            'model2'=>$model2,
            'model3'=>$model3,
        ]);
    }

    public function actionSearching()
    {
        return $this->render('searching');
    }
    public function actionSearchjoborder()
    {
        $connection = \Yii::$app->db;

        $joborder = $_POST['searchJoborder'];

        if ($joborder != "") {
            $sql = $connection->createCommand("SELECT o.id,c.company_name,o.job_order_no,o.status FROM job_order o LEFT join user u on u.id = o.enter_by LEFT JOIN customer c on c.id = o.customer_id where o.job_order_no LIKE '%".$joborder."%' or o.date_joborder LIKE '%".$joborder."%' or c.company_name LIKE '%".$joborder."%'");
            $model = $sql->queryAll();

            foreach ($model as $key => $value) {
                echo "<ul>";
                echo "<li><a href='#'  id='".$value['id']."' class='infojoborder' >".$value['company_name']." - Job Order No : ".$value['job_order_no']." - Status : ".$value['status']."</a></li>";
                echo "</ul>";

            }
        } else {
            echo "No Data";
        }

        echo "<script type='text/javascript'>";
        echo "$('.infojoborder').on('click', function(){";
        echo "var v = $(this).attr('id');";
        echo "$.ajax({";
        echo "url: 'infojoborder',";
        echo "data: {id: v},";
        echo "success: function(data) {";
        echo "$('.qtyshow').show();";
        echo "$('.qtyshow').html(data);";
   
        echo "}";
        echo "});";
        echo "});";
        echo "</script>";
    }

    public function actionInfojoborder($id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT l.date_joborder,l.status,l.job_order_no,l.job_order_id,u.username,c.company_name FROM joborder_log l LEFT join user u on u.id = l.enter_by LEFT JOIN job_order o on o.id = l.job_order_id LEFT JOIN customer c on c.id = o.customer_id where o.id = '".$id."' ORDER BY l.id DESC");
            $model = $sql->queryAll();

        echo "<table class='table'>";
        echo "<tr>
                <th>#</th>
                <th>Date</th>
                <th>Status</th>
                <th>Job Order No</th>
                <th>Enter By</th>
            </tr>";
        foreach ($model as $key => $value) {
                $a = $key+1;
                echo "<tr>";
                    echo "<td>". $a ."</td>";
                    echo "<td>".$value['date_joborder']."</td>";
                    echo "<td>".$value['status']."</td>";
                    echo "<td>".$value['job_order_no']."</td>";
                    echo "<td>".$value['username']."</td>";
                    
                echo "</tr>";
        }
        echo "</table>";

    }
    public function actionHistoryjoborder($id)
    {
        // $model = JoborderLog::find()
        //         ->joinWith('historyenterby')
        //         ->where(['job_order_id'=>$id])
        //         ->one();
        $query = new Query;
        $query  ->select(['joborder_log.*', 'user.username','customer.company_name'])  
                ->from('joborder_log')
                ->leftJoin('user', 'user.id = joborder_log.enter_by')
                ->leftJoin('job_order','job_order.id = joborder_log.job_order_id')
                ->leftJoin('customer','customer.id = job_order.customer_id')
                ->where(['joborder_log.job_order_id'=>$id])
                ->orderBy(['id'=>SORT_DESC]);
        
        $command = $query->createCommand();
        $model = $command->queryAll(); 

        return $this->renderAjax('historyjoborder',[
            'model'=>$model,
        ]);
        //echo Json::encode($model);
    }
    /**
     * Finds the JobOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JobOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionCustname($id){


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
            echo "<span class='font-red-soft font-md'>Customer Name : No person in charge </span>"." - "."<a href='' class='' >Add Person In Charge</a>";
                    echo "<br>";
                    echo "<br>";
        }

    }

    public function actionCreatepic($id)
    {
        $model = new CustomerPic();

        if ($model->load(Yii::$app->request->post())) {
            $model->name =  strtoupper($_POST['CustomerPic']['name']);
            $model->department =  strtoupper($_POST['CustomerPic']['department']);
            $model->date_create = date('Y-m-d h:i:s');
            $model->enter_by= Yii::$app->user->identity->id;
            // $model->customer_id = $id;
            $model->save();
            Yii::$app->getSession()->setFlash('createPic', 'Data Person In Charge <b>'.$model->name.'</b> Successful Saved');
            return $this->redirect(['create', 'render_state_id' => $id]);
        
        } else {
            return $this->render('createpic', [
                'model' => $model,
            ]);
        }

    }

    public function actionCreatecompany($id)
    {
        $model = new Customer();
        $render_state_id = $id;
        if ($model->load(Yii::$app->request->post()) ) {

            //print_r($_POST);
            $model->company_name = strtoupper($_POST['Customer']['company_name']);
            $model->address = strtoupper($_POST['Customer']['address']);
            $model->city = strtoupper($_POST['Customer']['city']);
            $model->date_create = date('Y-m-d h:i:s');
            $model->render_state_id = $render_state_id;
            $model->enter_by= Yii::$app->user->identity->id;

            $model->save();
            return $this->redirect(['create', 'render_state_id' => $id]);
        } else {
            return $this->render('createcompany', [
                'render_state_id' => $render_state_id,
                'model' => $model,

            ]);
        }
    }

    public function actionPrint($id)
    {   
        // print(Yii::getAlias('@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css'));
        // exit();
        $model = JobOrder::find()
                ->where(['id'=>$id])
                ->one();
        // $model2 = CustomerPic::find()
        //         ->where(['id'=>$model->customer_name])
        //         ->one();
        // return $this->renderPartial('print',[
        //     'model'=>$model,
        // ]);

        $content = $this->renderPartial('print',[
            'model'=>$model,
            //'model2'=>$model2,
        ]);

        
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,
            // 'filename' => 'laporan_epf_'.date("F",strtotime($tarikhmasa)).'_'.date("Y",strtotime($tarikhmasa)).'.pdf',
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',
        // any css to be embedded if required
            'cssInline' => '.main{font-size:14px;font-family:Arial}.head{font-size:15px;font-family:Arial}',
            'options' => ['title' => 'Service Note'],
            // 'methods' => [
            //     'SetHeader'=>['Tarikh Cetakan '.date("d/m/Y")],
            //     'SetFooter'=>['{PAGENO}'],
            // ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionSearchs($id){
        $connection = \Yii::$app->db;

        $sql = $connection->createCommand('SELECT company_name,address FROM customer WHERE company_name LIKE "%'.$id.'%" AND render_state_id = 13');
        $model = $sql->queryAll();

        foreach ($model as $key => $value) {
            echo "<ul>";
            echo "<li><span class='font-blue-steel bold uppercase'>".$value['company_name']." - ".$value['address']."</span> -</li>";
            echo "</ul>";

        }
    }

    public function actionSearchp($id){
        $connection = \Yii::$app->db;

        $sql = $connection->createCommand('SELECT company_name,address FROM customer WHERE company_name LIKE "%'.$id.'%" AND render_state_id = 23');
        $model = $sql->queryAll();

        foreach ($model as $key => $value) {
            echo "<ul>";
            echo "<li><span class='font-blue-steel bold uppercase'>".$value['company_name']." - ".$value['address']."</span></li>";
            echo "</ul>";

        }
    }

    public function actionSearchj($id){
        $connection = \Yii::$app->db;

        $sql = $connection->createCommand('SELECT company_name,address FROM customer WHERE company_name LIKE "%'.$id.'%" AND render_state_id = 22');
        $model = $sql->queryAll();

        foreach ($model as $key => $value) {
            echo "<ul>";
            echo "<li><span class='font-blue-steel bold uppercase'>".$value['company_name']." - ".$value['address']."</span></li>";
            echo "</ul>";

        }
    }

}
