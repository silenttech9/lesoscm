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
        // to technical
        
        if($(this).val() == "Done"){
            $("#tosales").hide();
            $("#totech").hide();
            $("#saleuser").prop("disabled", true);
            $("#remarksale").prop("disabled", true);
            $("#techuser").prop("disabled", true);
            $("#remarktech").prop("disabled", true);
        }
        else{
            $("#tosales").hide();
            $("#totech").show();

            $("#saleuser").prop("disabled", true);
            $("#remarksale").prop("disabled", true);
            $("#techuser").prop("disabled", false);
            $("#remarktech").prop("disabled", false);
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
            $("#techuser").prop("disabled", false);  
            $("#remarktech").prop("disabled", false); 

            var v = '<input id="" type="hidden" name="tukarstatus" value="yes" tabindex="8">';
            $('.bindstatus').html(v);    
       }

       else {
            var v = '<input id="" type="hidden" name="tukarstatus" value="" tabindex="8">';
            $('.bindstatus').html(v);
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
            $("#submitbutton").prop('disabled', false);
        } else {
            $("#submitbutton").prop('disabled', true);
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
                <div class="job-order-form">
                    
                    <div class="">
                        <label class="control-label"><strong>Change Status</strong>  ?</label>
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
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="bindstatus">
                            
                        </div>
                        <?= $form->field($model, 'status')->dropDownList([ 
                            'Awaiting Spare Part'=>'Awaiting Spare Part',
                            'Quoted' => 'Quoted',
                            'Customer Confirm'=>'Customer Confirm',
                            'Customer Reject'=>'Customer Reject',
                            'Done'=>'Done',
                            ], ['prompt' => '-- Please Choose --','id'=>'liststatus','disabled'=>'']) 
                        ?>
                        
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
                        <div class="form-group form-md-checkboxes">
                        
                            <div class="md-checkbox-inline">
                                <div class="md-checkbox">
                                    <input type="checkbox" id="checkbox6" class="md-check" value="confirm">
                                    <label for="checkbox6">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> Confirm To Update ? </label>
                                </div>
                                
                            </div>
                        </div>
                        <br>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="submitbutton" disabled="">Update</button>                        
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                    

                    <br>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <table class="table">
                                <tr>
                                    <td><strong>Brand</strong></td>
                                    <td><?= $model->brand ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Model</strong></td>
                                    <td><?= $model->model ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Serial Number</strong></td>
                                    <td><?= $model->serial_no ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Accessory</strong></td>
                                    <td><?= $model->accessory ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Item To Quote</strong></td>
                                    <td><?= $model->item_quote ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Finding</strong></td>
                                    <td><?= $model->tech_finding ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Technical Action Taken</strong></td>
                                    <td><?= $model->tech_action_taken ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Spare Part Needed</strong></td>
                                    <td><?= $model->tech_spare_part ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>

