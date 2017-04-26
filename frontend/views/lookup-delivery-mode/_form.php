<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LookupDeliveryMode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lookup-delivery-mode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'delivery_type')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn blue-steel' : 'btn blue-steel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
