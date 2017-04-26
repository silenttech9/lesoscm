<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StockReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['annual','state_id'=>$state_id],
        'method' => 'get',
    ]); ?>

    <div class="search-page search-content-2">
        <div class="search-bar ">
            <div class="col-md-11">
                <div class="input-group">

                    <input type="text" name="SelangorInvoiceSearch[globalSearch]" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <?= Html::submitButton('Search', ['class' => 'btn blue-hoki uppercase bold']) ?>

                    </span>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>