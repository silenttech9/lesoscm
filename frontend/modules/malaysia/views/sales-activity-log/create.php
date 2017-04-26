<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\SalesActivityLog */

$this->title = 'Create Sales Activity Log';
$this->params['breadcrumbs'][] = ['label' => 'Sales Activity Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-activity-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
