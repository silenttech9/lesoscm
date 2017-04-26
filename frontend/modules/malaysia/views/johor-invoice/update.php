<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\JohorInvoice */

$this->title = 'Update Johor Invoice: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Johor Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="johor-invoice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
