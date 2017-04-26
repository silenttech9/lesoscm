<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\JohorStockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="johor-stock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index','state_id'=>$state_id],
        'method' => 'get',
    ]); ?>

    <div class="search-page search-content-2">
        <div class="search-bar ">
            <div class="col-md-11">
            <div class="input-group">

                <input type="text" name="JohorStockSearch[globalSearch]" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <?= Html::submitButton('Search', ['class' => 'btn blue-hoki uppercase bold']) ?>

                </span>
            </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
