<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\PenangStock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penang-stock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ITEM_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCRIPTION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LOCATION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UNIT_COST')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TOTAL_COST')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
