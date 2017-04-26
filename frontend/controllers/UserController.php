<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use frontend\models\ChatMessage;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('update', 'Your Info Has Been Update');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionReminder()
    {

        $user_id =  Yii::$app->user->identity->id;


        $connection = \Yii::$app->db;
        $sql2 = $connection->createCommand("SELECT COUNT(id) AS todayReminder FROM reminder WHERE reminder_to = '".$user_id."' AND status = 'Pending' AND DATE_FORMAT(datetime_reminder,'%Y-%m-%d') = CURDATE()");

        $count = $sql2->queryAll();

        foreach ($count as $key => $value) {
           $todayReminder = $value['todayReminder'];
        }


        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM reminder RIGHT JOIN reminder_log ON reminder.id = reminder_log.reminder_id 
        WHERE reminder.reminder_to = '".$user_id."' AND DATE_FORMAT(datetime_reminder,'%Y-%m-%d') = CURDATE() AND reminder.status = 'Pending'
         ");

        $today = $sql->queryAll();


        $connection = \Yii::$app->db;
        $sql3 = $connection->createCommand("SELECT * FROM reminder RIGHT JOIN reminder_log ON reminder.id = reminder_log.reminder_id 
WHERE 
((DATE_FORMAT(datetime_reminder,'%Y-%m-%d') = CURDATE() AND reminder.status = 'Complete')
OR 
(DATE_FORMAT(datetime_reminder,'%Y-%m-%d') < CURDATE() AND reminder.status = 'Complete')
OR
(DATE_FORMAT(datetime_reminder,'%Y-%m-%d') < CURDATE() AND reminder.status = 'Pending'))
AND
reminder.reminder_to = '".$user_id."' order by reminder.id DESC
");

        $all = $sql3->queryAll();

        $connection = \Yii::$app->db;
        $sql4 = $connection->createCommand("SELECT COUNT(reminder.id) AS allReminder FROM reminder RIGHT JOIN reminder_log ON reminder.id = reminder_log.reminder_id 
WHERE  
((DATE_FORMAT(datetime_reminder,'%Y-%m-%d') = CURDATE() AND reminder.status = 'Complete')
OR 
(DATE_FORMAT(datetime_reminder,'%Y-%m-%d') < CURDATE() AND reminder.status = 'Complete')
OR
(DATE_FORMAT(datetime_reminder,'%Y-%m-%d') < CURDATE() AND reminder.status = 'Pending'))
AND
reminder.reminder_to = '".$user_id."'  

");

        $count2 = $sql4->queryAll();

        foreach ($count2 as $key => $value) {
           $allReminder = $value['allReminder'];
        }



        return $this->render('reminder',[
            'today' => $today,
            'todayReminder' => $todayReminder,
            'all' => $all,
            'allReminder' => $allReminder,
        ]);
    }



    public function actionComplete($id)
    {
        $connection = \Yii::$app->db;
        $update = $connection->createCommand("UPDATE reminder SET status = 'Complete' WHERE id = '".$id."'")->execute();


        $user_id =  Yii::$app->user->identity->id;


        $connection = \Yii::$app->db;
        $sql2 = $connection->createCommand("SELECT COUNT(id) AS todayReminder FROM reminder WHERE reminder_to = '".$user_id."' AND status = 'Pending' AND DATE_FORMAT(datetime_reminder,'%Y-%m-%d') = CURDATE()");

        $count = $sql2->queryAll();

        foreach ($count as $key => $value) {
           $todayReminder = $value['todayReminder'];
        }


        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM reminder RIGHT JOIN reminder_log ON reminder.id = reminder_log.reminder_id 
        WHERE reminder.reminder_to = '".$user_id."' AND DATE_FORMAT(datetime_reminder,'%Y-%m-%d') = CURDATE() AND reminder.status = 'Pending'
         ");

        $today = $sql->queryAll();


        $connection = \Yii::$app->db;
        $sql3 = $connection->createCommand("SELECT * FROM reminder RIGHT JOIN reminder_log ON reminder.id = reminder_log.reminder_id 
WHERE 
((DATE_FORMAT(datetime_reminder,'%Y-%m-%d') = CURDATE() AND reminder.status = 'Complete')
OR 
(DATE_FORMAT(datetime_reminder,'%Y-%m-%d') < CURDATE() AND reminder.status = 'Complete')
OR
(DATE_FORMAT(datetime_reminder,'%Y-%m-%d') < CURDATE() AND reminder.status = 'Pending'))
AND
reminder.reminder_to = '".$user_id."'  
");

        $all = $sql3->queryAll();

        $connection = \Yii::$app->db;
        $sql4 = $connection->createCommand("SELECT COUNT(reminder.id) AS allReminder FROM reminder RIGHT JOIN reminder_log ON reminder.id = reminder_log.reminder_id 
WHERE 
((DATE_FORMAT(datetime_reminder,'%Y-%m-%d') = CURDATE() AND reminder.status = 'Complete')
OR 
(DATE_FORMAT(datetime_reminder,'%Y-%m-%d') < CURDATE() AND reminder.status = 'Complete')
OR
(DATE_FORMAT(datetime_reminder,'%Y-%m-%d') < CURDATE() AND reminder.status = 'Pending'))
AND
reminder.reminder_to = '".$user_id."'   

");

        $count2 = $sql4->queryAll();

        foreach ($count2 as $key => $value) {
           $allReminder = $value['allReminder'];
        }


        $connection = \Yii::$app->db;
        $update = $connection->createCommand("UPDATE reminder SET notification = 'Read' WHERE id = '".$id."'")->execute();


        return $this->redirect(['reminder', 
            'today' => $today,
            'todayReminder' => $todayReminder,
            'all' => $all,
            'allReminder' => $allReminder,
        ]);


    }


    public function actionInbox()
    {
        $user_id =  Yii::$app->user->identity->id;
        $connection = \Yii::$app->db;
        $sql2 = $connection->createCommand("SELECT COUNT(id) AS todayMessage FROM message WHERE message_to = '".$user_id."' AND status = 'Pending' AND DATE_FORMAT(date_create,'%Y-%m-%d') = CURDATE()");

        $count = $sql2->queryAll();

        foreach ($count as $key => $value) {
           $todayMessage = $value['todayMessage'];
        }

        $sql = $connection->createCommand("SELECT * FROM message RIGHT JOIN message_log ON message.id = message_log.message_id 
        WHERE message.message_to = '".$user_id."' AND DATE_FORMAT(message.date_create,'%Y-%m-%d') = CURDATE() AND message.status = 'Pending'
         ");

        $today = $sql->queryAll();

        $sql3 = $connection->createCommand("SELECT * FROM message RIGHT JOIN message_log ON message.id = message_log.message_id 
WHERE 
((DATE_FORMAT(message.date_create,'%Y-%m-%d') = CURDATE() AND message.status = 'Complete')
OR 
(DATE_FORMAT(message.date_create,'%Y-%m-%d') < CURDATE() AND message.status = 'Complete')
OR
(DATE_FORMAT(message.date_create,'%Y-%m-%d') < CURDATE() AND message.status = 'Pending') )
AND
message.message_to = '".$user_id."' order by message.id DESC
");

        $all = $sql3->queryAll();


        $sql4 = $connection->createCommand("SELECT COUNT(message.id) AS allMessage FROM message RIGHT JOIN message_log ON message.id = message_log.message_id 
WHERE
((DATE_FORMAT(message.date_create,'%Y-%m-%d') = CURDATE() AND message.status = 'Complete')
OR 
(DATE_FORMAT(message.date_create,'%Y-%m-%d') < CURDATE() AND message.status = 'Complete')
OR
(DATE_FORMAT(message.date_create,'%Y-%m-%d') < CURDATE() AND message.status = 'Pending') )
AND message.message_to = '".$user_id."'");

        $count2 = $sql4->queryAll();

        foreach ($count2 as $key => $value) {
           $allMessage = $value['allMessage'];
        }

        return $this->render('inbox',[
            'todayMessage' => $todayMessage,
            'today' => $today,
            'all' => $all,
            'allMessage' => $allMessage,
        ]);
    }


    public function actionSolve($id)
    {

        $connection = \Yii::$app->db;
        $update = $connection->createCommand("UPDATE message SET status = 'Complete' WHERE id = '".$id."'")->execute();


        $user_id =  Yii::$app->user->identity->id;
        $connection = \Yii::$app->db;
        $sql2 = $connection->createCommand("SELECT COUNT(id) AS todayMessage FROM message WHERE message_to = '".$user_id."' AND status = 'Pending' AND DATE_FORMAT(date_create,'%Y-%m-%d') = CURDATE()");

        $count = $sql2->queryAll();

        foreach ($count as $key => $value) {
           $todayMessage = $value['todayMessage'];
        }

        $sql = $connection->createCommand("SELECT * FROM message RIGHT JOIN message_log ON message.id = message_log.message_id 
        WHERE message.message_to = '".$user_id."' AND DATE_FORMAT(message.date_create,'%Y-%m-%d') = CURDATE() AND message.status = 'Pending'
         ");

        $today = $sql->queryAll();

        $sql3 = $connection->createCommand("SELECT * FROM message RIGHT JOIN message_log ON message.id = message_log.message_id 
WHERE 
((DATE_FORMAT(message.date_create,'%Y-%m-%d') = CURDATE() AND message.status = 'Complete')
OR 
(DATE_FORMAT(message.date_create,'%Y-%m-%d') < CURDATE() AND message.status = 'Complete')
OR
(DATE_FORMAT(message.date_create,'%Y-%m-%d') < CURDATE() AND message.status = 'Pending'))
AND message.message_to = '".$user_id."'  
");

        $all = $sql3->queryAll();


        $sql4 = $connection->createCommand("SELECT COUNT(message.id) AS allMessage FROM message RIGHT JOIN message_log ON message.id = message_log.message_id 
WHERE 
((DATE_FORMAT(message.date_create,'%Y-%m-%d') = CURDATE() AND message.status = 'Complete')
OR 
(DATE_FORMAT(message.date_create,'%Y-%m-%d') < CURDATE() AND message.status = 'Complete')
OR
(DATE_FORMAT(message.date_create,'%Y-%m-%d') < CURDATE() AND message.status = 'Pending'))
AND message.message_to = '".$user_id."' 
");

        $count2 = $sql4->queryAll();

        foreach ($count2 as $key => $value) {
           $allMessage = $value['allMessage'];
        }

        $connection = \Yii::$app->db;
        $update = $connection->createCommand("UPDATE message SET notification = 'Read' WHERE id = '".$id."'")->execute();
        return $this->redirect(['inbox', 
            'todayMessage' => $todayMessage,
            'today' => $today,
            'all' => $all,
            'allMessage' => $allMessage,
        ]);



    }





    public function actionList()
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM user WHERE module_id =1 AND id != 28 ");
        $malaysia = $sql->queryAll();

        $sql2 = $connection->createCommand("SELECT * FROM user WHERE module_id =3 AND id != 28 ");
        $thailand = $sql2->queryAll();

        $sql3 = $connection->createCommand("SELECT * FROM user WHERE module_id =8 AND id != 28 ");
        $bangladesh = $sql3->queryAll();

        return $this->render('list', [
            'malaysia' => $malaysia,
            'thailand' => $thailand,
            'bangladesh' => $bangladesh,
        ]);
    }




    public function actionChatbox($id)
    {
        $user_id =  Yii::$app->user->identity->id;

        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM user WHERE module_id =1 AND id != 28 AND id != '".$user_id."'");
        $malaysia = $sql->queryAll();

        $sql2 = $connection->createCommand("SELECT * FROM user WHERE module_id =3 AND id != 28 AND id != '".$user_id."' ");
        $thailand = $sql2->queryAll();

        $sql5 = $connection->createCommand("SELECT * FROM user WHERE module_id =8 AND id != 28 AND id != '".$user_id."' ");
        $bangladesh = $sql5->queryAll();

        $sql3 = $connection->createCommand("SELECT * FROM user WHERE id = '".$id."' ");
        $user = $sql3->queryAll();

        foreach ($user as $key => $value) {
            $username = $value['username'];
        }

        $user_id =  Yii::$app->user->identity->id;
        $sql4 = $connection->createCommand("SELECT *,chat_message.created_at AS chattime FROM chat_message RIGHT JOIN user ON chat_message.message_from =  user.id WHERE ( chat_message.message_from= '".$id."' OR chat_message.message_to = '".$id."' ) AND ( chat_message.message_from = '".$user_id."' OR chat_message.message_to = '".$user_id."' )  ");
        $data = $sql4->queryAll();

        return $this->render('chatbox', [
            'malaysia' => $malaysia,
            'thailand' => $thailand,
            'bangladesh'=>$bangladesh,
            'username' => $username,
            'data' => $data,
            'id' => $id,

        ]);

    }

    // to send new chat
    public function actionSend()
    {
        $model = new ChatMessage();

        $user_id =  Yii::$app->user->identity->id;

        $model->message_from = $user_id;
        $model->message_to = $_POST['receiver'];
        $model->message =  $_POST['chat'];
        $model->status = "Unread";
        $model->created_at =  date('Y-m-d H:i:s');
        $model->save();



  
    }


    // to return how many chat no read


    



}
