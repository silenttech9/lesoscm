<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\EventReg */

$this->title = 'Create Event Reg';
$this->params['breadcrumbs'][] = ['label' => 'Event Regs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-reg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
