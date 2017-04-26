<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','signup'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout','analysis' ,'index','request-password-reset','reset-password','contact','captcha','dashboard','quotation','item','qty','total','return'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

  public function actionTotal()
    {
  
        $user_id =  Yii::$app->user->identity->id;

        $connection = \Yii::$app->db;

        $sql = $connection->createCommand("SELECT COUNT(id) AS totalChat FROM chat_message WHERE message_to = '".$user_id."' AND status = 'Unread'");
        $data = $sql->queryAll();

        foreach ($data as $key => $value) {
            echo $value['totalChat'];
        }
    } 




    public function actionQuotation($module_id)
    {
        return $this->render('quotation',[
            'module_id' => $module_id,
        ]);
    }


    public function actionItem(){

        $id = $_POST['id'];
        $mdl = $_POST['module'];
        $connection = \Yii::$app->db;

        if ($id != "") {
            $sql = $connection->createCommand('SELECT id,ITEM_NO,DESCRIPTION FROM stock WHERE ITEM_NO LIKE "%'.$id.'%" OR DESCRIPTION LIKE "%'.$id.'%"');
            $model = $sql->queryAll();

            foreach ($model as $key => $value) {
                echo "<ul>";
                echo "<li><a href='#'  id='".$value['id']."' class='iteminfo' id=>".$value['ITEM_NO']." - ".$value['DESCRIPTION']."</a></li>";
                echo "<input type='hidden' id='itmmdl' value='".$mdl."' />";
                echo "</ul>";

            }
        } else {
            echo "No Data";
        }

        echo "<script type='text/javascript'>";
        echo "$('.iteminfo').on('click', function(){";
        echo "var v = $(this).attr('id');";
        echo "var m = $('#itmmdl').val();";
        echo "$.ajax({";
        echo "url: 'qty',";
        echo "data: {id: v,mdl: m},";
        echo "success: function(data) {";
        echo "$('.qtyshow').show();";
        echo "$('.qtyshow').html(data);";
   
        echo "}";
        echo "});";
        echo "});";
        echo "</script>";

    }


    public function actionQty($id,$mdl){

        if ($mdl == 1) {

            $getState = Yii::$app->user->identity->state_id;
            $connection = \Yii::$app->db;

            if ($getState == 13) {
            
            
            	if(Yii::$app->user->identity->id == 12) { 
            	
            	                $sql = $connection->createCommand('SELECT quotation.id AS ids,quotation.state_id,quotation.quotation_no,user.username,customer.company_name,quotation.datetime FROM quotation_details 
                    LEFT JOIN quotation ON quotation_details.quotation_id = quotation.id
                    LEFT JOIN user ON quotation.enter_by = user.id
                    LEFT JOIN customer ON customer.id = quotation.customer_id
                    WHERE quotation_details.stock_id = "'.$id.'" AND quotation.state_id IN (13,20,23,22,21,100)');
                $model = $sql->queryAll();

                echo "<table class='table'>";
                echo "<tr><th>Quotation No</th><th>Quoted By</th></tr>";
                foreach ($model as $key => $value) {
                        echo "<tr>";
                        //echo "<td>".$value['quotation_no']."</td>";
                        echo "<td>".Html::a($value['quotation_no'],['/malaysia/quotation/quotation','id'=>$value['ids'],'state_id'=>$value['state_id']],['target' => '_blank'])."</td>";
                        echo "<td>".$value['datetime']."</td>";
                        echo "<td>".$value['company_name']."</td>";
                        echo "<td>".$value['username']."</td>";
                        echo "</tr>";
                }
                echo "</table>";
            	
            	
            	
            	} else {
            
            
            
            

                $sql = $connection->createCommand('SELECT quotation.id AS ids,quotation.state_id,quotation.quotation_no,user.username,customer.company_name,quotation.datetime FROM quotation_details 
                    LEFT JOIN quotation ON quotation_details.quotation_id = quotation.id
                    LEFT JOIN user ON quotation.enter_by = user.id
                    LEFT JOIN customer ON customer.id = quotation.customer_id
                    WHERE quotation_details.stock_id = "'.$id.'" AND quotation.state_id IN (13,20,21,100)');
                $model = $sql->queryAll();

                echo "<table class='table'>";
                echo "<tr><th>Quotation No</th><th>Quoted By</th></tr>";
                foreach ($model as $key => $value) {
                        echo "<tr>";
                        //echo "<td>".$value['quotation_no']."</td>";
                        echo "<td>".Html::a($value['quotation_no'],['/malaysia/quotation/quotation','id'=>$value['ids'],'state_id'=>$value['state_id']],['target' => '_blank'])."</td>";
                        echo "<td>".$value['datetime']."</td>";
                        echo "<td>".$value['company_name']."</td>";
                        echo "<td>".$value['username']."</td>";
                        echo "</tr>";
                }
                echo "</table>";
                
               }


                
            } elseif ($getState == 22) {

                $sql = $connection->createCommand('SELECT quotation.id AS ids,quotation.state_id,quotation.quotation_no,user.username,customer.company_name,quotation.datetime FROM quotation_details 
                    LEFT JOIN quotation ON quotation_details.quotation_id = quotation.id
                    LEFT JOIN user ON quotation.enter_by = user.id
                    LEFT JOIN customer ON customer.id = quotation.customer_id
                    WHERE quotation_details.stock_id = "'.$id.'" AND quotation.state_id = 22 ');
                $model = $sql->queryAll();

                echo "<table class='table'>";
                echo "<tr><th>Quotation No</th><th>Quoted By</th></tr>";
                foreach ($model as $key => $value) {
                        echo "<tr>";
                        //echo "<td>".$value['quotation_no']."</td>";
                        echo "<td>".Html::a($value['quotation_no'],['/malaysia/quotation/quotation','id'=>$value['ids'],'state_id'=>$value['state_id']],['target' => '_blank'])."</td>";
                        echo "<td>".$value['datetime']."</td>";
                        echo "<td>".$value['company_name']."</td>";
                        echo "<td>".$value['username']."</td>";
                        echo "</tr>";
                }
                echo "</table>";

            } elseif ($getState == 23) {
                
                $sql = $connection->createCommand('SELECT quotation.id AS ids,quotation.state_id,quotation.quotation_no,user.username,customer.company_name,quotation.datetime FROM quotation_details 
                    LEFT JOIN quotation ON quotation_details.quotation_id = quotation.id
                    LEFT JOIN user ON quotation.enter_by = user.id
                    LEFT JOIN customer ON customer.id = quotation.customer_id
                    WHERE quotation_details.stock_id = "'.$id.'" AND quotation.state_id = 23 ');
                $model = $sql->queryAll();

                echo "<table class='table'>";
                echo "<tr><th>Quotation No</th><th>Quoted By</th></tr>";
                foreach ($model as $key => $value) {
                        echo "<tr>";
                        //echo "<td>".$value['quotation_no']."</td>";
                        echo "<td>".Html::a($value['quotation_no'],['/malaysia/quotation/quotation','id'=>$value['ids'],'state_id'=>$value['state_id']],['target' => '_blank'])."</td>";
                        echo "<td>".$value['datetime']."</td>";
                        echo "<td>".$value['company_name']."</td>";
                        echo "<td>".$value['username']."</td>";
                        echo "</tr>";
                }
                echo "</table>";
            }

            


        } elseif ($mdl == 3) {

            $connection = \Yii::$app->db;
            $sql = $connection->createCommand('SELECT quotation_thailand.id AS ids,quotation_thailand.state_id,quotation_thailand.quotation_no,user.username,customer.company_name,quotation_thailand.datetime FROM quotation_details_thailand 
                LEFT JOIN quotation_thailand ON quotation_details_thailand.quotation_id = quotation_thailand.id
                LEFT JOIN user ON quotation_thailand.enter_by = user.id
                LEFT JOIN customer ON customer.id = quotation_thailand.customer_id
                WHERE quotation_details_thailand.stock_id = "'.$id.'"');
            $model = $sql->queryAll();

            echo "<table class='table'>";
            echo "<tr><th>Quotation No</th><th>Quoted By</th></tr>";
            foreach ($model as $key => $value) {
                    echo "<tr>";
                    //echo "<td>".$value['quotation_no']."</td>";
                    echo "<td>".Html::a($value['quotation_no'],['/thailand/quotation-thailand/quotation','id'=>$value['ids'],'country_id'=>$mdl],['target' => '_blank'])."</td>";
                    echo "<td>".$value['datetime']."</td>";
                    echo "<td>".$value['company_name']."</td>";
                    echo "<td>".$value['username']."</td>";
                    echo "</tr>";
            }
            echo "</table>";
        }
        elseif ($mdl == 8) {

            $connection = \Yii::$app->db;
            $sql = $connection->createCommand('SELECT quotation_bangladesh.id AS ids,quotation_bangladesh.state_id,quotation_bangladesh.quotation_no,user.username,customer.company_name,quotation_bangladesh.datetime FROM quotation_details_bangladesh
                LEFT JOIN quotation_bangladesh ON quotation_details_bangladesh.quotation_id = quotation_bangladesh.id
                LEFT JOIN user ON quotation_bangladesh.enter_by = user.id
                LEFT JOIN customer ON customer.id = quotation_bangladesh.customer_id
                WHERE quotation_details_bangladesh.stock_id = "'.$id.'"');
            $model = $sql->queryAll();

            echo "<table class='table'>";
            echo "<tr><th>Quotation No</th><th>Quoted By</th></tr>";
            foreach ($model as $key => $value) {
                    echo "<tr>";
                    //echo "<td>".$value['quotation_no']."</td>";
                    echo "<td>".Html::a($value['quotation_no'],['/bangladesh/quotation-bangladesh/quotation','id'=>$value['ids'],'country_id'=>$mdl],['target' => '_blank'])."</td>";
                    echo "<td>".$value['datetime']."</td>";
                    echo "<td>".$value['company_name']."</td>";
                    echo "<td>".$value['username']."</td>";
                    echo "</tr>";
            }
            echo "</table>";
        }



    }



    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {                            


     $module_id =  Yii::$app->user->identity->module_id;       
        $year = date('Y');
        $bulan = date('m');
        $bulanM = date('M');


        $connection = \Yii::$app->db;


        if ($module_id == 3) {

           $sql = $connection->createCommand("SELECT COUNT(sales_activity_log.id) AS total_sales ,user.username AS user_sales
                FROM sales_activity_log 
                LEFT JOIN user ON sales_activity_log.enter_by = user.id
                                LEFT JOIN sales_activity ON sales_activity_log.id_sales_activity = sales_activity.id
                WHERE YEAR(sales_activity_log.date_create) = '".$year."' AND MONTH(sales_activity_log.date_create) = '".$bulan."' AND sales_activity.module_id = 3
                GROUP BY sales_activity_log.enter_by");

            $model = $sql->queryAll();


            $sql2 = $connection->createCommand("SELECT COUNT(quotation_thailand.id) AS total_quotation,lookup_state.state AS state_quotation FROM quotation_thailand
            LEFT JOIN lookup_state ON quotation_thailand.state_id = lookup_state.id
            WHERE YEAR(quotation_thailand.date_create) = '".$year."' AND MONTH(quotation_thailand.date_create) = '".$bulan."'
            GROUP BY quotation_thailand.state_id");

            $model2 = $sql2->queryAll();



            $sql3 = $connection->createCommand("SELECT COUNT(telemarketing_customer.id)  AS total_telemarketing ,user.username AS user_telemarketing
    FROM telemarketing_customer 
    LEFT JOIN user ON  telemarketing_customer.enter_by = user.id
        LEFT JOIN telemarketing ON telemarketing_customer.id_telemarketing = telemarketing.id
    WHERE YEAR(telemarketing_customer.date_create) = '".$year."' AND MONTH(telemarketing_customer.date_create) = '".$bulan."' AND telemarketing.module_id = 3
    GROUP BY telemarketing_customer.enter_by");
    $model3 = $sql3->queryAll();


            $sql4 = $connection->createCommand("SELECT COUNT(message.id) AS total_pending,user.username AS user_pending FROM message
                RIGHT JOIN user ON message.message_to = user.id
                WHERE message.status = 'Pending' AND module_id = 3 GROUP BY user.id");

            $model4 = $sql4->queryAll();






        } elseif ($module_id == 1) {
        
               $sql = $connection->createCommand("SELECT COUNT(sales_activity_log.id) AS total_sales ,user.username AS user_sales
                FROM sales_activity_log 
                LEFT JOIN user ON sales_activity_log.enter_by = user.id
                                LEFT JOIN sales_activity ON sales_activity_log.id_sales_activity = sales_activity.id
                WHERE YEAR(sales_activity_log.date_create) = '".$year."' AND MONTH(sales_activity_log.date_create) = '".$bulan."' AND sales_activity.module_id = 1
                GROUP BY sales_activity_log.enter_by");

            $model = $sql->queryAll();

            $sql2 = $connection->createCommand("SELECT COUNT(quotation.id) AS total_quotation,lookup_state.state AS state_quotation FROM quotation
            LEFT JOIN lookup_state ON quotation.state_id = lookup_state.id
            WHERE YEAR(quotation.date_create) = '".$year."' AND MONTH(quotation.date_create) = '".$bulan."'
            GROUP BY quotation.state_id");

            $model2 = $sql2->queryAll();


            $sql3 = $connection->createCommand("SELECT COUNT(telemarketing_customer.id)  AS total_telemarketing ,user.username AS user_telemarketing
            FROM telemarketing_customer 
            LEFT JOIN user ON  telemarketing_customer.enter_by = user.id
                LEFT JOIN telemarketing ON telemarketing_customer.id_telemarketing = telemarketing.id
            WHERE YEAR(telemarketing_customer.date_create) = '".$year."' AND MONTH(telemarketing_customer.date_create) = '".$bulan."' AND telemarketing.module_id = 1
            GROUP BY telemarketing_customer.enter_by");
            $model3 = $sql3->queryAll();

            $sql4 = $connection->createCommand("SELECT COUNT(message.id) AS total_pending,user.username AS user_pending FROM message
                RIGHT JOIN user ON message.message_to = user.id
                WHERE message.status = 'Pending' AND module_id = 1 GROUP BY user.id");

            $model4 = $sql4->queryAll();


        }
        elseif ($module_id == 8) {
        
               $sql = $connection->createCommand("SELECT COUNT(sales_activity_log.id) AS total_sales ,user.username AS user_sales
                FROM sales_activity_log 
                LEFT JOIN user ON sales_activity_log.enter_by = user.id
                                LEFT JOIN sales_activity ON sales_activity_log.id_sales_activity = sales_activity.id
                WHERE YEAR(sales_activity_log.date_create) = '".$year."' AND MONTH(sales_activity_log.date_create) = '".$bulan."' AND sales_activity.module_id = 8
                GROUP BY sales_activity_log.enter_by");

            $model = $sql->queryAll();

            $sql2 = $connection->createCommand("SELECT COUNT(quotation_bangladesh.id) AS total_quotation,lookup_state.state AS state_quotation FROM quotation_bangladesh
            LEFT JOIN lookup_state ON quotation_bangladesh.state_id = lookup_state.id
            WHERE YEAR(quotation_bangladesh.date_create) = '".$year."' AND MONTH(quotation_bangladesh.date_create) = '".$bulan."'
            GROUP BY quotation_bangladesh.state_id");

            $model2 = $sql2->queryAll();


            $sql3 = $connection->createCommand("SELECT COUNT(telemarketing_customer.id)  AS total_telemarketing ,user.username AS user_telemarketing
            FROM telemarketing_customer 
            LEFT JOIN user ON  telemarketing_customer.enter_by = user.id
                LEFT JOIN telemarketing ON telemarketing_customer.id_telemarketing = telemarketing.id
            WHERE YEAR(telemarketing_customer.date_create) = '".$year."' AND MONTH(telemarketing_customer.date_create) = '".$bulan."' AND telemarketing.module_id = 8
            GROUP BY telemarketing_customer.enter_by");
            $model3 = $sql3->queryAll();

            $sql4 = $connection->createCommand("SELECT COUNT(message.id) AS total_pending,user.username AS user_pending FROM message
                RIGHT JOIN user ON message.message_to = user.id
                WHERE message.status = 'Pending' AND module_id = 8 GROUP BY user.id");

            $model4 = $sql4->queryAll();


        }
        return $this->render('index',[
            'model' => $model,
            'model2' => $model2,
            'model3' => $model3,
            'model4' => $model4,

        ]);
    }

    public function actionDashboard($module_id)
    {

             $year = date('Y');
             $bulan = date('m');
             $bulanM = date('M');

             $connection = \Yii::$app->db;

           $sql = $connection->createCommand("SELECT COUNT(sales_activity_log.id) AS total_sales ,user.username AS user_sales
                FROM sales_activity_log 
                LEFT JOIN user ON sales_activity_log.enter_by = user.id
                                LEFT JOIN sales_activity ON sales_activity_log.id_sales_activity = sales_activity.id
                WHERE YEAR(sales_activity_log.date_create) = '".$year."' AND MONTH(sales_activity_log.date_create) = '".$bulan."' AND sales_activity.module_id = '".$module_id."'
                GROUP BY sales_activity_log.enter_by");

            $model = $sql->queryAll();


            $sql3 = $connection->createCommand("SELECT COUNT(telemarketing_customer.id)  AS total_telemarketing ,user.username AS user_telemarketing
            FROM telemarketing_customer 
            LEFT JOIN user ON  telemarketing_customer.enter_by = user.id
                LEFT JOIN telemarketing ON telemarketing_customer.id_telemarketing = telemarketing.id
            WHERE YEAR(telemarketing_customer.date_create) = '".$year."' AND MONTH(telemarketing_customer.date_create) = '".$bulan."' AND telemarketing.module_id = '".$module_id."'
            GROUP BY telemarketing_customer.enter_by");
            $model3 = $sql3->queryAll();


            $sql4 = $connection->createCommand("SELECT COUNT(message.id) AS total_pending,user.username AS user_pending FROM message
                RIGHT JOIN user ON message.message_to = user.id
                WHERE message.status = 'Pending' AND module_id = '".$module_id."' GROUP BY user.id");

            $model4 = $sql4->queryAll();


            if ($module_id == 3) {
                $sql2 = $connection->createCommand("SELECT COUNT(quotation_thailand.id) AS total_quotation,lookup_state.state AS state_quotation FROM quotation_thailand
                LEFT JOIN lookup_state ON quotation_thailand.state_id = lookup_state.id
                WHERE YEAR(quotation_thailand.date_create) = '".$year."' AND MONTH(quotation_thailand.date_create) = '".$bulan."'
                GROUP BY quotation_thailand.state_id");

                $model2 = $sql2->queryAll();
            } elseif ($module_id == 1) {

            $sql2 = $connection->createCommand("SELECT COUNT(quotation.id) AS total_quotation,lookup_state.state AS state_quotation FROM quotation
            LEFT JOIN lookup_state ON quotation.state_id = lookup_state.id
            WHERE YEAR(quotation.date_create) = '".$year."' AND MONTH(quotation.date_create) = '".$bulan."'
            GROUP BY quotation.state_id");

            $model2 = $sql2->queryAll();

            }

        return $this->render('dashboard',[
            'model' => $model,
            'model2' => $model2,
            'model3' => $model3,
            'model4' => $model4,

        ]);



    }




    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'login';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {


            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

               
            } 
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved. Please Logout to make a changes');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


        public function actionReturn($id)
    {
        /*$id =  $_POST['id'];*/
        $connection = \Yii::$app->db;
        $update = $connection->createCommand("UPDATE chat_message SET status = 'Read' WHERE message_from = '".$id."'")->execute();

        return $this->redirect(['/user/chatbox', 
            'id' => $id,
        ]);

    }
}
