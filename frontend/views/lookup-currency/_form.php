<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LookupCurrency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lookup-currency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currency_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn blue-steel' : 'btn blue-steel']) ?>    </div>

    <?php ActiveForm::end(); ?>

</div>
