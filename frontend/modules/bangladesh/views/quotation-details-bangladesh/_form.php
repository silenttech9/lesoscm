<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\thailand\models\QuotationDetailsThailand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quotation-details-thailand-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stock_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extra_description')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'unit')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quotation_id')->textInput() ?>

    <?= $form->field($model, 'temp')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
