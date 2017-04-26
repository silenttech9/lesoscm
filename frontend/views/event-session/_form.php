<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TimePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\EventSession */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-session-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'time')->widget(TimePicker::classname(), ['class'=>'form-control time-picker'])->label(); ?>

    <?= $form->field($model, 'activity')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update Session', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
