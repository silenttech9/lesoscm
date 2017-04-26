<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Customer;
use frontend\models\LookupSalesman;
use frontend\models\LookupIndoor;
use frontend\models\JobOrder;
use frontend\models\User;
use frontend\modules\malaysia\models\CustomerPic;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\widgets\Pjax;
use marqu3s\summernote\Summernote;
/* @var $this yii\web\View */
/* @var $model frontend\models\JobOrder */
/* @var $form yii\widgets\ActiveForm */
$user = ArrayHelper::map(User::find()->where(['state_id'=>$model->render_state_id])->asArray()->all(),'id','username'); 
$agent = ArrayHelper::map(LookupSalesman::find()->asArray()->all(),'id','salesman');
$sales = LookupSalesman::find()->where(['user_id'=>$model->salesman])->one();
$indoor = LookupIndoor::find()->where(['user_id'=>$model->indoor])->one();
$tech = User::find()->where(['state_id'=>Yii::$app->request->get('render_state_id')])->andWhere(['module_id'=>1])->andWhere(['department'=>'technical'])->one();
$custo_ship = ArrayHelper::map(CustomerPic::find()->where(['customer_id'=>$model->customer_id])->asArray()->all(), 'id', 'name');

$script = <<< JS
$(document).ready(function(){
    $("#liststatus").change(function() { 
        // to sale department
        if ( $(this).val() == "Beyond Repair") {
            $("#tosales").show();
            $("#totech").hide();
            
            $("#saleuser").prop("disabled", false);
            $("#remarksale").prop("disabled", false);
            $("#techuser").prop("disabled", true);
            $("#remarktech").prop("disabled", true);
            
        }
        else if ( $(this).val() == "Send To Supplier"){
            $("#tosales").show();
            $("#totech").hide();
            
            $("#saleuser").prop("disabled", false);
            $("#remarksale").prop("disabled", false);
            $("#techuser").prop("disabled", true);
            $("#remarktech").prop("disabled", true);
        }
        else if( $(this).val() == "Warranty Claim"){
            $("#tosales").show();
            $("#totech").hide();
            
            $("#saleuser").prop("disabled", false);
            $("#remarksale").prop("disabled", false);
            $("#techuser").prop("disabled", true);
            $("#remarktech").prop("disabled", true);
        }
        else if( $(this).val() == "Awaiting To Quote"){
            $("#tosales").show();
            $("#totech").hide();
            
            $("#saleuser").prop("disabled", false);
            $("#remarksale").prop("disabled", false);
            $("#techuser").prop("disabled", true);
            $("#remarktech").prop("disabled", true);
        }
        else if( $(this).val() == "Arrange Delivery"){
            $("#tosales").show();
            $("#totech").hide();
            
            $("#saleuser").prop("disabled", false);
            $("#remarksale").prop("disabled", false);
            $("#techuser").prop("disabled", true);
            $("#remarktech").prop("disabled", true);
        }

        // to technical
        else if( $(this).val() == "Quoted"){
            $("#tosales").hide();
            $("#totech").show();
            
            $("#saleuser").prop("disabled", true);
            $("#remarksale").prop("disabled", true);
            $("#techuser").prop("disabled", false);
            $("#remarktech").prop("disabled", false);
        }
        else if( $(this).val() == "Customer Confirm"){
            $("#tosales").hide();
            $("#totech").show();

            $("#saleuser").prop("disabled", true);
            $("#remarksale").prop("disabled", true);
            $("#techuser").prop("disabled", false);
            $("#remarktech").prop("disabled", false);
        }
        else if( $(this).val() == "Customer Reject"){
            $("#tosales").hide();
            $("#totech").show();

            $("#saleuser").prop("disabled", true);
            $("#remarksale").prop("disabled", true);
            $("#techuser").prop("disabled", false);
            $("#remarktech").prop("disabled", false);
        }
        else{
            $("#tosales").hide();
            $("#totech").hide();
            $("#saleuser").prop("disabled", true);
            $("#remarksale").prop("disabled", true);
            $("#techuser").prop("disabled", true);
            $("#remarktech").prop("disabled", true);
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
   $('input[type="radio"]#changestatus').click(function() {
       if($(this).val() == 'yes') {
            $('.status').show(500); 
            $("#liststatus").prop('disabled', false);          
       }

       else {
             $("#saleuser").prop("disabled", true);
            $("#remarksale").prop("disabled", true);
            $("#techuser").prop("disabled", true);
            $("#remarktech").prop("disabled", true);
            $('.status').hide(500); 
            $("#liststatus").prop('disabled', true); 
       }
   });

   $('#checkbox6').click(function() {
        if($(this).is(":checked")) {
            $(".itemquote").show(500);
            // $(".textquote").prop('disabled', true);
        } else {
            $(".itemquote").hide(500);
            // $(".textquote").prop('disabled', false);
        }
   });
});
JS;
$this->registerJs($script);

$this->title = 'Update Status Job Order: ' . $model->job_order_no;
?>
<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="note note-danger">
            <h4 class="block">Current Status : <?= $model->status ?></h4>
            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
            </div>
            <div class="portlet-body">
                <?php if(Yii::$app->session->hasFlash('createPic')) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert"></button>
                         <?php echo  Yii::$app->session->getFlash('createPic'); ?>
                    </div>
                    <?php } ?>
                <div class="job-order-form">
                    
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->errorSummary($model); ?>

                    <div class="">
                        <label class="control-label">Change Status ?</label>
                        <div class="form-group">
                            <input type="hidden" name="change" value="">
                            <div id="joborder-problem">
                                <label class="mt-radio">
                                    <input id="changestatus" type="radio" name="tukarstatus" value="yes" tabindex="8">Yes<span></span>
                                </label>
                                <label class="mt-radio">
                                    <input id="changestatus" type="radio" name="tukarstatus" value="no" tabindex="8">No<span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="status" style="display: none">
                        <?= $form->field($model, 'status')->dropDownList([ 
                            'Awaiting Troubleshoot' => 'Awaiting Troubleshoot', 
                            'Work In Progress' => 'Work In Progress',
                            'Beyond Repair'=>'Beyond Repair',
                            'Send To Supplier'=>'Send To Supplier',
                            'Warranty Claim' => 'Warranty Claim',
                            'Awaiting To Quote'=>'Awaiting To Quote',
                            'Arrange Delivery'=>'Arrange Delivery',
                            'Done'=>'Done',
                            ], ['prompt' => '--Please Choose--','id'=>'liststatus','disabled'=>'']) ?>
                        
                        <!-- <input type="text" id="txtcboState" name="cboState" style="display:none;"/> -->
                        <div id="tosales" style="display: none">
                            <!-- <label class="">Notify To Salesman</label>
                                <p style="color:blue"><strong><?= $sales->salesman ?></strong></p> -->
                            <label class="">Notify To Indoor</label>
                                <p style="color:blue"><strong><?= $indoor->indoor ?></strong></p>

                            <div class="form-group">
                                <input type="hidden" id="saleuser" class="form-control" name="NotifyJoborder[user_id]" value="<?= $indoor->user_id ?>" disabled=''>
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="NotifyJoborder-text">Status Description</label>
                                <textarea id="remarksale" disabled="" class="form-control" name="NotifyJoborder[text]" rows="7"></textarea>
                            </div>
                        </div>
                        <div id='totech' style="display: none;">
                            <label>Notify To Technical</label>
                            <p style="color:blue"><strong><?= $tech->username ?></strong></p>
                            <div class="form-group">

                                <input type="hidden" id="techuser" class="form-control" name="NotifyJoborder[user_id]" value="<?= $tech->id ?>" disabled=''>
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="NotifyJoborder-text">Status Description</label>
                                <textarea id="remarktech" disabled="" class="form-control" name="NotifyJoborder[text]" rows="7"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <?= $form->field($model, 'tech_finding')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'tech_action_taken')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'tech_spare_part')->textarea(['rows' => 6]) ?>
                    
                    <!-- <?= $form->field($model, 'item_quote')->textarea(['rows' => 6,'id'=>'textquote']) ?> -->
                    <?= $form->field($model, 'item_quote')->widget(Summernote::className(), [
                        'options' => ['rows' => 6],


                    ]) ?>
                    <?= $form->field($model, 'done_by')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'date_done_by')->textInput(['maxlength' => true,'class'=>'form-control date-picker','data-date-format'=>'dd/mm/yyyy']) ?>

                    <?= $form->field($model, 'checked_by')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'date_checked_by')->textInput(['maxlength' => true,'class'=>'form-control date-picker','data-date-format'=>'dd/mm/yyyy']) ?>

                    <?= $form->field($model, 'send_out_by')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'date_send_out_by')->textInput(['maxlength' => true,'class'=>'form-control date-picker','data-date-format'=>'dd/mm/yyyy']) ?>

                    
                    
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

