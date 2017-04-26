<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\Quotation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Quotations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-view">

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
            'datetime',
            'customer_id',
            'customer_ship_id',
            'agent_id',
            'tax_code_id',
            'area_code_id',
            'currency_id',
            'remark:ntext',
            'date_create',
            'date_update',
            'enter_by',
            'update_by',
            'quotation_no',
            'revise',
            'revise_id',
            'date_revise',
            'validity_id',
            'delivery_id',
            'tender',
            'tender_id',
            'tender_visible',
            'cc_customer_ship_id',
            'state_id',
            'status',
            'discount',
        ],
    ]) ?>

</div>
