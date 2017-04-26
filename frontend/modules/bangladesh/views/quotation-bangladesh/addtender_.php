<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LookupValidity */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
$(document).ready(function(){
    $(".button").click(function(e) {

      var name = $("input#tender-name").val();

    	$('.loading').show();
    	$.ajax({
          	type: 'POST',
          	url: 'addtender',
          	data: {name: name},

          	success: function(data) {
    			     $('#modal').modal('hide');
    			     $.pjax.reload({container:'#refreshtender'});
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
		    <label class="control-label" for="lookupdelivery-delivery">Tender</label>
		    <input type="text" id="tender-name" class="form-control" name="tender-name" maxlength="255" placeholder="">
	</div>
    <button class="button btn blue-steel" id="submit_btn" value="Save">Save</button>
    
    <!-- </form> -->
</div>
