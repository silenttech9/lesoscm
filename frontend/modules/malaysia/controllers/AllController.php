<?php

namespace frontend\modules\malaysia\controllers;

use Yii;
use frontend\modules\malaysia\models\JohorStockSearch;
use frontend\modules\malaysia\models\SelangorStockSearch;
use frontend\modules\malaysia\models\PenangStockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UploadExcel;


class AllController extends Controller
{


    public function actionIndex()
    {


        $searchModel_selangor = new SelangorStockSearch();
        $dataProvider_selangor = $searchModel_selangor->search(Yii::$app->request->queryParams);
        $model_s = UploadExcel::find()->where(['state_id'=>13])->one();

        $searchModel_johor = new JohorStockSearch();
        $dataProvider_johor = $searchModel_johor->search(Yii::$app->request->queryParams);
        $model_j = UploadExcel::find()->where(['state_id'=>22])->one();

        $searchModel_penang = new PenangStockSearch();
        $dataProvider_penang = $searchModel_penang->search(Yii::$app->request->queryParams);
        $model_p = UploadExcel::find()->where(['state_id'=>23])->one();

        return $this->render('index',[
            'searchModel_johor' => $searchModel_johor,
            'dataProvider_johor' => $dataProvider_johor,
            'searchModel_selangor' => $searchModel_selangor,
            'dataProvider_selangor' => $dataProvider_selangor,
            'searchModel_penang' => $searchModel_penang,
            'dataProvider_penang' => $dataProvider_penang,
            'model_s' => $model_s,
            'model_j' => $model_j,
            'model_p' => $model_p,


            ]);
    }


}