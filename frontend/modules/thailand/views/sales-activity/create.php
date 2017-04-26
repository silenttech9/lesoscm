<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\SalesActivity */

$this->title = 'Sales Activity';
$this->params['breadcrumbs'][] = ['label' => 'Sales Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    	'module_id' => $module_id,
        'model' => $model,
    ]) ?>

</div>
