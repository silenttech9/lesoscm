<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Customer;
use frontend\models\LookupSalesman;
use frontend\models\LookupIndoor;
use frontend\modules\malaysia\models\CustomerPic;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model frontend\models\JobOrder */
/* @var $form yii\widgets\ActiveForm */
$agent = ArrayHelper::map(LookupSalesman::find()->where(['state_id'=>$render_state_id])->andWhere(['module_id'=>1])->asArray()->all(),'user_id','salesman');
$indoor = ArrayHelper::map(LookupIndoor::find()->where(['state_id'=>$render_state_id])->andWhere(['module_id'=>1])->asArray()->all(),'user_id','indoor');
$custo_ship = ArrayHelper::map(CustomerPic::find()->where(['customer_id'=>$model->customer_id])->asArray()->all(), 'id', 'name');

$script = <<< JS
$(document).ready(function(){

    $('#show-customer').on('change', function() {

        var v = $(this).val();
        var a = "<span class='font-red-soft font-md'>Add Person In Charge If Field Above Empty or Not Found. </span><a href='createpic?id=$model->render_state_id' class='' >Add Person In Charge</a>"
        $(".cust-info").html( a );
          
      
    });
    $('input[type="radio"]#receivedby').click(function() {
       if($(this).val() == 'Others') {
            $('#otherreceived').show(500); 
            $(".received_by").prop('disabled', false);          
       }

       else {
            $(".received_by").val("");
            $('#otherreceived').hide(500); 
            $(".received_by").prop('disabled', false); 
       }
   });

   $('input[type="radio"]#problem').click(function() {
       if($(this).val() == 'Others') {
            $('#otherproblem').show(500); 
            $(".other_problem").prop('disabled', false);          
       }

       else {
            $(".other_problem").val("");
            $('#otherproblem').hide(500); 
            $(".other_problem").prop('disabled', false); 
       }
   });

});
JS;
$this->registerJs($script);

?>
<?php if(Yii::$app->session->hasFlash('createPic')) { ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert"></button>
         <?php echo  Yii::$app->session->getFlash('createPic'); ?>
    </div>
    <?php } ?>
