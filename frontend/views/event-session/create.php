<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\EventSession */

$this->title = 'Create Event Session';
$this->params['breadcrumbs'][] = ['label' => 'Event Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-session-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
