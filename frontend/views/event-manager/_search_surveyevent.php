<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['survey_event'],
        'method' => 'get',
    ]); ?>

    <div class="search-page search-content-2">
        <div class="search-bar ">
            <div class="col-md-11">
            <div class="input-group">

                <input type="text" name="EventManagerSearch[globalSearch]" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <?= Html::submitButton('Search', ['class' => 'btn blue-hoki uppercase bold']) ?>

                </span>
            </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
