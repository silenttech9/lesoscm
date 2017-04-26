<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\CustomerPicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Pics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-pic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customer Pic', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'department',
            'country_code_phone',
            'area_code_phone',
            // 'telephone_no',
            // 'extension',
            // 'country_code_mobile',
            // 'area_code_mobile',
            // 'mobile_no',
            // 'email:email',
            // 'customer_id',
            // 'date_create',
            // 'date_update',
            // 'enter_by',
            // 'update_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
