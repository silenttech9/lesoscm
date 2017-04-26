<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\EventSurveyAnswer */

$this->title = 'Create Event Survey Answer';
$this->params['breadcrumbs'][] = ['label' => 'Event Survey Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-survey-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
