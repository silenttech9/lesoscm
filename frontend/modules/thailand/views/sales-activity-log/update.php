<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\all\SalesActivityLog */

$this->title = 'Update Activity Log';
$this->params['breadcrumbs'][] = ['label' => 'Sales Activity Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-activity-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mdl' => $mdl,
    ]) ?>

</div>
