<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\QuotationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quotation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['bystatus','state_id'=>$state_id,'status'=>$status,'agent'=>$agent],
        'method' => 'get',
    ]); ?>

    <div class="col-md-11">
        <div class="input-group">

            <input type="text" name="QuotationSearch[globalSearch]" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <?= Html::submitButton('Search', ['class' => 'btn blue-hoki uppercase bold']) ?>
                
            </span>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<br>

