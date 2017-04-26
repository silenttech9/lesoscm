<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\thailand\models\CustomerPicSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-pic-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'department') ?>

    <?= $form->field($model, 'country_code_phone') ?>

    <?= $form->field($model, 'area_code_phone') ?>

    <?php // echo $form->field($model, 'telephone_no') ?>

    <?php // echo $form->field($model, 'extension') ?>

    <?php // echo $form->field($model, 'country_code_mobile') ?>

    <?php // echo $form->field($model, 'area_code_mobile') ?>

    <?php // echo $form->field($model, 'mobile_no') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <?php // echo $form->field($model, 'enter_by') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
