<?php

namespace frontend\modules\thailand\controllers;

use Yii;
use frontend\modules\thailand\models\QuotationThailand;
use frontend\modules\thailand\models\QuotationThailandSearch;
use frontend\modules\thailand\models\QuotationReviseThailand;
use frontend\modules\thailand\models\QuotationDetailsThailand;


use frontend\modules\malaysia\models\SelangorStock;
use frontend\modules\malaysia\models\PenangStock;
use frontend\modules\malaysia\models\JohorStock;

use frontend\modules\thailand\models\Customer;
use frontend\modules\thailand\models\CustomerPic;
use common\models\Stock;
use common\models\CompanyInformation;
use frontend\modules\thailand\models\ThailandStock;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
/**
 * QuotationThailandController implements the CRUD actions for QuotationThailand model.
 */
class QuotationThailandController extends Controller
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
     * Lists all QuotationThailand models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuotationThailandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QuotationThailand model.
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
     * Creates a new QuotationThailand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QuotationThailand();

        if ($model->load(Yii::$app->request->post())) {

            $getQ = QuotationThailand::find()->orderBy(['id' => SORT_DESC])->limit(1)->one();
            //check wheter quotation have it or not , if not start with 1000 after that +1
            
            if (empty($getQ['quotation_no'])) {

                $runninNo = 1000;
                $quotation = 'QTH'.$runninNo;
                
            } else {
                $qt = substr($getQ['quotation_no'], 3);

                $new = $qt + 1;
                $runninNo = $new;

                $quotation = 'QTH'.$runninNo;
            }

            $model->quotation_no = $quotation;
            $model->status = "Progress";
            $model->date_create = date('Y-m-d h:i:s');
            $model->enter_by= Yii::$app->user->identity->id;
            $model->save();
           // Yii::$app->getSession()->setFlash('view', 'Data Successful Saved');
            return $this->redirect(['stock', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Updates an existing QuotationThailand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            $model->date_update = date('Y-m-d h:i:s');
            $model->update_by= Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['stock', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing QuotationThailand model.
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
     * Finds the QuotationThailand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuotationThailand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuotationThailand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }




    public function actionStock($id)
    {

        $model2 = new QuotationDetailsThailand();

        $detail = new ActiveDataProvider([
            'query' => QuotationDetailsThailand::find()->where(['quotation_id'=>$id]),
        ]);


        if ($model2->load(Yii::$app->request->post()) ) {
            
            $model2->quotation_id = $id;
            $model2->save();

            //Yii::$app->getSession()->setFlash('createItem', 'Item info Successful Saved');
            return $this->redirect(['/thailand/quotation-thailand/stock', 'id' => $model2->quotation_id]);
        } else {
            return $this->render('stock', [
                'model2' => $model2,
                'detail' => $detail,
                'model' => $this->findModel($id),
                //'revise' => $revise,
            ]);
        }


    }

    public function actionAll($id){

        $connection = \Yii::$app->db;

        if ($id != "") {
            $sql = $connection->createCommand('SELECT id,ITEM_NO,DESCRIPTION FROM stock WHERE ITEM_NO LIKE "%'.$id.'%" OR DESCRIPTION LIKE "%'.$id.'%"');
            $model = $sql->queryAll();

            foreach ($model as $key => $value) {
                echo "<ul>";
                echo "<li><a href='#' id='".$value['ITEM_NO']."' class='stockinfo' id=>".$value['ITEM_NO']." - ".$value['DESCRIPTION']."</a></li>";
                echo "</ul>";

            }
        } else {
            echo "No Data";
        }



        echo "<script type='text/javascript'>";
        echo "$('.stockinfo').on('click', function(){";
        echo "var v = $(this).attr('id');";
        echo "$.ajax({";
        echo "url: 'stockstate',";
        echo "data: {id: v},";
        echo "success: function(data) {";
        echo "$('.stock-state').show();";
        echo "$('.stock-state').html(data);";
   
        echo "}";
        echo "});";
        echo "});";
        echo "</script>";


        echo "<script type='text/javascript'>";
        echo "$('.stockinfo').on('click', function(){";
        echo "var v = $(this).attr('id');";
        echo "$.ajax({";
        echo "url: 'stockdrop',";
        echo "data: {id: v},";
        echo "success: function(data) {";
        echo "$('select#stock-id-get').html(data);";
        echo "}";
        echo "});";
        echo "});";
        echo "</script>";


        echo "<script type='text/javascript'>";
        echo "$('.stockinfo').on('click', function(){";
        echo "var v = $(this).attr('id');";
        echo "$.ajax({";
        echo "url: 'desc',";
        echo "data: {id: v},";
        echo "success: function(data) {";
        echo "$('#extra-desc').text(data);";
        echo "$('p').text(data);";
        echo "}";
        echo "});";
        echo "});";
        echo "</script>";


    }


    public function actionStockdrop($id)
    {
        $countPosts = Stock::find()
        ->where(['ITEM_NO' => $id])
        ->count();
         
        $posts = Stock::find() 
        ->where(['ITEM_NO' => $id])
        ->all();
         
        if($countPosts>0){
            foreach($posts as $post){
                echo "<option value='".$post->id."'>".$post->ITEM_NO."</option>";
            }
        } else {
                echo "<option></option>";
        }
     
    }


    public function actionDesc($id){
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT * FROM stock WHERE ITEM_NO = "'.$id.'"');
        $model = $sql->queryAll();

        foreach ($model as $key => $value) {
            echo $value['DESCRIPTION'];

        }
    }

    public function actionStockstate($id){

        $stock = Stock::find()->where(['ITEM_NO'=>$id])->one();

        if (empty($stock->ITEM_NO)) {
           echo "No <b>ITEM NO</b> in Stock, Please Enter New Stock";
           echo "<br>";
           echo "<br>";
        } else {
            echo "ITEM NO : "."<b>".$item = $stock->ITEM_NO."</b>";
           echo "<br>";
           echo "<br>";
        }

            $selangor = SelangorStock::find()->where(['ITEM_NO'=>$id])->one();
            $balS = empty($selangor->BAL) ? 0 : $selangor->BAL;
            $locS = empty($selangor->LOCATION) ? 'empty' : $selangor->LOCATION;

            $penang = PenangStock::find()->where(['ITEM_NO'=>$id])->one();
            $balP = empty($penang->BAL) ? 0 : $penang->BAL;
            $locP = empty($penang->LOCATION) ? 'empty' : $penang->LOCATION;

            $johor = JohorStock::find()->where(['ITEM_NO'=>$id])->one();
            $balJ = empty($johor->BAL) ? 0: $johor->BAL;
            $locJ = empty($johor->LOCATION) ? 'empty' : $johor->LOCATION;

            $thailand = ThailandStock::find()->where(['ITEM_NO'=>$id])->one();
            $balT = empty($thailand->BAL) ? 0: $thailand->BAL;
            $locT = empty($thailand->LOCATION) ? 'empty' : $thailand->LOCATION;



            echo "<table class='table'><tr><th>State</th><th>On Hand</th><th>Location</th></tr>";
            echo "<tr><td>Selangor</td><td><span class='font-red bold uppercase'>".$balS."</span></td><td>".$locS."</td></tr>";
            echo "<tr><td>Penang</td><td><span class='font-red bold uppercase'>".$balP."</span></td><td>".$locP."</td></tr>";
            echo "<tr><td>Johor</td><td><span class='font-red bold uppercase'>".$balJ."</span></td><td>".$locJ."</td></tr>";
            echo "<tr><td>Thailand</td><td><span class='font-red bold uppercase'>".$balT."</span></td><td>".$locT."</td></tr>";
            echo "</table>";

    }

    public function actionDiscount($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            $model->date_update = date('Y-m-d h:i:s');
            $model->update_by= Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['stock', 'id' => $model->id]);
        } else {
            return $this->renderAjax('discount', [
                'model' => $model,
            ]);
        }
    }


    public function actionCust($q = null, $id = null){
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


    public function actionAddress($id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT * FROM customer WHERE id = '".$id."' AND module_id = 3");

        $address = $sql->queryAll();

        foreach ($address as $key => $value) {
            echo "<p> Address : <span class='font-blue-steel bold'>".$value['address']."</span></p>";
        }
    }



    public function actionSale($id){


        $countPosts = Customer::find()
        ->where(['id'=>$id])
        ->count();


        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT l.id,l.agent,c.agent_id FROM customer c RIGHT JOIN lookup_agent l ON c.agent_id = l.id WHERE c.id = '".$id."' AND l.module_id = 3");


        $sales = $sql->queryAll();
       // $sales = SelangorCustomer::find()->joinWith('sales')->where(['selangor_customer.id'=>$id])->all();

        if ($countPosts>0) {

            if (empty($sales)) {
                    echo "<span class='font-red-soft font-md'>Agent : No Agent Set For This Customer </span>"." - "."<a href='#' class='change-sale' >Add Agent</a>";
                    echo "<br>";
                    echo "<br>";
            } else {

               foreach ($sales as $sale) {

                    echo "<span class='font-red-soft font-md'>".'Agent : '.$sale['agent']."</span>"." - "."<a href='#' class='change-sale' >Change Agent</a>";
                    echo "<input type='hidden' id='sale-hidden' name='Quotation[agent_id]' value='".$sale['id']."' />";
                    echo "<br>";
                    echo "<br>";
                    
               }



            }


        } else {

           echo "-";
        }

        echo "<script type='text/javascript'>";
        echo "$('.change-sale').on('click', function(){";
        echo "$('.sale-quotation-info-change').show();";
        echo "$('#salesdropdown').prop('disabled', false);";  
        echo "$('.sale-quotation-info').hide();";
        echo "});";
        echo "</script>";




    } 

    public function actionStax($id){


        $countPosts = Customer::find()
        ->where(['id'=>$id])
        ->count();

        //$staxs = SelangorCustomer::find()->joinWith('stax')->where(['selangor_customer.id'=>$id])->all();

        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT l.id,l.CODE,c.staxcode_id FROM customer c RIGHT JOIN lookup_stax l ON c.staxcode_id = l.id WHERE c.id = '".$id."' AND l.module_id = 3");


        $staxs = $sql->queryAll();


        if ($countPosts>0) {

            if (empty($staxs)) {
                    echo "<span class='font-red-soft font-md'>Tax Code : No Tax Code Set For This Customer </span>"." - "."<a href='#' class='change-tax' >Add Tax</a>";
                     echo "<br>";
                    echo "<br>";
            } else {

               foreach ($staxs as $stax) {

                    echo "<span class='font-red-soft font-md'>".'Tax Code : '.$stax['CODE']."</span>"." - "."<a href='#' class='change-tax' >Change Tax</a>";
                    echo "<input type='hidden' id='taxhidden' name='Quotation[tax_code_id]' value='".$stax['id']."' />";
                    echo "<br>";
                    echo "<br>";
                    
               }



            }

        } else {

            echo "<option value=''>-</option>";
        }

        echo "<script type='text/javascript'>";
        echo "$('.change-tax').on('click', function(){";
        echo "$('.tax-quotation-info-change').show();";
        echo "$('#taxsdropdown').prop('disabled', false);";  
        echo "$('.tax-quotation-info').hide();";
        echo "});";
        echo "</script>";



    } 


    public function actionArea($id){


        $countPosts = Customer::find()
        ->where(['id'=>$id])
        ->count();


        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT l.id,l.area,c.area_code_id FROM customer c RIGHT JOIN lookup_area l ON c.area_code_id = l.id WHERE c.id = '".$id."' AND l.module_id = 3");


        $areas = $sql->queryAll();

        //$areas = SelangorCustomer::find()->joinWith('area')->where(['selangor_customer.id'=>$id])->all();

        if ($countPosts>0) {

            if (empty($areas)) {
                    echo "<span class='font-red-soft font-md'>Area Code : No Area Code Set For This Customer </span>"." - "."<a href='#' class='change-area' >Add Area Code</a>";
                    echo "<br>";
                    echo "<br>";
            } else {

               foreach ($areas as $area) {

                        echo "<span class='font-red-soft font-md'>".'Area Code : '.$area['area']."</span>"." - "."<a href='#' class='change-area' >Change Area Code</a>";
                        echo "<input type='hidden' id='area-hidden' name='Quotation[area_code_id]' value='".$area['id']."' />";
                        echo "<br>";
                        echo "<br>";
                    
               }



            }


        } else {

           echo "-";
        }

        echo "<script type='text/javascript'>";
        echo "$('.change-area').on('click', function(){";
        echo "$('.area-quotation-info-change').show();";
        echo "$('#areadropdown').prop('disabled', false);";  
        echo "$('.area-quotation-info').hide();";
        echo "});";
        echo "</script>";



    } 


    public function actionQuotation($id,$country_id) 
    {

        $company = CompanyInformation::find()->where(['country_id'=>$country_id])->one();

        $connection = \Yii::$app->db;
        $sql2 = $connection->createCommand("SELECT 
        quotation_thailand.quotation_no,
        quotation_thailand.discount AS discount,
        quotation_thailand.revise,
        quotation_thailand.remark,
        DATE_FORMAT(quotation_thailand.datetime,'%d/%m/%Y') AS date,
        DATE_FORMAT(quotation_thailand.date_revise,'%d/%m/%Y') AS date_revise,
        customer.company_name AS company,
        customer.address AS addr,
        customer.postcode AS postcode,
        customer.city AS city,
        customer.country_code_phone,
        customer.area_code_phone,
        customer.telephone_no,
        customer.fax_no,
        customer.email,
        customer.country_code_fax,
        customer.area_code_fax,
        lookup_state.state,
        lookup_country.country,
        att.`name` AS attention,
        att.department AS att_department,
        att.country_code_phone AS att_country_code_phone,
        att.area_code_phone AS att_area_code_phone,
        att.telephone_no AS att_telephone_no,
        att.extension AS att_extension,
        att.country_code_mobile AS att_country_code_mobile,
        att.area_code_mobile AS att_area_code_mobile,
        att.mobile_no AS att_mobile_no,
        att.email AS att_email,

        cc.`name` AS cc_customer,
        cc.department AS cc_department,
        cc.country_code_phone AS cc_country_code_phone,
        cc.area_code_phone AS cc_area_code_phone,
        cc.telephone_no AS cc_telephone_no,
        cc.extension AS cc_extension,
        cc.country_code_mobile AS cc_country_code_mobile,
        cc.area_code_mobile AS cc_area_code_mobile,
        cc.mobile_no AS cc_mobile_no,
        cc.email AS cc_email,


        lookup_agent.agent AS agent_quotation,

        lookup_stax.`CODE` AS tax,
        lookup_area.area AS area,
        lookup_delivery.delivery,
        lookup_validity.validity,
        lookup_term.term,
        lookup_currency.currency_code AS currency,
        quotation_thailand.tender_visible,
        lookup_tender.tender,
        quotedBy.username AS quoted,
        reviseBy.username AS reviseQuotation,

        lookup_agent.handphone_no AS agent_phone
        FROM quotation_thailand 
        LEFT JOIN customer ON quotation_thailand.customer_id = customer.id 
        LEFT JOIN customer_pic AS att ON quotation_thailand.customer_ship_id = att.id
        LEFT JOIN customer_pic AS cc ON quotation_thailand.cc_customer_ship_id = cc.id
        LEFT JOIN lookup_agent ON quotation_thailand.agent_id = lookup_agent.id
        LEFT JOIN lookup_stax ON quotation_thailand.tax_code_id = lookup_stax.id
        LEFT JOIN lookup_area ON quotation_thailand.area_code_id = lookup_area.id
        LEFT JOIN lookup_delivery ON quotation_thailand.delivery_id = lookup_delivery.id
        LEFT JOIN lookup_validity ON quotation_thailand.validity_id = lookup_validity.id
        LEFT JOIN lookup_state ON customer.state_id = lookup_state.id
        LEFT JOIN lookup_country ON customer.country_id = lookup_country.id
        LEFT JOIN lookup_term ON customer.term_id = lookup_term.id
        LEFT JOIN lookup_currency ON quotation_thailand.currency_id = lookup_currency.id
        LEFT JOIN lookup_tender ON quotation_thailand.tender_id = lookup_tender.id
        LEFT JOIN user AS quotedBy ON quotation_thailand.enter_by = quotedBy.id
        LEFT JOIN user AS reviseBy ON quotation_thailand.revise_id = reviseBy.id
        WHERE quotation_thailand.id = '".$id."'");

        $model_quotation = $sql2->queryAll();


        $sql = $connection->createCommand("SELECT 
            stock.ITEM_NO AS ITEM_NO,
            quotation_details_thailand.extra_description AS DESCRIPTION,
            quotation_details_thailand.quantity,
            quotation_details_thailand.price,
            lookup_unit_of_measure.unit_of_measure
            FROM quotation_details_thailand 
            LEFT JOIN stock ON quotation_details_thailand.stock_id = stock.id
            LEFT JOIN lookup_unit_of_measure ON quotation_details_thailand.unit = lookup_unit_of_measure.id
            WHERE quotation_details_thailand.quotation_id =  '".$id."'");

        $model_stock = $sql->queryAll();
        
        return $this->render('quotation',[
            'id' => $id,
            'country_id' => $country_id,
            'model' => $this->findModel($id),
            'model_quotation' => $model_quotation,
            'model_stock' => $model_stock,
            'company' => $company,


        ]);
    }

    public function actionGenerate($id)
    {
        
        $model = $this->findModel($id);

        $model->status = "Confirm";
        $model->save();
        Yii::$app->getSession()->setFlash('generate', 'Quotation Successful Generate');
        return $this->redirect(['quotation', 'id' => $model->id,'country_id'=> 3]);

    }

    public function actionInfo($id)
    {

        $revise = new ActiveDataProvider([
            'query' => QuotationReviseThailand::find()->where(['quotation_id'=>$id]),
        ]);

        return $this->render('info', [
            'model' => $this->findModel($id),
            'revise' => $revise,
        ]);
    }

    public function actionPdf($id,$country_id)
    {
        $company = CompanyInformation::find()->where(['country_id'=>$country_id])->one();

        $connection = \Yii::$app->db;
        $sql2 = $connection->createCommand("SELECT 
        quotation_thailand.quotation_no,
        quotation_thailand.discount AS discount,
        quotation_thailand.revise,
        quotation_thailand.remark,
        DATE_FORMAT(quotation_thailand.datetime,'%d/%m/%Y') AS date,
        DATE_FORMAT(quotation_thailand.date_revise,'%d/%m/%Y') AS date_revise,
        customer.company_name AS company,
        customer.address AS addr,
        customer.postcode AS postcode,
        customer.city AS city,
        customer.country_code_phone,
        customer.area_code_phone,
        customer.telephone_no,
        customer.fax_no,
        customer.email,
        customer.country_code_fax,
        customer.area_code_fax,
        lookup_state.state,
        lookup_country.country,
        
        att.`name` AS attention,
        att.department AS att_department,
        att.country_code_phone AS att_country_code_phone,
        att.area_code_phone AS att_area_code_phone,
        att.telephone_no AS att_telephone_no,
        att.extension AS att_extension,
        att.country_code_mobile AS att_country_code_mobile,
        att.area_code_mobile AS att_area_code_mobile,
        att.mobile_no AS att_mobile_no,
        att.email AS att_email,

        cc.`name` AS cc_customer,
        cc.department AS cc_department,
        cc.country_code_phone AS cc_country_code_phone,
        cc.area_code_phone AS cc_area_code_phone,
        cc.telephone_no AS cc_telephone_no,
        cc.extension AS cc_extension,
        cc.country_code_mobile AS cc_country_code_mobile,
        cc.area_code_mobile AS cc_area_code_mobile,
        cc.mobile_no AS cc_mobile_no,
        cc.email AS cc_email,

        lookup_agent.agent AS agent_quotation,
        lookup_stax.`CODE` AS tax,
        lookup_area.area AS area,
        lookup_delivery.delivery,
        lookup_validity.validity,
        lookup_term.term,
        lookup_currency.currency_code AS currency,
                quotation_thailand.tender_visible,
        lookup_tender.tender,
        quotedBy.username AS quoted,
        reviseBy.username AS reviseQuotation,
        lookup_agent.handphone_no AS agent_phone
        FROM quotation_thailand 
        LEFT JOIN customer ON quotation_thailand.customer_id = customer.id 
        LEFT JOIN customer_pic AS att ON quotation_thailand.customer_ship_id = att.id
        LEFT JOIN customer_pic AS cc ON quotation_thailand.cc_customer_ship_id = cc.id
        LEFT JOIN lookup_agent ON quotation_thailand.agent_id = lookup_agent.id
        LEFT JOIN lookup_stax ON quotation_thailand.tax_code_id = lookup_stax.id
        LEFT JOIN lookup_area ON quotation_thailand.area_code_id = lookup_area.id
        LEFT JOIN lookup_delivery ON quotation_thailand.delivery_id = lookup_delivery.id
        LEFT JOIN lookup_validity ON quotation_thailand.validity_id = lookup_validity.id
        LEFT JOIN lookup_state ON customer.state_id = lookup_state.id
        LEFT JOIN lookup_country ON customer.country_id = lookup_country.id
        LEFT JOIN lookup_term ON customer.term_id = lookup_term.id
        LEFT JOIN lookup_currency ON quotation_thailand.currency_id = lookup_currency.id
        LEFT JOIN lookup_tender ON quotation_thailand.tender_id = lookup_tender.id
        LEFT JOIN user AS quotedBy ON quotation_thailand.enter_by = quotedBy.id
        LEFT JOIN user AS reviseBy ON quotation_thailand.revise_id = reviseBy.id
        WHERE quotation_thailand.id = '".$id."'");

        $model_quotation = $sql2->queryAll();


        $sql = $connection->createCommand("SELECT 
            stock.ITEM_NO AS ITEM_NO,
            quotation_details_thailand.extra_description AS DESCRIPTION,
            quotation_details_thailand.quantity,
            quotation_details_thailand.price,
            lookup_unit_of_measure.unit_of_measure
            FROM quotation_details_thailand 
            LEFT JOIN stock ON quotation_details_thailand.stock_id = stock.id
            LEFT JOIN lookup_unit_of_measure ON quotation_details_thailand.unit = lookup_unit_of_measure.id
            WHERE quotation_details_thailand.quotation_id =  '".$id."'");

        $model_stock = $sql->queryAll();




        $content = $this->renderPartial('pdf',[
            'company' => $company,
            'model_quotation' => $model_quotation,
            'model_stock' => $model_stock,

        ]);

        $date = date('d/m/Y');
        $pdf = new Pdf([
            // set to use core fonts only
            //'mode' => Pdf::MODE_CORE, 
            'mode' => Pdf::MODE_BLANK,
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
    
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Quotation'],
             // call mPDF methods on the fly
           // 'methods' => [ 
             //   'SetFooter'=>['{PAGENO}'],
            //]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
        
    }


    public function actionRevise($id,$country_id)
    {

        $company = CompanyInformation::find()->where(['country_id'=>$country_id])->one();


        $connection = \Yii::$app->db;
        $sql2 = $connection->createCommand("SELECT 
        quotation_thailand.quotation_no,
        quotation_thailand.discount AS discount,
        quotation_thailand.revise,
        quotation_thailand.remark,
        DATE_FORMAT(quotation_thailand.datetime,'%d/%m/%Y') AS date,
        DATE_FORMAT(quotation_thailand.date_revise,'%d/%m/%Y') AS date_revise,
        customer.company_name AS company,
        customer.address AS addr,
                        customer.postcode AS postcode,
        customer.city AS city,
        customer.country_code_phone,
        customer.area_code_phone,
        customer.telephone_no,
        customer.fax_no,
        customer.email,
                customer.country_code_fax,
        customer.area_code_fax,
        lookup_state.state,
        lookup_country.country,
        att.`name` AS attention,
        att.department AS att_department,
        att.country_code_phone AS att_country_code_phone,
        att.area_code_phone AS att_area_code_phone,
        att.telephone_no AS att_telephone_no,
        att.extension AS att_extension,
        att.country_code_mobile AS att_country_code_mobile,
        att.area_code_mobile AS att_area_code_mobile,
        att.mobile_no AS att_mobile_no,
        att.email AS att_email,

        cc.`name` AS cc_customer,
        cc.department AS cc_department,
        cc.country_code_phone AS cc_country_code_phone,
        cc.area_code_phone AS cc_area_code_phone,
        cc.telephone_no AS cc_telephone_no,
        cc.extension AS cc_extension,
        cc.country_code_mobile AS cc_country_code_mobile,
        cc.area_code_mobile AS cc_area_code_mobile,
        cc.mobile_no AS cc_mobile_no,
        cc.email AS cc_email,
        lookup_agent.agent AS agent_quotation,
        lookup_stax.`CODE` AS tax,
        lookup_area.area AS area,
        lookup_delivery.delivery,
        lookup_validity.validity,
        lookup_term.term,
        lookup_currency.currency_code AS currency,
        quotation_thailand.tender_visible,
        lookup_tender.tender,
        quotedBy.username AS quoted,
        reviseBy.username AS reviseQuotation,
        lookup_agent.handphone_no AS agent_phone
        FROM quotation_thailand 
        LEFT JOIN customer ON quotation_thailand.customer_id = customer.id 
        LEFT JOIN customer_pic AS att ON quotation_thailand.customer_ship_id = att.id
        LEFT JOIN customer_pic AS cc ON quotation_thailand.cc_customer_ship_id = cc.id
        LEFT JOIN lookup_agent ON quotation_thailand.agent_id = lookup_agent.id
        LEFT JOIN lookup_stax ON quotation_thailand.tax_code_id = lookup_stax.id
        LEFT JOIN lookup_area ON quotation_thailand.area_code_id = lookup_area.id
        LEFT JOIN lookup_delivery ON quotation_thailand.delivery_id = lookup_delivery.id
        LEFT JOIN lookup_validity ON quotation_thailand.validity_id = lookup_validity.id
        LEFT JOIN lookup_state ON customer.state_id = lookup_state.id
        LEFT JOIN lookup_country ON customer.country_id = lookup_country.id
        LEFT JOIN lookup_term ON customer.term_id = lookup_term.id
        LEFT JOIN lookup_currency ON quotation_thailand.currency_id = lookup_currency.id
        LEFT JOIN lookup_tender ON quotation_thailand.tender_id = lookup_tender.id
        LEFT JOIN user AS quotedBy ON quotation_thailand.enter_by = quotedBy.id
        LEFT JOIN user AS reviseBy ON quotation_thailand.revise_id = reviseBy.id
        WHERE quotation_thailand.id = '".$id."'");

    
        $sql = $connection->createCommand("SELECT 
            stock.ITEM_NO AS ITEM_NO,
            quotation_details_thailand.extra_description AS DESCRIPTION,
            quotation_details_thailand.quantity,
            quotation_details_thailand.price,
            lookup_unit_of_measure.unit_of_measure
            FROM quotation_details_thailand 
            LEFT JOIN stock ON quotation_details_thailand.stock_id = stock.id
            LEFT JOIN lookup_unit_of_measure ON quotation_details_thailand.unit = lookup_unit_of_measure.id
            WHERE quotation_details_thailand.quotation_id =  '".$id."'");

        $model_stock = $sql->queryAll();



        $sql3 = $connection->createCommand("SELECT * FROM company_information WHERE country_id = '".$country_id."'");
        $model_company = $sql3->queryAll();


        $model_quotation = $sql2->queryAll();

            $info = serialize($model_quotation);

        

            $detail = serialize($model_stock);

        $company_info = serialize($model_company);

        $count = QuotationReviseThailand::find()->where(['quotation_id'=>$id])->count();

        $count; // count how many time that quotation has been revise
        $newC = ++$count; // this will count ++
        $newC;

        $model2 = $this->findModel($id);



        $model = new QuotationReviseThailand();

        $model->company_info = $company_info;           
        $model->info_history_quotation = $info;
        $model->details_history_quotation = $detail;
        $model->quotation_id = $id;
        $model->quotation_no = $model2->quotation_no.$model2->revise;

        $model->date_create = date('Y-m-d h:i:s');
        $model->enter_by= Yii::$app->user->identity->id;
        $model->save();


        $new_revise_quotation_no = '-R'.$newC;

        $model2->revise = $new_revise_quotation_no;
        $model2->status = "Progress";
        $model2->date_revise = date('Y-m-d h:i:s');
        $model2->revise_id= Yii::$app->user->identity->id;
        $model2->save();



        Yii::$app->getSession()->setFlash('revise', 'Quotation Successful Revise');
        return $this->redirect(['stock', 'id' => $id]);

    }

    public function actionPdfq($id)
    {

        $connection = \Yii::$app->db;
        $sql2 = $connection->createCommand("SELECT * FROM quotation_revise_thailand WHERE id = '".$id."'");

        $model_quotation_history = $sql2->queryAll();

        foreach ($model_quotation_history as $key => $value) {
            $company_info = unserialize($value['company_info']);
            $info_history_quotation = unserialize($value['info_history_quotation']);
            $details_history_quotation = unserialize($value['details_history_quotation']);

        }

        $company = $company_info;

        $info = $info_history_quotation;

        $detail = $details_history_quotation;

        $content = $this->renderPartial('pdfq',[
            'company' => $company,
            'info' => $info,
            'detail' => $detail,

        ]);

        $date = date('d/m/Y');
        $pdf = new Pdf([
            // set to use core fonts only
            //'mode' => Pdf::MODE_CORE, 
            'mode' => Pdf::MODE_BLANK,
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
    
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Quotation'],
             // call mPDF methods on the fly
           // 'methods' => [ 
                //'SetHeader'=>'Summary Harian - '.$date, 
             //   'SetFooter'=>['{PAGENO}'],
            //]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
        
    }



}
