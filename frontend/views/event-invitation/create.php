<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\EventInvitation */

$this->title = 'Create Event Invitation';
$this->params['breadcrumbs'][] = ['label' => 'Event Invitations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-invitation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
