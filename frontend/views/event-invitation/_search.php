<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EventInvitationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-invitation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'company_name') ?>

    <?= $form->field($model, 'address_1') ?>

    <?= $form->field($model, 'address_2') ?>

    <?php // echo $form->field($model, 'address_3') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'event_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'enter_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
