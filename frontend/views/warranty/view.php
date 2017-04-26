<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Warranty */

$this->title = $invoice->ref_no;
$this->params['breadcrumbs'][] = ['label' => 'Warranties', 'url' => ['index']];
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
                    'model' => $invoice,
                    'attributes' => [
                        'ref_no',
                        'date',
                        'item_no',
                        'description',
                        'quantity',
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
                <div class="caption">

                </div>

            </div>
            <div class="portlet-body">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'serial_number',
                            'delivery_date',
                             [
                                'label' => 'Service Required',
                                'format' => 'raw',
                                'value' => function ($data){
                                    if ($data->service_required == "Yes") {

                                        return "<span class='btn btn-xs green-jungle'>".$data->service_required."</span>";

                                    } else if ($data->service_required == "") {

                                        return "";

                                    } else {

                                        return "<span class='btn btn-xs red'>".$data->service_required."</span>";
                                    }
                                        

                                },
                             ],
                             [
                                'label' => 'Reminder',
                                'format' => 'raw',
                                'value' => function ($data){
                                    if ($data->reminder == "Yes") {

                                        return "<span class='btn btn-xs green-jungle'>".$data->reminder."</span>";

                                    } else if ($data->reminder == "") {

                                        return "";

                                    } else {

                                        return "<span class='btn btn-xs red'>".$data->reminder."</span>";
                                    }
                                        

                                },
                             ],
                             [
                                'label' => 'Machine End of Life',
                                'format' => 'raw',
                                'value' => function ($data){
                                    if ($data->machine_end_of_life == "Yes") {

                                        return "<span class='btn btn-xs green-jungle'>".$data->machine_end_of_life."</span>";

                                    } else if ($data->machine_end_of_life == "") {

                                        return "";

                                    } else {

                                        return "<span class='btn btn-xs red'>".$data->machine_end_of_life."</span>";
                                    }
                                        

                                },
                             ],

                            [
                                'header' => 'ACTION',
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{edit}',
                                    'buttons' => [
                                        'edit' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-edit"></i>',FALSE, $url);
                                        },

                                    ],
                                    'urlCreator' => function ($action, $model, $key, $index) {
                                        if ($action === 'edit') {
                                            $url = ['value'=>Url::to(['/warranty/action','id'=>$model->id,'state_id'=>$model->state_id]),'class'=>'btn btn-circle btn-icon-only blue-chambray update','title'=>'Edit'];
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
