<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quotations';
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
                  <b><?= Html::a('Create', ['create'], ['class' => 'btn blue-steel']) ?></b>
             
            </div>
            <br><br>
             <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        </div>

        <div class="portlet-body flip-scroll">
                    <?php Pjax::begin(); ?>    
                    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            //'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'datetime',
                                 [
                                    'label' => 'Customer',
                                    'attribute' => 'customer',
                                    'value' => 'customer.company_name'
                                 ],
                                 [
                                    'label' => 'Quotation No',
                                    'attribute' => 'quotation_no',
                                    'value' => function ($data){
                                            return $data->quotation_no.$data->revise;

                                    },
                                 ],

                                /*[
                                    'attribute'=>'tender',
                                    'format' => 'raw',
                                    'filter'=>array("Yes"=>"Yes","No"=>"No"),
                                    'value' => function ($model) {
                                                $var = ($model->tender == "Yes") ? "Yes" : "No";
                                                return $var;
                                      
                                           // return '<div>'.$model->id.' and other html-code</div>';
                                    },
                                ],*/
             [
                'label' => 'Quoted By',
                'attribute' => 'quoted',
                'value' => 'quoted.username'
             ],
             /*[
                'label' => 'Revise By',
                'attribute' => 'quoted',
                'value' => 'reviseby.username'
             ],

                                [
                                    'label' => 'STATUS',
                                    'format' => 'raw',
                                    'value' => function ($model) {

                                            if ($model->status == "Progress") {

                                                return "<span class='btn btn-xs yellow'>In Progress</span>";
                                                
                                            } else {

                                                return "<span class='btn btn-xs green-jungle'>Solve</span>";

                                            }
                                      
                                            
                                    },

                                ],*/


                                [
                                    'header' => 'Action',
                                    'class' => 'yii\grid\ActionColumn',
                                    'template'=>'{quotation}',
                                        'buttons' => [
                                            /*'stock' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-random"></i>',$url, [
                                                            'title' => 'Add Stock',
                                                            'class' => 'btn btn-circle btn-icon-only blue-chambray'

                                                ]);

                                            },

                                            'edit' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-edit"></i>',$url, [
                                                            'title' => 'Update',
                                                            'class' => 'btn btn-circle btn-icon-only blue-chambray'
                                                ]);
                                            },

                                            'info' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-file-text-o"></i>',$url, [
                                                            'title' => 'Quotation Info',
                                                            'class' => 'btn btn-circle btn-icon-only blue-chambray'
                                                ]);
                                            },*/
                                            'quotation' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-file-pdf-o"></i>',$url, [
                                                            'title' => 'View Quotation',
                                                            'class' => 'btn btn-circle btn-icon-only blue-chambray',

                                                ]);
                                            },

                                        ],
                                        'urlCreator' => function ($action, $model, $key, $index) {
                                            /*if ($action === 'stock') {
                                                $url = ['quotation-thailand/stock','id'=>$model->id];
                                                return $url;
                                            }
                                            if ($action === 'edit') {
                                                $url = ['quotation-thailand/update','id'=>$model->id];
                                                return $url;
                                            }
                                            if ($action === 'info') {
                                                $url = ['quotation-thailand/info','id'=>$model->id];
                                                return $url;
                                            }*/
                                            if ($action === 'quotation') {
                                                $url = ['quotation-thailand/quotation','id'=>$model->id,'country_id'=>3];
                                                return $url;
                                            }


                                        }
                                    ],




                            ],
                        'tableOptions' =>[
                            'class' => 'table table-bordered table-striped table-condensed flip-content',
                        ],


                        ]); ?>
                    <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>