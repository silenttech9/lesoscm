<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Quotation Infomation : ' .$model->quotation_no.''.$model->revise;
$this->params['breadcrumbs'][] = ['label' => 'Quotations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-5 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>

            </div>
            <div class="portlet-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'datetime',
           /* [
                'attribute' => 'Customer',
                'value'=>$model->customer_id ? $model->customer->company_name : null,
            ],
            [
                'attribute' => 'Attension',
                //'value' => 'customer.NAME',
                'value'=>$model->customer_ship_id ? $model->attension->name : null,
   
            ],
            [
                'attribute' => 'Cc',
                //'value' => 'customer.NAME',
                'value'=>$model->cc_customer_ship_id ? $model->cc->name : null,

            ],
            [
                'label' => 'Sales Agent',
                //'value' => 'customer.NAME',
                'value'=>$model->agent_id ? $model->agent->agent : null,

            ],
            [
                'label' => 'Quoted By',
                //'value' => 'customer.NAME',
                'value'=>$model->enter_by ? $model->quoted->username : null,

            ], 
            'tax.CODE',
            'area.area',
            'currency.currency_code',
            'remark:html',
            'validity.validity',
            'delivery.delivery',*/
            'tenders.tender',
            'tender_visible',
            [
                'label' => 'Discount (RM)',
                //'value' => 'customer.NAME',
                'value'=>$model->discount,

            ], 
        ],
    ]) ?>




            </div>
        </div>
    </div>
    <div class="col-lg-7 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase">List Of Quotation</span>
                </div>
                <div class="actions">

                 
                </div>
            </div>
            <div class="portlet-body">

    <?= GridView::widget([
        'dataProvider' => $revise,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'quotation_no',
            'date_create',
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{print}',
                    'buttons' => [
                        'print' => function ($url, $model) {
                            return Html::a('<i class="fa fa-print"></i>',$url, [
                                        'title' => 'Print',
                                        'target'=>'_blank',
                                        'class' => 'btn btn-circle btn-icon-only blue-chambray'
                            ]);

                        },




                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'print') {
                            $url = ['quotation/pdfq','id'=>$model->id];
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


