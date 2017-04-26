<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EventSurveyAnswer */

$this->title = 'Update Event Survey Answer: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Survey Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-survey-answer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
