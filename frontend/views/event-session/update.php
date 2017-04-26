<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EventSession */

$this->title = 'Update Event Session: ' . $model->activity;
$this->params['breadcrumbs'][] = ['label' => 'Event Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-session-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
