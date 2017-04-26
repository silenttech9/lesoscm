<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\WarrantySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Warranties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warranty-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Warranty', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'serial_number',
            'warranty_period',
            'delivery_mode_id',
            'delivery_date',
            // 'consignment_number',
            // 'update_customer',
            // 'machine_end_of_life',
            // 'service_required',
            // 'reminder',
            // 'day_for_services',
            // 'status_services',
            // 'date_create',
            // 'date_update',
            // 'enter_by',
            // 'update_by',
            // 'invoice_id',
            // 'customer_id',
            // 'customer_pic_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
