<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LookupValidity */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
$(document).ready(function(){
    $(".button").click(function(e) {

      var name = $("input#tax-name").val();

    	$('.loading').show();
    	console.log(name);
    	$.ajax({
          	type: 'POST',
          	url: 'addtax',
          	data: {name: name},

          	success: function(data) {
    			     $('#modal').modal('hide');
    			     $.pjax.reload({container:'#refreshtax'});
    			     setTimeout(function(){ $('.loading').hide(); $('#taxsdropdown').prop('disabled', false); }, 3000);

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
		    <label class="control-label" for="lookupdelivery-delivery">Tax Code</label>
		    <input type="text" id="tax-name" class="form-control" name="tax-name" maxlength="255" placeholder="Eg. VAT 15%">
	</div>
    <button class="button btn blue-steel" id="submit_btn" value="Save">Save</button>
    
    <!-- </form> -->
</div>
