<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\all\SalesActivity */

$this->title = 'View Details Message For : Sales Activity : '.$model->customer->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Sales Activities', 'url' => ['index']];
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
                'attribute' => 'Customer',
                //'value' => 'customer.NAME',
                'value'=>$model->customer_id ? $model->customer->company_name : null,
   
            ],



        ],
    ]) ?>

<div class="caption">
    <span class="caption-subject bold uppercase font-dark">Sales Activity</span>
</div>
<br>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'activity:ntext',
             [
                'label' => 'Customer PIC',
                'value' => 'pic.name'
             ],

            
            //'reminder',
            //'reminder_time',
            //'reminder_remark:ntext',
            // 'sales_visit',
            // 'sales_specialist_id',
            // 'sales_visit_date',
            // 'sales_visit_information:ntext',
            // 'quotation',
            // 'sales_agent',
            // 'remark',
            // 'date_create',
            // 'date_update',
             [
                'label' => 'Agent',
                'value' => 'enter.username'
             ],
             'date_create',

            // 'id_sales_activity',
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="btn btn-outline btn-circle btn-sm purple-plum"><i class="fa fa-file"></i> View</span>',FALSE, $url, [
                                        'title' => Yii::t('app', 'View'),
                            ]);

                        },


                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            $url = ['value'=>Url::to(['sales-activity-log/view','id'=>$model->id]),'class'=>'activityView'];
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