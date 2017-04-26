<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LookupDelivery */

$this->title = 'Update : ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lookup-delivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
