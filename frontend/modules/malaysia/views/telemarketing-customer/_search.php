<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\TelemarketingCustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="telemarketing-customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'customer_pic_id') ?>

    <?= $form->field($model, 'activity') ?>

    <?= $form->field($model, 'sales_visit') ?>

    <?php // echo $form->field($model, 'sales_specialist_id') ?>

    <?php // echo $form->field($model, 'sales_visit_date') ?>

    <?php // echo $form->field($model, 'sales_visit_information') ?>

    <?php // echo $form->field($model, 'sales_agent') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'reminder') ?>

    <?php // echo $form->field($model, 'datetime') ?>

    <?php // echo $form->field($model, 'remark_reminder') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <?php // echo $form->field($model, 'enter_by') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <?php // echo $form->field($model, 'id_telemarketing') ?>

    <?php // echo $form->field($model, 'quotation') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