<div class="job-order-form">

    <?php $form = ActiveForm::begin(); ?>
        <!-- <?= $form->field($model, 'date_joborder')->textInput(['maxlength' => true,'class'=>'form-control date-picker','data-date-format'=>'dd/mm/yyyy']) ?> -->
    <?php 
        $url = \yii\helpers\Url::to(['custs']);
        $cName = empty($model->customer_id) ? '' : Customer::findOne($model->customer_id)->company_name;
        echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
            'initValueText' => $cName, // set the initial display text
            'options' => [
               'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl(['job-order/custname','id'=>'']).'"+$(this).val(), function(data){$("select#ship_to").html(data);})',
               'placeholder' => 'Search Customer Name ...',
               'id' => 'show-customer',
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 1,
                'language' => [
                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                ],
                'ajax' => [
                    'url' => $url,
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }'),
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(customer_id) { return customer_id.text; }'),
                'templateSelection' => new JsExpression('function (customer_id) { return customer_id.text; }'),

            ],
        ]); 
    ?>

    <!-- <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'customer_name')->dropDownList($custo_ship, 
            [
                'prompt'=>'--Please Choose--',
                'id' => 'ship_to',
            ]
        )->label()
    ?>
    
    <div class="cust-info">
        <span class='font-red-soft font-md'>Add Person In Charge If Field Above Empty or Not Found. </span><a href='createpic?id=$model->render_state_id' class='' >Add Person In Charge</a>
    </div><br>
    <!-- <?= $form->field($model, 'job_order_no')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'tel_no')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'salesman')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'salesman')->dropDownList($agent, 
            [
                'prompt'=>'--Please Choose--'
            ]
        )->label()
    ?>
    <?= $form->field($model, 'indoor')->dropDownList($indoor, 
            [
                'prompt'=>'--Please Choose--'
            ]
        )->label()
    ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true,'style'=>'text-transform:uppercase']) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true,'style'=>'text-transform:uppercase']) ?>

    <?= $form->field($model, 'serial_no')->textInput(['maxlength' => true,'style'=>'text-transform:uppercase']) ?>

    <?= $form->field($model, 'accessory')->textInput(['maxlength' => true,'style'=>'text-transform:uppercase']) ?>

    <div class="mt-radio-inline">
        <label class="">Received By</label>
        <div class="form-group field-joborder-received_by has-success">
            <input type="hidden" name="JobOrder[received_by]" value="">
            <div id="joborder-received_by">
                <label class="mt-radio">
                    <input type="radio" id="receivedby" name="JobOrder[received_by]" value="Courier" tabindex="8" <?php if($model->received_by == 'Courier'){echo 'checked';} ?>>Courier<span></span>
                </label>
                <label class="mt-radio">
                    <input type="radio" id="receivedby" name="JobOrder[received_by]" value="Hand Over To Office" tabindex="8" <?php if($model->received_by == 'Hand Over To Office'){echo 'checked';} ?>>Hand Over To Office<span></span>
                </label>
                <label class="mt-radio">
                    <input type="radio" id="receivedby" name="JobOrder[received_by]" value="Collected By Salesman" tabindex="8" <?php if($model->received_by == 'Collected By Salesman'){echo 'checked';} ?>>Collected By Salesman<span></span>
                </label>
                <label class="mt-radio">
                    <input type="radio" id="receivedby" name="JobOrder[received_by]" value="Others" tabindex="8" <?php if($model->received_by == 'Others'){echo 'checked';} ?>>Others<span></span>
                </label>
            </div>
            <div class="help-block"></div>
        </div>        
    </div>
    <div class="form-group" id='otherreceived' <?php if ($model->received_by == 'Others'){}else{ ?>
        style="display:none;"
    <?php } ?> >
        <label class="control-label">Others Received By</label>
        <input type="text" class="form-control received_by" name="JobOrder[other_received_by]" <?php if($model->received_by == 'Others'){}else{echo 'disabled="disabled"';} ?> value='<?php echo $model->other_received_by; ?>'  maxlength="300">

        <div class="help-block"></div>
    </div>
    
    <?= $form->field($model, 'receiver_name')->textInput(['maxlength' => true,'style'=>'text-transform:uppercase']) ?>

    <div class="mt-radio-inline">
        <label class="">Problem</label>
        <div class="form-group field-joborder-problem has-success">
            <input type="hidden" name="JobOrder[problem]" value="">
            <div id="joborder-problem">
                <label class="mt-radio">
                    <input id="problem" type="radio" name="JobOrder[problem]" value="Repair" tabindex="8" <?php if($model->problem == 'Repair'){echo 'checked';} ?>>Repair<span></span>
                </label>
                <label class="mt-radio">
                    <input id="problem" type="radio" name="JobOrder[problem]" value="Calibration" tabindex="8" <?php if($model->problem == 'Calibration'){echo 'checked';} ?>>Calibration<span></span>
                </label>
                <label class="mt-radio">
                    <input id="problem" type="radio" name="JobOrder[problem]" value="Others" tabindex="8" <?php if($model->problem == 'Others'){echo 'checked';} ?>>Others<span></span>
                </label>
            </div>
            <div class="help-block"></div>
        </div>        
    </div>
    <div class="form-group" id='otherproblem' <?php if ($model->problem == 'Others'){}else{ ?>
        style="display:none;"
    <?php } ?> >
        <label class="control-label">Others Problem</label>
        <input type="text" class="form-control other_problem" name="JobOrder[other_problem]" <?php if($model->problem == 'Others'){}else{echo 'disabled="disabled"';} ?> value='<?php echo $model->other_problem; ?>'  maxlength="300">

        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <!-- <?= $form->field($model, 'tech_finding')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tech_action_taken')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tech_spare_part')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'done_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_done_by')->textInput(['maxlength' => true,'class'=>'form-control date-picker','data-date-format'=>'dd/mm/yyyy']) ?>

    <?= $form->field($model, 'checked_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_checked_by')->textInput(['maxlength' => true,'class'=>'form-control date-picker','data-date-format'=>'dd/mm/yyyy']) ?>

    <?= $form->field($model, 'send_out_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_send_out_by')->textInput(['maxlength' => true,'class'=>'form-control date-picker','data-date-format'=>'dd/mm/yyyy']) ?> -->

    <!-- <?= $form->field($model, 'status')->dropDownList([ 'Awaiting Troubleshoot' => 'Awaiting Troubleshoot', 'Work In Progress' => 'Work In Progress', 'Claim for Warranty' => 'Claim for Warranty', 'Awaiting Spare Part' => 'Awaiting Spare Part','Beyond Repair'=>'Beyond Repair','Awaiting To Quote'=>'Awaiting To Quote','Awaiting P.O'=>'Awaiting P.O','Customer Reject'=>'Customer Reject','Customer Confirm'=>'Customer Confirm','Repair Done'=>'Repair Done','Send To Supplier'=>'Send To Supplier','Arrange Delivery'=>'Arrange Delivery' ], ['prompt' => '']) ?> -->

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
