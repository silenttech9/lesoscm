<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\SelangorInvoice */

$this->title = 'Create Selangor Invoice';
$this->params['breadcrumbs'][] = ['label' => 'Selangor Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="selangor-invoice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
