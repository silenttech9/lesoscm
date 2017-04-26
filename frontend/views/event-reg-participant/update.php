<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EventRegParticipant */

$this->title = 'Update Event Reg Participant: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Reg Participants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-reg-participant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
