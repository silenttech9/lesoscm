<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LookupStax */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lookup-stax-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESC2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESC')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn blue-steel' : 'btn blue-steel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
