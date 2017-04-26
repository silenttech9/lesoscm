<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\thailand\models\TelemarketingHistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="telemarketing-history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'history')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>

    <?= $form->field($model, 'enter_by')->textInput() ?>

    <?= $form->field($model, 'update_by')->textInput() ?>

    <?= $form->field($model, 'id_telemarketing_customer')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
