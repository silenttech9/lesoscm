<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LookupValidity */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
$(document).ready(function(){
    $(".button").click(function(e) {

      var name = $("input#agent-name").val();
    	var mobile_no = $("input#agent-phone").val();

    	$('.loading').show();
    	console.log(name);
    	$.ajax({
          	type: 'POST',
          	url: 'addagent',
          	data: {name: name,mobile_no: mobile_no},

          	success: function(data) {
        		    console.log(name);
    			     $('#modal').modal('hide');
    			     $.pjax.reload({container:'#refreshagent'});
    			     setTimeout(function(){ $('.loading').hide(); $('#salesdropdown').prop('disabled', false); }, 3000);

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
		    <label class="control-label" for="lookupdelivery-delivery">Agent</label>
		    <input type="text" id="agent-name" class="form-control" name="agent-name" maxlength="255">
        <label class="control-label" for="lookupdelivery-delivery">Mobile No</label>
        <input type="text" id="agent-phone" class="form-control" name="agent-phone" maxlength="255">
	</div>
    <button class="button btn blue-steel" id="submit_btn" value="Save">Save</button>
    
    <!-- </form> -->
</div>
