<?php

namespace frontend\modules\malaysia\controllers;

use Yii;
use frontend\modules\malaysia\models\SelangorStock;
use frontend\modules\malaysia\models\SelangorStockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UploadExcel;
use yii\web\UploadedFile;
/**
 * SelangorStockController implements the CRUD actions for SelangorStock model.
 */
class SelangorStockController extends Controller
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
            $model = new UploadExcel();

        if ($model->load(Yii::$app->request->post())) {

            $connection = \Yii::$app->db;
            $delete = $connection->createCommand('DELETE FROM upload_excel WHERE state_id = 13')->execute();


            $dir = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/uploads/selangor/';

            if(count(scandir($dir)) == 2) {

                $path = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/';

                $model->filename = UploadedFile::getInstance($model, 'filename');
                $model->filename->saveAs('uploads/selangor/' . $model->filename->baseName . '.' . $model->filename->extension);
                $model->filename = $model->filename->baseName . '.' . $model->filename->extension;
                $model->upload_by= Yii::$app->user->identity->id;
                $model->tarikh = date('d/m/Y');
                $model->state_id = $state_id;
                $model->entry = date("Y-m-d H:i:s");
                $model->excel_directory = $path.'uploads/selangor/';
                $model->save();

                $getFile = UploadExcel::find()->orderBy(['id' => SORT_DESC,'state_id'=>13])->limit(1)->one();

                $excel_directory = $getFile['excel_directory'];
                $filename = $getFile['filename'];


            } else {

                $dirToDelete = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/uploads/selangor/*';

                $files = glob($dirToDelete); 
                foreach($files as $file){ // iterate files
                  if(is_file($file))
                    unlink($file); // delete file
                }

                $path = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/';

                $model->filename = UploadedFile::getInstance($model, 'filename');
                $model->filename->saveAs('uploads/selangor/' . $model->filename->baseName . '.' . $model->filename->extension);
                $model->filename = $model->filename->baseName . '.' . $model->filename->extension;
                $model->upload_by= Yii::$app->user->identity->id;
                $model->tarikh = date('d/m/Y');
                $model->state_id = $state_id;
                $model->entry = date("Y-m-d H:i:s");
                $model->excel_directory = $path.'uploads/selangor/';
                $model->save();

                $getFile = UploadExcel::find()->orderBy(['id' => SORT_DESC,'state_id'=>13])->limit(1)->one();

                $excel_directory = $getFile['excel_directory'];
                $filename = $getFile['filename'];



            }

        $file = $excel_directory.$filename;

        $inputFile = $file;

        $connection = \Yii::$app->db;
        $delete = $connection->createCommand('DELETE FROM selangor_stock')->execute();
        $alter = $connection->createCommand('ALTER TABLE selangor_stock AUTO_INCREMENT = 1')->execute();


        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT * FROM selangor_stock');
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

                 
                        $excel = new SelangorStock();
                        $excel->ITEM_NO = $rowData[0][0];
                        $excel->DESCRIPTION = (string)$rowData[0][1].(string)$rowData[0][2];
                        $excel->BAL = (string)$rowData[0][3];
                        $excel->save();

                    }

                } 
                //die('Okay');
                 return $this->redirect(['index', 'state_id' => $state_id]);
        } else {
           $connection = \Yii::$app->db;
            $sql = $connection->createCommand('DELETE FROM selangor_stock');
            $model = $sql->queryAll();
        } 

           Yii::$app->getSession()->setFlash('uploadSelangor', 'Data Successful Upload');
            return $this->redirect(['index', 'state_id' => $state_id]);

        } else {

            return $this->renderAjax('upload', ['model' => $model]);
        }
    }




    /**
     * Lists all SelangorStock models.
     * @return mixed
     */
    public function actionIndex($state_id)
    {
        $searchModel = new SelangorStockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = UploadExcel::find()->where(['state_id'=>$state_id])->one();

        return $this->render('index', [
            'state_id'=> $state_id,
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SelangorStock model.
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
     * Creates a new SelangorStock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SelangorStock();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SelangorStock model.
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
     * Deletes an existing SelangorStock model.
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
     * Finds the SelangorStock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SelangorStock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SelangorStock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
