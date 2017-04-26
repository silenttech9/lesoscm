<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\selangor\SelangorCustomerPic */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Selangor Customer Pics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="selangor-customer-pic-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'department',
            [
                'attribute' => 'Telephone No',
                //'value' => 'customer.NAME',
                'value'=>$model->country_code_phone.$model->area_code_phone.$model->telephone_no,
   
            ],
            'extension',
            [
                'attribute' => 'Mobile No',
                //'value' => 'customer.NAME',
                'value'=>$model->country_code_mobile.$model->area_code_mobile.$model->mobile_no,
   
            ],
            'email:email',
        ],
    ]) ?>

</div>
