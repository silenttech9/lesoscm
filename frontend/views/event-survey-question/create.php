<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\EventSurveyQuestion */

$this->title = 'Create Event Survey Question';
$this->params['breadcrumbs'][] = ['label' => 'Event Survey Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-survey-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
