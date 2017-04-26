<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\QuotationDetails */

$this->title = 'Create Quotation Details';
$this->params['breadcrumbs'][] = ['label' => 'Quotation Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-details-create">

<div class="col-lg-8 col-xs-8 col-sm-8">
	
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


</div>

<div class="col-lg-4 col-xs-4 col-sm-4">
	
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


</div>


</div>
