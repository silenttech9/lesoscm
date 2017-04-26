<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\SalesActivityLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Activity Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-activity-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sales Activity Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_pic_id',
            'activity:ntext',
            'reminder',
            'reminder_time',
            // 'reminder_remark:ntext',
            // 'sales_visit',
            // 'sales_specialist_id',
            // 'sales_visit_date',
            // 'sales_visit_information:ntext',
            // 'quotation',
            // 'sales_agent',
            // 'remark:ntext',
            // 'date_create',
            // 'date_update',
            // 'enter_by',
            // 'update_by',
            // 'id_sales_activity',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
