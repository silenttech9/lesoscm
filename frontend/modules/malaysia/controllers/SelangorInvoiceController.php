<?php

namespace frontend\modules\malaysia\controllers;

use Yii;
use frontend\modules\malaysia\models\SelangorInvoice;
use frontend\modules\malaysia\models\SelangorInvoiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Warranty;
use yii\data\ActiveDataProvider;
use common\models\UploadInvoice;
use yii\web\UploadedFile;


/**
 * SelangorInvoiceController implements the CRUD actions for SelangorInvoice model.
 */
class SelangorInvoiceController extends Controller
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


    public function actionUpload($state_id)
    {
            $model = new UploadInvoice();

        if ($model->load(Yii::$app->request->post())) {

            $connection = \Yii::$app->db;
            $delete = $connection->createCommand('DELETE FROM upload_invoice WHERE state_id = 13')->execute();


            $dir = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/uploads/invoiceselangor/';

            if(count(scandir($dir)) == 2) {

                $path = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/';

                $model->filename = UploadedFile::getInstance($model, 'filename');
                $model->filename->saveAs('uploads/invoiceselangor/' . $model->filename->baseName . '.' . $model->filename->extension);
                $model->filename = $model->filename->baseName . '.' . $model->filename->extension;
                $model->upload_by= Yii::$app->user->identity->id;
                $model->tarikh = date('d/m/Y');
                $model->state_id = $state_id;
                $model->entry = date("Y-m-d H:i:s");
                $model->excel_directory = $path.'uploads/invoiceselangor/';
                $model->save();

                $getFile = UploadInvoice::find()->orderBy(['id' => SORT_DESC,'state_id'=>13])->limit(1)->one();

                $excel_directory = $getFile['excel_directory'];
                $filename = $getFile['filename'];


            } else {

                $dirToDelete = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/uploads/invoiceselangor/*';

                $files = glob($dirToDelete); 
                foreach($files as $file){ // iterate files
                  if(is_file($file))
                    unlink($file); // delete file
                }

                $path = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/';

                $model->filename = UploadedFile::getInstance($model, 'filename');
                $model->filename->saveAs('uploads/invoiceselangor/' . $model->filename->baseName . '.' . $model->filename->extension);
                $model->filename = $model->filename->baseName . '.' . $model->filename->extension;
                $model->upload_by= Yii::$app->user->identity->id;
                $model->tarikh = date('d/m/Y');
                $model->state_id = $state_id;
                $model->entry = date("Y-m-d H:i:s");
                $model->excel_directory = $path.'uploads/invoiceselangor/';
                $model->save();

                $getFile = UploadInvoice::find()->orderBy(['id' => SORT_DESC,'state_id'=>13])->limit(1)->one();

                $excel_directory = $getFile['excel_directory'];
                $filename = $getFile['filename'];



            }

        $file = $excel_directory.$filename;

        $inputFile = $file;

        $connection = \Yii::$app->db;
        $delete = $connection->createCommand('DELETE FROM selangor_invoice')->execute();
        $alter = $connection->createCommand('ALTER TABLE selangor_invoice AUTO_INCREMENT = 1')->execute();


        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT * FROM selangor_invoice');
        $model = $sql->queryAll();

        if (empty($model)) {
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

                 
                        $excel = new SelangorInvoice();
                        $excel->date = $rowData[0][0];
                        $excel->ref_no = (string)$rowData[0][1];
                        $excel->item_no = (string)$rowData[0][2];
                        $excel->description = (string)$rowData[0][3];
                        $excel->quantity = (string)$rowData[0][4];
                        $excel->selling_price = (string)$rowData[0][5];
                        $excel->amount = (string)$rowData[0][6];
                        $excel->company_name = (string)$rowData[0][7];
                        $excel->agent = (string)$rowData[0][8];
                        $excel->status = (string)$rowData[0][9];


                        $excel->save();

                    }

                } 
                //die('Okay');
                 return $this->redirect(['index', 'state_id' => $state_id]);
        } else {
           $connection = \Yii::$app->db;
            $sql = $connection->createCommand('DELETE FROM selangor_invoice');
            $model = $sql->queryAll();
        } 

            return $this->redirect(['index', 'state_id' => $state_id]);

        } else {

            return $this->renderAjax('upload', ['model' => $model]);
        }
    }


    /**
     * Lists all SelangorInvoice models.
     * @return mixed
     */
    public function actionIndex($state_id)
    {
        $searchModel = new SelangorInvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'state_id' => $state_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAnnual($state_id)
    {
        $searchModel = new SelangorInvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('annual', [
            'state_id' => $state_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }




    /**
     * Displays a single SelangorInvoice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$state_id)
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Warranty::find()
                    ->where(['invoice_id'=>$id,'state_id'=>$state_id]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Creates a new SelangorInvoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SelangorInvoice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SelangorInvoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SelangorInvoice model.
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
     * Finds the SelangorInvoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SelangorInvoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SelangorInvoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }





}
