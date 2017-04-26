<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\all\Telemarketing */

$this->title = 'View Details Message For : Telemarketing : '.$model->product->program_product;
$this->params['breadcrumbs'][] = ['label' => 'Telemarketings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="portlet light">

                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark"><?= Html::encode($this->title) ?></span>
                        </div>
                        <div class="actions">




                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                        </div>
                    </div>


                    <div class="portlet-body">



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


                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark">Customer</span>
                        </div>

                    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'customer.company_name',
                                'pic.name',

                                [
                                    'header' => 'Action',
                                    'class' => 'yii\grid\ActionColumn',
                                    'template'=>'{log}',
                                        'buttons' => [
                                            'log' => function ($url, $model) {
                                                return Html::a('<span class="btn btn-outline btn-circle btn-sm blue-madison"><i class="fa fa-file"></i> Log</span>',FALSE, $url, [
                                                            'title' => Yii::t('app', 'View'),
                                                ]);

                                            },

             

                                        ],
                                        'urlCreator' => function ($action, $model, $key, $index) {
                                            if ($action === 'log') {
                                                $url = ['value'=>Url::to(['telemarketing-history/view','id'=>$model->id]),'class'=>'customerLog'];
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