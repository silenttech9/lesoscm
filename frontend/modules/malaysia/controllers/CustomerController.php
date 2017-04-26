<?php

namespace frontend\modules\malaysia\controllers;

use Yii;
use frontend\modules\malaysia\models\Customer;
use frontend\modules\malaysia\models\CustomerSearch;
use frontend\modules\malaysia\models\CustomerPic;
use frontend\modules\malaysia\models\CustomerPicSearch;
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
    public function actionIndex($render_state_id)
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['render_state_id'=>$render_state_id]);

        return $this->render('index', [
            'render_state_id' => $render_state_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOversea($render_state_id,$agent_id)
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['render_state_id'=>$render_state_id,'agent_id'=>$agent_id]);

        return $this->render('oversea', [
            'render_state_id' => $render_state_id,
            'agent_id' => $agent_id,
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

    public function actionViewover($id)
    {

        $dataProvider = new ActiveDataProvider([
            'query' => CustomerPic::find()
                    ->where(['customer_id'=>$id]),
        ]);

        return $this->render('viewover', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */



    public function actionCreate($render_state_id)
    {

        $model = new Customer();

        if ($model->load(Yii::$app->request->post()) ) {

            //print_r($_POST);
            $model->company_name = strtoupper($_POST['Customer']['company_name']);
            $model->address = strtoupper($_POST['Customer']['address']);
            $model->city = strtoupper($_POST['Customer']['city']);
            $model->date_create = date('Y-m-d h:i:s');
            $model->render_state_id = $render_state_id;
            $model->enter_by= Yii::$app->user->identity->id;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'render_state_id' => $render_state_id,
                'model' => $model,

            ]);
        }
    }

    public function actionCreateover($render_state_id,$agent_id)
    {

        $model = new Customer();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->company_name = strtoupper($_POST['Customer']['company_name']);
            $model->address = strtoupper($_POST['Customer']['address']);
            $model->city = strtoupper($_POST['Customer']['city']);
            $model->date_create = date('Y-m-d h:i:s');
            $model->render_state_id = $render_state_id;
            $model->enter_by= Yii::$app->user->identity->id;

            $model->save();
            return $this->redirect(['viewover', 'id' => $model->id]);
        } else {
            return $this->render('createover', [
                'render_state_id' => $render_state_id,
                'agent_id' => $agent_id,
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
    public function actionUpdate($id)
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
                'dataProvider' => $dataProvider,
            ]);
        }
    }


    public function actionUpdateover($id)
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

            $model->save();
            return $this->redirect(['viewover', 'id' => $model->id]);
        } else {
            return $this->render('updateover', [
                'model' => $model,
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
    public function actionDelete($id,$render_state_id)
    {
        $this->findModel($id)->delete();
        CustomerPic::deleteAll(['customer_id'=>$id]);

       return $this->redirect(['index','render_state_id'=>$render_state_id]);
    }

    public function actionDeleteover($id,$render_state_id,$agent_id)
    {
        $this->findModel($id)->delete();
        CustomerPic::deleteAll(['customer_id'=>$id]);

       return $this->redirect(['oversea','render_state_id'=>$render_state_id,'agent_id'=>$agent_id]);
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
