<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\SelangorInvoice */

$this->title = 'Update Selangor Invoice: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Selangor Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="selangor-invoice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
