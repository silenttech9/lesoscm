<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\all\Telemarketing */

$this->title = 'Edit : '.$model->product->program_product;
$this->params['breadcrumbs'][] = ['label' => 'Telemarketings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="actions">

                    <b><?= Html::a('Edit',FALSE, ['value'=>Url::to(['telemarketing/update','id'=>$model->id]),'class' => 'btn blue-steel update','id'=>'update','title' => 'Edit']) ?></b>

                 
                </div>

            </div>
            <div class="portlet-body">

                        <div class="panel panel-primary" id="show-customer">
                            <div class="panel-heading">
                                <h3 class="panel-title">Customer</h3>

                            </div>
                            <div class="panel-body"> <?= $this->render('customer', ['model2'=> $model2,'state_id'=>$model->state_id] ); ?> </div>
                        </div>

                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'datetime',
                                [
                                    'attribute' => 'Program / Product',
                                    //'value' => 'customer.NAME',
                                    'value'=>$model->program_product_id ? $model->product->program_product : null,
                       
                                ],
                                [
                                    'attribute' => 'Telemarketers',
                                    'value'=>$model->telemarketers_id ? $model->telemarket->username : null,
                                ],
                                [
                                    'attribute' => 'State',
                                    'value'=>$model->state_id ? $model->state->state : null,
                                ],
                            ],
                        ]) ?>


            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">

                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase">CUSTOMER</span>
                </div>
            </div>
            <div class="portlet-body">

                    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                [
                                    'attribute' => 'Customer',
                                    'value'=> 'customer.company_name',
                                ],
                                [
                                    'attribute' => 'Customer PIC',
                                    'value'=> 'pic.name',
                                ],


                                [
                                    'header' => 'Action',
                                    'class' => 'yii\grid\ActionColumn',
                                    'template'=>'{log}   {edit}',
                                        'buttons' => [
                                            'log' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-history"></i>',FALSE, $url);

                                            },
                                           'edit' => function ($url, $model) {
                                                    return Html::a('<i class="fa fa-edit"></i>',$url, [
                                                                'title' => 'Update',
                                                                'class' => 'btn btn-circle btn-icon-only blue-chambray'
                                                    ]);
                                                },
             

                                        ],
                                        'urlCreator' => function ($action, $model, $key, $index) {
                                            if ($action === 'log') {
                                                $url = ['value'=>Url::to(['/malaysia/telemarketing-history/view','id'=>$model->id]),'class'=>'customerLog btn btn-circle btn-icon-only blue-chambray','title'=>'Log History'];
                                                return $url;
                                            }
                                            if ($action === 'edit') {
                                                $url = ['telemarketing/change','id'=>$model->id];
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
