<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\thailand\models\CustomerPicSearch */
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
<?php Pjax::begin(); ?>    <?= GridView::widget([
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
<?php Pjax::end(); ?></div>
