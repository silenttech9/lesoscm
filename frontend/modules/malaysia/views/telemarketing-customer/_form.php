<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\TelemarketingCustomer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="telemarketing-customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'customer_pic_id')->textInput() ?>

    <?= $form->field($model, 'activity')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sales_visit')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'sales_specialist_id')->textInput() ?>

    <?= $form->field($model, 'sales_visit_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales_visit_information')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sales_agent')->textInput() ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'reminder')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'datetime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark_reminder')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>

    <?= $form->field($model, 'enter_by')->textInput() ?>

    <?= $form->field($model, 'update_by')->textInput() ?>

    <?= $form->field($model, 'id_telemarketing')->textInput() ?>

    <?= $form->field($model, 'quotation')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
