<?php

namespace frontend\modules\thailand\controllers;

use Yii;
use frontend\modules\thailand\models\Customer;
use frontend\modules\thailand\models\CustomerSearch;
use frontend\modules\thailand\models\CustomerPic;
use frontend\modules\thailand\models\CustomerPicSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\LookupState;
use yii\data\ActiveDataProvider;
/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex($module_id)
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['module_id'=>$module_id]);

        return $this->render('index', [
            'module_id' => $module_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $dataProvider = new ActiveDataProvider([
            'query' => CustomerPic::find()
                    ->where(['customer_id'=>$id]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($module_id)
    {
        $model = new Customer();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->company_name = strtoupper($_POST['Customer']['company_name']);
            $model->address = strtoupper($_POST['Customer']['address']);
            $model->city = strtoupper($_POST['Customer']['city']);
            $model->date_create = date('Y-m-d h:i:s');
            $model->module_id = $module_id;
            $model->enter_by= Yii::$app->user->identity->id;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'module_id' => $module_id,
                'model' => $model,

            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$module_id)
    {
        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' => CustomerPic::find()
                    ->where(['customer_id'=>$id]),
        ]);

        if ($model->load(Yii::$app->request->post()) ) {


            $model->company_name = strtoupper($_POST['Customer']['company_name']);
            $model->address = strtoupper($_POST['Customer']['address']);
            $model->city = strtoupper($_POST['Customer']['city']);
            $model->date_update = date('Y-m-d h:i:s');
            $model->update_by= Yii::$app->user->identity->id;
            //$model->render_state_id = $model->state_id;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'module_id' => $module_id,
                'dataProvider' => $dataProvider,
            ]);
        }
    }


    /**
     * Deletes an existing Customer model.
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
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionCountry($id){
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT * FROM lookup_phone_country_code WHERE code = "'.$id.'"');
        $model = $sql->queryAll();

        foreach ($model as $key => $value) {
            echo "<span class='font-blue-steel bold uppercase'>".$value['country']."</span>";

        }
    }

    public function actionState($id)
    {
        $countPosts = LookupState::find()
        ->where(['country_id' => $id])
        ->count();

        $posts = LookupState::find()
        ->where(['country_id' => $id])
        ->all();

        if($countPosts>0){
            echo "<option value=''>-Please Choose-</option>";
            foreach($posts as $post){
                echo "<option value='".$post->id."'>".$post->state."</option>";
            }
        } else {
                echo "<option></option>";
        }

    }





    public function actionSearcht($id){
        $connection = \Yii::$app->db;

        $sql = $connection->createCommand('SELECT company_name,address FROM customer WHERE company_name LIKE "%'.$id.'%" AND module_id = 3');
        $model = $sql->queryAll();

        foreach ($model as $key => $value) {
            echo "<ul>";
            echo "<li><span class='font-blue-steel bold uppercase'>".$value['company_name']." - ".$value['address']."</span> -</li>";
            echo "</ul>";

        }
    }



}
