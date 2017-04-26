<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LookupDeliveryMode */

$this->title = 'Update Lookup Delivery Mode: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Delivery Modes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lookup-delivery-mode-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
