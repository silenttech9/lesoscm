<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EventInvitation */

$this->title = 'Update Event Invitation: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Event Invitations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-invitation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
