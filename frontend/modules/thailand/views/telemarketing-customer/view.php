<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\thailand\models\TelemarketingCustomer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Telemarketing Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telemarketing-customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_id',
            'customer_pic_id',
            'activity:ntext',
            'sales_visit',
            'sales_specialist_id',
            'sales_visit_date',
            'sales_visit_information:ntext',
            'sales_agent',
            'remark:ntext',
            'reminder',
            'datetime',
            'remark_reminder:ntext',
            'date_create',
            'date_update',
            'enter_by',
            'update_by',
            'id_telemarketing',
            'quotation',
        ],
    ]) ?>

</div>
