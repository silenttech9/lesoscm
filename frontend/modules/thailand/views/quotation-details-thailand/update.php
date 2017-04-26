<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\thailand\models\QuotationDetailsThailand */

$this->title = 'Update Quotation Details Thailand: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Quotation Details Thailands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="quotation-details-thailand-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
