<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LookupValidity */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
$(document).ready(function(){
    $(".button").click(function(e) {
    	var name = $("input#lookupdelivery-delivery").val();
    	$('.loading').show();
    	console.log(name);
    	$.ajax({
          	type: 'POST',
          	url: 'adddelivery',
          	data: {name: name,},

          	success: function(data) {
        		console.log(name);
    			$('#modal').modal('hide');
    			$.pjax.reload({container:'#refreshdelivery'});
    			
    			setTimeout(function(){ $('.loading').hide(); }, 3000);
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
		<label class="control-label" for="lookupdelivery-delivery">Delivery</label>
		<input type="text" id="lookupdelivery-delivery" class="form-control" name="LookupDelivery[delivery]" maxlength="255">
	</div>
    <button class="button btn blue-steel" id="submit_btn" value="Save">Save</button>
    
    <!-- </form> -->
</div>
