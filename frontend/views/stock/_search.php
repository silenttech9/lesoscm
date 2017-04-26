<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="search-page search-content-2">
        <div class="search-bar ">
            <div class="col-md-11">
                <div class="input-group">

                    <input type="text" name="StockSearch[globalSearch]" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <?= Html::submitButton('Search', ['class' => 'btn blue-hoki uppercase bold']) ?>

                    </span>
                </div>
            </div>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
