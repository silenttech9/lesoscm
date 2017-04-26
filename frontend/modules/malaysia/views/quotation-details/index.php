<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quotation Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-details-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Quotation Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'stock_id',
            'extra_description',
            'quantity',
            'unit',
            // 'price',
            // 'quotation_id',
            // 'temp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
