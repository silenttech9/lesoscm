<?php

namespace frontend\modules\thailand\controllers;

use Yii;
use frontend\modules\thailand\models\ThailandStock;
use frontend\modules\thailand\models\ThailandStockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UploadExcel;
use yii\web\UploadedFile;
/**
 * ThailandStockController implements the CRUD actions for ThailandStock model.
 */
class ThailandStockController extends Controller
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

    public function actionUpload($country_id)
    {
            $model = new UploadExcel();

        if ($model->load(Yii::$app->request->post())) {

            $connection = \Yii::$app->db;
            $delete = $connection->createCommand('DELETE FROM upload_excel WHERE country_id = 3')->execute();


            $dir = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/uploads/thailand/';

            if(count(scandir($dir)) == 2) {

                $path = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/';

                $model->filename = UploadedFile::getInstance($model, 'filename');
                $model->filename->saveAs('uploads/thailand/' . $model->filename->baseName . '.' . $model->filename->extension);
                $model->filename = $model->filename->baseName . '.' . $model->filename->extension;
                $model->upload_by= Yii::$app->user->identity->id;
                $model->tarikh = date('d/m/Y');
                $model->country_id = $country_id;
                $model->entry = date("Y-m-d H:i:s");
                $model->excel_directory = $path.'uploads/thailand/';
                $model->save();

                $getFile = UploadExcel::find()->orderBy(['id' => SORT_DESC,'country_id'=>3])->limit(1)->one();

                $excel_directory = $getFile['excel_directory'];
                $filename = $getFile['filename'];


            } else {

                $dirToDelete = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/uploads/thailand/*';

                $files = glob($dirToDelete);
                foreach($files as $file){ // iterate files
                  if(is_file($file))
                    unlink($file); // delete file
                }

                $path = $_SERVER['DOCUMENT_ROOT'].'/lscm/frontend/web/';

                $model->filename = UploadedFile::getInstance($model, 'filename');
                $model->filename->saveAs('uploads/thailand/' . $model->filename->baseName . '.' . $model->filename->extension);
                $model->filename = $model->filename->baseName . '.' . $model->filename->extension;
                $model->upload_by= Yii::$app->user->identity->id;
                $model->tarikh = date('d/m/Y');
                $model->country_id = $country_id;
                $model->entry = date("Y-m-d H:i:s");
                $model->excel_directory = $path.'uploads/thailand/';
                $model->save();

                $getFile = UploadExcel::find()->orderBy(['id' => SORT_DESC,'country_id'=>3])->limit(1)->one();

                $excel_directory = $getFile['excel_directory'];
                $filename = $getFile['filename'];



            }

        $file = $excel_directory.$filename;

        $inputFile = $file;

        $connection = \Yii::$app->db;
        $delete = $connection->createCommand('DELETE FROM thailand_stock')->execute();
        $alter = $connection->createCommand('ALTER TABLE thailand_stock AUTO_INCREMENT = 1')->execute();


        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT * FROM thailand_stock');
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


                        $excel = new ThailandStock();
                        $excel->ITEM_NO = $rowData[0][0];
                        $excel->DESCRIPTION = (string)$rowData[0][1].(string)$rowData[0][2];
                        $excel->BAL = (string)$rowData[0][3];
                        $excel->save();

                    }

                }
                //die('Okay');
                 return $this->redirect(['index', 'country_id' => $country_id]);
        } else {
           $connection = \Yii::$app->db;
            $sql = $connection->createCommand('DELETE FROM thailand_stock');
            $model = $sql->queryAll();
        }

           Yii::$app->getSession()->setFlash('uploadSelangor', 'Data Successful Upload');
            return $this->redirect(['index', 'country_id' => $country_id]);

        } else {

            return $this->renderAjax('upload', ['model' => $model]);
        }
    }





    /**
     * Lists all ThailandStock models.
     * @return mixed
     */
    public function actionIndex($country_id)
    {
        $searchModel = new ThailandStockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = UploadExcel::find()->where(['country_id'=>$country_id])->one();

        return $this->render('index', [
            'model' => $model,
            'country_id'=> $country_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ThailandStock model.
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
     * Creates a new ThailandStock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ThailandStock();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ThailandStock model.
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
     * Deletes an existing ThailandStock model.
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
     * Finds the ThailandStock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ThailandStock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ThailandStock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
