<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LookupAgent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lookup-agent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'agent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'handphone_no')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
