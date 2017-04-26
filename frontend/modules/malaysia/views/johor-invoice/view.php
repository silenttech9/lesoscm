<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\PenangInvoice */

$this->title = $model->ref_no;
$this->params['breadcrumbs'][] = ['label' => 'Johor Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-5 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="actions">
                    
                </div>
            </div>
            <div class="portlet-body">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'date',
                        'ref_no',
                        'item_no',
                        'description',
                        'quantity',
                        //'selling_price',
                        //'amount',
                        'company_name',
                        'agent',
                    ],
                ]) ?>

            </div>

        </div>
    </div>

    <div class="col-lg-7 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">


            </div>
            <div class="portlet-body">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'serial_number',
                            'delimode.delivery_type',
                            'delivery_date',
                            'consignment_number',
                            'custpic.name',
                            'update_customer',
                            [
                                'header' => 'ACTION',
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{edit}   {delete}',
                                    'buttons' => [
                                        'edit' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-edit"></i>',FALSE, $url);
                                        },
                                        'delete' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-trash-o"></i>',$url, [
                                                        'title' => 'Delete',
                                                        'data-confirm'=>"Are You Sure Want To Delete This Item ?",
                                                        'data-method' => 'post',
                                                        'class' => 'btn btn-circle btn-icon-only blue-chambray'
                                            ]);

                                        },



                                    ],
                                    'urlCreator' => function ($action, $model, $key, $index) {
                                        if ($action === 'edit') {
                                            $url = ['value'=>Url::to(['/warranty/update','id'=>$model->id,'state_id'=>$model->state_id]),'class'=>'btn btn-circle btn-icon-only blue-chambray update','title'=>'Edit'];
                                            return $url;
                                        }
                                        if ($action === 'delete') {
                                            $url = ['/warranty/delete','id'=>$model->id,'state_id'=>$model->state_id,'invoice_id'=>$model->invoice_id];
                                            return $url;
                                        }



                                    }
                                ],

                        ],
                        'tableOptions' =>[
                            'class' => 'table table-bordered table-striped table-condensed flip-content',
                        ],
                    ]); ?>


            </div>

        </div>
    </div>


</div>