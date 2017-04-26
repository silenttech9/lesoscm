<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\EventRegParticipant */

$this->title = 'Create Event Reg Participant';
$this->params['breadcrumbs'][] = ['label' => 'Event Reg Participants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-reg-participant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
