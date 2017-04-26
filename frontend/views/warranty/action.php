<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\selangor\WarrantySelangor */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
$(document).ready(function(){


    $('#meol').on('change', function() {
    	var moel = $('#meol').val();

    	if (moel == 'Yes') {
    		$("#sr").val('No').prop("disabled", true);

    		$("#remind").val('No').prop("disabled", true);
    	} else {
    		$("#sr").val('').prop("disabled", false);
    		$("#remind").val('Yes').prop("disabled", false);
    	}
      
      
    });

}); 
JS;
$this->registerJs($script);
?>




<div class="warranty-selangor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'machine_end_of_life')->dropDownList([ 'No' => 'No', 'Yes' => 'Yes', ], ['id'=>'meol']) ?>

    <?= $form->field($model, 'service_required')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['id'=>'sr']) ?>
    
    <?= $form->field($model, 'reminder')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['id'=>'remind']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>