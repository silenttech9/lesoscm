<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WarrantySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warranty-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'serial_number') ?>

    <?= $form->field($model, 'warranty_period') ?>

    <?= $form->field($model, 'delivery_mode_id') ?>

    <?= $form->field($model, 'delivery_date') ?>

    <?php // echo $form->field($model, 'consignment_number') ?>

    <?php // echo $form->field($model, 'update_customer') ?>

    <?php // echo $form->field($model, 'machine_end_of_life') ?>

    <?php // echo $form->field($model, 'service_required') ?>

    <?php // echo $form->field($model, 'reminder') ?>

    <?php // echo $form->field($model, 'day_for_services') ?>

    <?php // echo $form->field($model, 'status_services') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <?php // echo $form->field($model, 'enter_by') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <?php // echo $form->field($model, 'invoice_id') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'customer_pic_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
