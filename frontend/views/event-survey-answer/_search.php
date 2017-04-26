<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EventSurveyAnswerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-survey-answer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_question') ?>

    <?= $form->field($model, 'answer') ?>

    <?= $form->field($model, 'id_attendee') ?>

    <?= $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'event_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
