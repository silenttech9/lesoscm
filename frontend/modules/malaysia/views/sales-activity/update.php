<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\SalesActivity */

$this->title = 'Sales Activity: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-activity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    	'state_id' => $state_id,
        'model' => $model,
    ]) ?>

</div>
