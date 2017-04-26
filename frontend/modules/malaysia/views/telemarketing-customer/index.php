<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\TelemarketingCustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Telemarketing Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telemarketing-customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Telemarketing Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_id',
            'customer_pic_id',
            'activity:ntext',
            'sales_visit',
            // 'sales_specialist_id',
            // 'sales_visit_date',
            // 'sales_visit_information:ntext',
            // 'sales_agent',
            // 'remark:ntext',
            // 'reminder',
            // 'datetime',
            // 'remark_reminder:ntext',
            // 'date_create',
            // 'date_update',
            // 'enter_by',
            // 'update_by',
            // 'id_telemarketing',
            // 'quotation',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
