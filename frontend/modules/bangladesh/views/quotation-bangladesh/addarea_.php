<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LookupValidity */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
$(document).ready(function(){
    $(".button").click(function(e) {

      var name = $("input#area-name").val();

    	$('.loading').show();
    	$.ajax({
          	type: 'POST',
          	url: 'addarea',
          	data: {name: name},

          	success: function(data) {
    			     $('#modal').modal('hide');
    			     $.pjax.reload({container:'#refresharea'});
    			     setTimeout(function(){ $('.loading').hide(); $('#areadropdown').prop('disabled', false); }, 3000);

			     }
          });

    });
    
}); 
JS;
$this->registerJs($script);
?>


<div class="lookup-validity-form">
	<!-- <form name="contact" action="" method="post"> -->
  	<div class="form-group field-lookupdelivery-delivery">
		    <label class="control-label" for="lookupdelivery-delivery">Area Code</label>
		    <input type="text" id="area-name" class="form-control" name="area-name" maxlength="255" placeholder="">
	</div>
    <button class="button btn blue-steel" id="submit_btn" value="Save">Save</button>
    
    <!-- </form> -->
</div>
