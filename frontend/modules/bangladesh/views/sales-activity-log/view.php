<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\all\SalesActivityLog */

$this->title = $model->enter->username;
$this->params['breadcrumbs'][] = ['label' => 'Sales Activity Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-activity-log-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'attribute' => 'Customer PIC',
                //'value' => 'customer.NAME',
                'value'=>$model->customer_pic_id ? $model->pic->name : null,
   
            ],


            'activity:ntext',
            'reminder',
            'reminder_time',
            'reminder_remark:ntext',
            'sales_visit',
            [
                'attribute' => 'Sales Specialist',
                //'value' => 'customer.NAME',
                'value'=>$model->sales_specialist_id ? $model->specialist->username : null,
   
            ],
            'sales_visit_date',
            'sales_visit_information:ntext',
            'quotation',
            [
                'attribute' => 'Sales Agent',
                //'value' => 'customer.NAME',
                'value'=>$model->sales_agent ? $model->sales->username : null,
   
            ],

            'remark',
        ],
    ]) ?>

</div>
