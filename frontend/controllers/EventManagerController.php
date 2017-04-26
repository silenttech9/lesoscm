<?php

namespace frontend\controllers;

use Yii;
use frontend\models\EventManager;
use frontend\models\EventManagerSearch;
use frontend\models\EventSession;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\EventInvitation;
use frontend\models\EventInvitationSearch;
use frontend\models\EventRegParticipant;
use frontend\models\EventRegParticipantSearch;
use frontend\models\EventReg;
use frontend\models\EventSurveyQuestion;
use frontend\models\EventSurveyQuestionSearch;
use frontend\models\EventSurveyAnswer;
use frontend\models\EventSurveyAnswerSearch;
use frontend\models\UploadFileinvite;
use yii\web\UploadedFile;
use yii\db\Query;

/**
 * EventManagerController implements the CRUD actions for EventManager model.
 */
class EventManagerController extends Controller
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
     * Lists all EventManager models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventManagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EventManager model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model2 = EventSession::find()
                ->where(['event_id'=>$id])
                ->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'model2'=>$model2,
        ]);
    }

    /**
     * Creates a new EventManager model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EventManager();
        $model2 = new EventSession();
        $connection = Yii::$app->db; 

        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post()) ) {
            $countsesi = count($_POST['EventSession']['activity']);
            $model->created_at = date('d/m/Y h:i:s');
            $model->enter_by = Yii::$app->user->identity->id;
            $model->status_event = 'Available';
            $model->file = UploadedFile::getInstance($model,'file');

            if (!empty($model->file)) {
                $model->file->saveAs('uploads/event/'.$model->file->baseName.'.'.$model->file->extension);

                $model->img_brochure = $model->file->baseName.'.'.$model->file->extension;
                
            }
            // else{
                
            //     $model->foto = 'default-image.png';
            //     // Image::thumbnail('@webroot/uploads/'.$model->foto, 300, 300)
            //     //         ->save(Yii::getAlias('@webroot/uploads/'.$model->foto), ['quality' => 90]);

            // }

            if ($model->save()) {
                $last_id = Yii::$app->db->getLastInsertID();
                for ($i=0; $i < $countsesi ; $i++) {

                    // /$model2 = new EventSession();
                    $a = $_POST['EventSession']['time'][$i];
                    $b = $_POST['EventSession']['activity'][$i];
                    $c = date('d/m/Y h:i:s');
                    $d = Yii::$app->user->identity->id;
                    $e = $last_id;

                    $connection->createCommand()->batchInsert('event_session', ['time', 'activity','created_at','enter_by','event_id'], [
                            [$a, $b,$c,$d,$e],
                        ])->execute();                
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model2'=>$model2,
            ]);
        }
    }

    public function actionListevent()
    {
        $searchModel = new EventManagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('listevent', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //for list attendant split by event

    public function actionListevent_()
    {
        $searchModel = new EventManagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('listevent', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAttendance_($id){
        return $this->redirect(['attendance','id'=>$id]);
    }

    public function actionUpload_invite($id)
    {   
        // print(Yii::getAlias('@webroot/uploads/event'));
        //     exit();
        // $model = UploadFileinvite::find()
        //         ->where(['event_id'=>7])
        //         ->one();

        $model = new UploadFileinvite();
        if ($model->load(Yii::$app->request->post())  ) {
            $model->file = UploadedFile::getInstance($model,'file');
            
            // print(Yii::getAlias('@webroot/uploads/event/'.$model->file));

            if (!empty($model->file)) {
                $filename = Yii::getAlias('@webroot/uploads/event/'.$model->file);
                
                if (file_exists($filename)) {
                    $fileinvite = UploadFileinvite::find()
                            ->where(['event_id'=>$id])
                            ->limit(1)->one();
                    if (isset($fileinvite)) {
                        unlink(Yii::getAlias('@webroot/uploads/event/'.$fileinvite->path));
                        $fileinvite->delete();
                    }
                    
                } else {
                    // $model->file->saveAs('uploads/event/'.$model->file->baseName.'.'.$model->file->extension);
                    // $model->path = $model->file->baseName.'.'.$model->file->extension;
                    // $model->save();
                }
                $model->file->saveAs('uploads/event/'.$model->file->baseName.'.'.$model->file->extension);
                $model->path = $model->file->baseName.'.'.$model->file->extension;
                $model->event_id = $id;
                if($model->save()){
                    $inputFile = Yii::getAlias('@webroot/uploads/event/'.$model->path);
                    $model2 = EventInvitation::find()
                            ->where(['event_id'=>$id])
                            ->all();
                    if (isset($model2)) {
                        EventInvitation::deleteAll('event_id = :event_id',[':event_id'=>$id]);
                    }
                    try {
                        $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
                        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFile);


                    } catch (Exception $e)
                    {
                        die('Error');
                    }

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highesColumn = $sheet->getHighestColumn();

                    for ($row=1; $row <= $highestRow ; $row++) { 
                        $rowData = $sheet->rangeToArray('A'.$row.':'.$highesColumn.$row,NULL,TRUE,FALSE);

                        if ($row == 1) {
                            continue;
                        } else {

                     
                            $excel = new EventInvitation();
                            $excel->name = $rowData[0][0];
                            $excel->company_name = $rowData[0][1];
                            $excel->address_1 = $rowData[0][2];
                            $excel->address_2 = $rowData[0][3];
                            $excel->address_3 = $rowData[0][4];
                            $excel->state = $rowData[0][5];
                            $excel->email = $rowData[0][6];
                            $excel->event_id = $id;
                            $excel->created_at = date('Y-m-d h:i:s A');
                            $excel->enter_by = Yii::$app->user->identity->id;
                            $excel->status_email = 'Not Yet';
                            $excel->save();

                        }

                    } 

                }
            }
            Yii::$app->getSession()->setFlash('uploadsuccess', '<strong>Success! </strong>Upload file invitation is successful');
            return $this->redirect(['view', 'id' => $id]);

        }
        else{
            return $this->renderAjax('upload_invite',[
                'model'=>$model,
            ]);
        }
    }

    public function actionTarget_participant()
    {
        $searchModel = new EventManagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('target_participant', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListtarget_participant($id)
    {
        $searchModel1= new EventInvitationSearch();
        $dataProvider = $searchModel1->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['event_id'=>$id]);

        return $this->render('listtarget_participant', [
            'searchModel1' => $searchModel1,
            'dataProvider' => $dataProvider,
            'id'=>$id,
        ]);
    }

    public function actionSend_email($id)
    {   
        $model = EventManager::find()
                ->where(['id'=>$id])
                ->one();
        $query = new Query;
        $query->select('email')
            ->from('event_invitation')
            ->where('event_id ='.$id);
        $command = $query->createCommand();
        $enderecos = $command->queryAll(\PDO::FETCH_COLUMN);

        Yii::$app->mailer->compose('layouts/home-link',['model'=>$model])
            ->setFrom('lesoscm.event@gmail.com')
            ->setBcc($enderecos)
            ->setSubject('Exclusive Invitation to '.$model->title)
            ->send();

        $model2 = EventInvitation::find()
                ->where(['event_id'=>$id])
                ->all();
        foreach ($model2 as $key => $value) {
            $model3 = EventInvitation::find()
                    ->where(['id'=>$value['id']])
                    ->one();
            $model3->status_email = "Sent";
            $model3->save();

        }
        return $this->redirect(['listtarget_participant', 'id' => $id]);
    }

    public function actionRegistered_participant()
    {
        $searchModel = new EventManagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('registered_participant', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRegistered_($id){
        return $this->redirect(['registered','id'=>$id]);
    }
    public function actionRegistered()
    {
        $searchModel = new EventRegParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status'=>'Registered']);
        $dataProvider->query->andWhere(['event_reg_participant.event_id'=>Yii::$app->request->get('id')]);


        //status confirm
        $searchModel_confirm = new EventRegParticipantSearch();
        $dataProvider_confirm = $searchModel_confirm->search(Yii::$app->request->queryParams);
        $dataProvider_confirm->query->andWhere(['status'=>'Confirm']);
        $dataProvider_confirm->query->andWhere(['event_reg_participant.event_id'=>Yii::$app->request->get('id')]);

         $dataProvider_confirm->pagination->pageSize=50;

        return $this->render('registered', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel_confirm' => $searchModel_confirm,
            'dataProvider_confirm' => $dataProvider_confirm,
            'id'=>Yii::$app->request->get('id'),
        ]);
    }

    public function actionDelete_participant($id)
    {
        $model = EventRegParticipant::find()
                ->where(['id'=>$id])
                ->one();
        $model->delete();

        return $this->redirect(['registered','id'=>$model->event_id]);
    }

    public function actionApprove($id)
    {
        $model = EventRegParticipant::find()
                ->where(['id'=>$id])
                ->one();
        $model2 = EventReg::find()
                ->where(['id'=>$model->eventreg_id])
                ->one();
        $model3 = $this->findModel($model->event_id);

        $model->status = 'Confirm';
        if ($model->email == '') {
            Yii::$app->getSession()->setFlash('emailinvalid', '<strong>Alert! </strong>Email Invalid');
            return $this->redirect(['registered','id'=>$model->event_id]);
        }
        else{
            $message = Yii::$app->mailer->compose('layouts/approve-email',[
                'model'=>$model,
                'model2'=>$model2,
                'model3'=>$model3,
            ]);
            $message->setFrom('lesoscm.event@gmail.com')
                    ->setTo($model->email)
                    ->setSubject('Confirmation for Lesoshoppe Event')
                    ->send();
            $model->save();
            return $this->redirect(['registered','id'=>$model->event_id]);
        }
            

        
    }

    public function actionRemind($id)
    {
        $model = EventRegParticipant::find()
                ->where(['id'=>$id])
                ->one();
        $model2 = $this->findModel($model->event_id);
        if ($model->reminder == '') {
            $model->reminder = 'first';
            $model->save();
        }
        elseif($model->reminder == 'first'){
            $model->reminder = 'second';
            $model->save();
        }

        
        return $this->redirect(['remind_email','id'=>$id]);
    }
    public function actionRemind_email($id)
    {
        $model = EventRegParticipant::find()
                ->where(['id'=>$id])
                ->one();
        $model2 = $this->findModel($model->event_id);

        Yii::$app->mailer->compose('layouts/remind',[
                'model'=>$model,
                'model2'=>$model2,
            ])
            ->setFrom('lesoscm.event@gmail.com')
            ->setBcc($model->email)
            ->setSubject('Leso Event - Reminder for '.$model2->title)
            ->send();

        return $this->redirect(['registered','id'=>$model->event_id]);

    }
    /**
     * Updates an existing EventManager model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model2 = EventSession::find()
                ->where(['event_id'=>$id])
                ->all();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->file = UploadedFile::getInstance($model,'file');
            if (!empty($model->file)) {
                unlink(Yii::getAlias('@webroot/uploads/event/'.$model->img_brochure));
                $model->file->saveAs('uploads/event/'.$model->file->baseName.'.'.$model->file->extension);
                $model->img_brochure = $model->file->baseName.'.'.$model->file->extension;  
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'model2'=>$model2,
            ]);
        }
    }

    public function actionChangestatus($id)
    {
        $model = $this->findModel($id);
        $model->status_event = 'Closed';
        $model->save();
        return $this->redirect('index');
    }

    public function actionAttendance($id)
    {
        $searchModel = new EventRegParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status'=>'Confirm']);
        $dataProvider->query->andWhere(['event_reg_participant.event_id'=>$id]);

        $dataProvider->pagination->pageSize=50;

        return $this->render('attendance',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id'=>$id,
        ]);        
    }

    public function actionAttendee($id)
    {
        $searchModel_confirm = new EventRegParticipantSearch();
        $dataProvider_confirm = $searchModel_confirm->search(Yii::$app->request->queryParams);
        
        $dataProvider_confirm->query->andWhere(['status'=>'Attended']);
        $dataProvider_confirm->query->andWhere(['event_reg_participant.event_id'=>$id]);

        $dataProvider_confirm->pagination->pageSize=50;

        return $this->render('attendee',[
            'searchModel_confirm' =>$searchModel_confirm,
            'dataProvider_confirm'=>$dataProvider_confirm,
            'id'=>$id,
        ]);
    }

    //change status participants
    public function actionChangeattend($id)
    {
        $model = EventRegParticipant::find()
                ->where(['id'=>$id])
                ->one();
        $model2 = EventManager::find()
                ->where(['id'=>$model->event_id])
                ->one();

        $model->status = 'Attended';
       
        if ($model->save()) {
            Yii::$app->mailer->compose('layouts/thankyou',[
                'model'=>$model,
                'model2'=>$model2,
            ])
            ->setFrom('lesoscm.event@gmail.com')
            ->setBcc($model->email)
            // ->setTo('shahril.anuar204@gmail.com')
            ->setSubject('Leso Event - Thanks For Attending')

            ->send();
        }
        return $this->redirect(['attendance','id'=>$model->event_id]);
    }

    public function actionTestviewemail()
    {
        return $this->render('testviewemail');
    }

    public function actionAddparticipant()
    {
        $model = new EventReg();
        $model2 = new EventRegParticipant();

        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post() )) {
            $model->created_at = date('Y-m-d h:i:s A');
            $model->company_name = strtoupper($_POST['EventReg']['company_name']);

            if ($model->save()) {
                $last_id = Yii::$app->db->getLastInsertID();

                $model2->name_participant = strtoupper($_POST['EventRegParticipant']['name_participant']);
                $model2->email = $_POST['EventRegParticipant']['email'];
                $model2->designation = strtoupper($_POST['EventRegParticipant']['designation']);
                $model2->mobile_phone = $_POST['EventRegParticipant']['mobile_phone'];
                $model2->event_id = $model->event_id;
                $model2->created_at = date('Y-m-d h:i:s A');
                $model2->eventreg_id = $last_id;
                $model2->status = 'Confirm';
                $model2->reminder = 'second'; //terus set reminder to second because register semasa event.
                $model2->save();
            }
            Yii::$app->getSession()->setFlash('addparticipant', '<strong>Success! </strong>Registration participant is successful');
            return $this->redirect(['attendance','id'=>$_POST['EventReg']['event_id']]);
        } else {
            return $this->render('addparticipant', [
                'model'=>$model,
                'model2'=>$model2,
            ]);
        }
    }

    public function actionSurvey_event()
    {
        $searchModel = new EventManagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('survey_event', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAnswer_($id)
    {
        return $this->redirect(['answer','id'=>$id]);
    }
    public function actionAnswer($id)
    {   
        $searchModel = new EventRegParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['survey'=>'Yes']);
        $dataProvider->query->andWhere(['event_reg_participant.event_id'=>$id]);
        $dataProvider->pagination->pageSize=50;

        return $this->render('answer',[
            'searchModel' =>$searchModel,
            'dataProvider'=>$dataProvider,
            'id'=>$id,
        ]);
    }

    public function actionAnswer_survey($id,$eventid)
    {
        $model = EventSurveyAnswer::find()
                ->where(['id_attendee'=>$id])
                ->andWhere(['event_id'=>$eventid])
                ->all();

        $model2 = EventRegParticipant::find()
                ->where(['id'=>$id])
                ->one();

        return $this->renderAjax('answer_survey',[
            'model'=>$model,
            'model2'=>$model2,
        ]);
    }

    /**
     * Deletes an existing EventManager model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        EventSession::deleteAll('event_id = :event_id',[':event_id'=>$id]);
        EventRegParticipant::deleteAll('event_id = :event_id',[':event_id'=>$id]);
        EventInvitation::deleteAll('event_id = :event_id',[':event_id'=>$id]);
        EventReg::deleteAll('event_id = :event_id',[':event_id'=>$id]);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EventManager model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EventManager the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventManager::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMaintenance()
    {
        return $this->render('maintenance');
    }
}
