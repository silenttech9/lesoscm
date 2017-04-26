<?php

use yii\helpers\Html;
//use kartik\export\ExportMenu;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\JohorInvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Warranty';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="portlet light ">


        <div class="portlet-title">

            <div class="caption">
                <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
            </div>
            <div class="actions">
                <b><?php /* Html::a('<i class="fa fa-upload"></i>',FALSE, ['value'=>Url::to(['johor-invoice/upload','state_id'=>$state_id]),'class' => 'uploadExcel btn btn-circle btn-icon-only blue-chambray','id'=>'uploadExcel','title' => 'Upload',]) */ ?></b>
                 
             
            </div>
            <br><br>
             <?php echo $this->render('_search', ['model' => $searchModel,'state_id'=>$state_id]); ?>

        </div>

        <div class="portlet-body flip-scroll">
                <?php


               /* $gridColumns = [
                    ['class' => 'kartik\grid\SerialColumn'],
                        'date',
                        'ref_no',
                        'item_no',
                        'description',
                        'quantity',
                        'selling_price',
                        'amount',
                        'company_name',
                        'agent',
                         [
                            'label' => 'Status',
                            'format' => 'raw',
                            'value' => function ($data){
                                if ($data->status == "Updated") {

                                    return "<span class='btn btn-xs green-jungle'>".$data->status."</span>";

                                } else if ($data->status == "") {

                                    return "";

                                } else {

                                    return "<span class='btn btn-xs red'>".$data->status."</span>";
                                }
                                    

                            },
                         ],
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{view}  {warranty}',
                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-file-o"></i>',$url, [
                                                    'title' => 'View',
                                                    'class' => 'btn btn-circle btn-icon-only blue-chambray'

                                        ]);

                                    },

                                    'warranty' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-edit"></i>',$url, [
                                                    'title' => 'Add Warranty',
                                                    'class' => 'btn btn-circle btn-icon-only blue-chambray'
                                        ]);
                                    },


                                ],
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'view') {
                                        $url = ['view','id'=>$model->id,'state_id'=>22];
                                        return $url;
                                    }
                                    if ($action === 'warranty') {
                                        $url = ['/warranty/create','id'=>$model->id,'state_id'=>22];
                                        return $url;
                                    }

                                }
                        ],
                          
                ];

                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'columnSelectorOptions'=>[
                        'label' => 'Cols...',
                    ],
                    'selectedColumns'=> [1, 2, 3, 4, 5,6,7,8,9,10],
                    //'noExportColumns'=>[9],
                    'fontAwesome' => true,
                    'dropdownOptions' => [
                        'label' => 'Export All',
                        'class' => 'btn btn-default'
                    ]
                ]) . "<hr>\n".
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'pager' => [
                        'firstPageLabel' => 'First',
                        'lastPageLabel'  => 'Last'
                    ],
                ]);

                */ ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'date',
                        'ref_no',
                        'item_no',
                        //'description',
                        'quantity',
                        'selling_price',
                        'amount',
                        'company_name',
                        //'agent',
                         [
                            'label' => 'Status',
                            'format' => 'raw',
                            'value' => function ($data){
                                if ($data->status == "Updated") {

                                    return "<span class='btn btn-xs green-jungle'>".$data->status."</span>";

                                } else if ($data->status == "") {

                                    return "";

                                } else {

                                    return "<span class='btn btn-xs red'>".$data->status."</span>";
                                }
                                    

                            },
                         ],
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{view} {warranty}',
                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-file-o"></i>',$url, [
                                                    'title' => 'View',
                                                    'class' => 'btn btn-circle btn-icon-only blue-chambray'

                                        ]);

                                    },

                                    'warranty' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-edit"></i>',$url, [
                                                    'title' => 'Add Warranty',
                                                    'class' => 'btn btn-circle btn-icon-only blue-chambray'
                                        ]);
                                    },


                                ],
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'view') {
                                        $url = ['view','id'=>$model->id,'state_id'=>Yii::$app->request->get('state_id')];
                                        return $url;
                                    }
                                    if ($action === 'warranty') {
                                        $url = ['/warranty/create','id'=>$model->id,'state_id'=>Yii::$app->request->get('state_id')];
                                        return $url;
                                    }

                                }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>