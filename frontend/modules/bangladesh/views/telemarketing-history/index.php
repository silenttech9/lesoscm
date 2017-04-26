<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Telemarketing Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telemarketing-history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Telemarketing History', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'history:ntext',
            'date_create',
            'date_update',
            'enter_by',
            // 'update_by',
            // 'id_telemarketing_customer',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
