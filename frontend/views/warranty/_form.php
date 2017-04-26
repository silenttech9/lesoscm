<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\LookupDeliveryMode;
use frontend\modules\malaysia\models\Customer;
use frontend\modules\malaysia\models\CustomerPic;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;

$custo_ship = ArrayHelper::map(CustomerPic::find()->where(['customer_id'=>$model->customer_id])->asArray()->all(), 'id', 'name');
$mode = ArrayHelper::map(LookupDeliveryMode::find()->asArray()->all(), 'id', 'delivery_type');

/* @var $this yii\web\View */
/* @var $model app\models\YuranDaftar */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
$(document).ready(function(){
    // $('input[name=number_employees]').keyup(function(){
    //     console.log('ads');
    // });

    $('#number_employees').keyup(function(){
    
        var a = $(this).val();
        var e = $('.adddivorder > #itemorder');
        e.not(':first').remove();  

        for(var i = 0;i< (a - 1);i++)
        {
            var c = $("#itemorder").clone().insertAfter(e);
            c.find("input[type=text]").val("");
            // c.appendTo(".adddivorder");

            $('div#del').not(':first').show();
            // $('.adddivorder #itemorder').fadeIn(1000);
           
        }
        
    });

    $("#addmoresesi").click(function(){
        var c = $("#itemorder").clone();
        c.find("input[type=text]").val("");
        c.appendTo(".adddivorder");
        $('div#del').not(':first').show();
    });

    $(".adddivorder").on("click", "#removeorder", function(e) {
        e.preventDefault();
        var b = $(".adddivorder > #itemorder").length;
        var c = b - 1;
        $(this).fadeOut("slow", function(){ 
            $(this).closest("#itemorder").remove();
            $(this).closest(".horizontal").remove();

            $('#number_employees').val(c);  
        });
    });
});
JS;
$this->registerJs($script);
?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-credit-card font-green-haze"></i>
                    <span class="caption-subject font-green-haze bold uppercase"> Warranty
                    </span>
                </div>
            </div>
            <div class="portlet-body form">
                
                <div class="form-wizard">
                <?php $form = ActiveForm::begin(); ?>
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            <li>
                                <a href="#tab1" data-toggle="tab" class="step">
                                    <span class="number"> 1 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Serial Number </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab" class="step">
                                    <span class="number"> 2 </span>
                                    <span class="desc">
                                    <i class="fa fa-check"></i> Warranty Details </span>
                                </a>
                            </li>
                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success"> </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <label for="number_employees">Enter Total of Serial Numbers:</label>
                                    <input type="text" name="number_employees" id="number_employees" value="1" class="form-control input-inline input-medium" /> or click this button
                                    <?= Html::a('Add More',FALSE, ['id'=>'addmoresesi','class' => 'btn blue-steel']) ?>
                                <div class="adddivorder row">
                                    <div id='itemorder' class="col-md-4" >
                                        <div class="portlet-body form">
                                            <div class="form-body">
                                                <div class="">
                                                    <label class="control-label">Serial Number</label>
                                                    <?= $form->field($model, 'serial_number[]')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                                </div>
                                                <div class="">
                                                    <label class="control-label">Warranty Period</label>
                                                    <?= $form->field($model, 'warranty_period[]')->dropDownList([ 'No Warranty'=>'No Warranty','1 Month'=>'1 Month','3 Month'=>'3 Month','6 Month' => '6 Month', '1 Year' => '1 Year', '2 Year' => '2 Year', '3 Year' => '3 Year', '4 Year' => '4 Year', '5 Year' => '5 Year', ], ['prompt' => '-Please Choose-','class'=>'form-control'])->label(false) ?>
                                                </div>

                                                <div class="" id="del"  style="display:none;margin-top: 2px;">
                                                    <div class="form-group">
                                                        <input type="button" id="removeorder" class="btn red-sunglo"  value="Delete">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane active" id="tab2">
                                 <?= $form->field($model, 'delivery_mode_id')->dropDownList($mode, 
                                    [
                                        'prompt' => '-Please Choose-',

                                    ]) ?>

                                    <?= $form->field($model, 'consignment_number')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'delivery_date')->textInput(['class'=>'form-control date-picker','data-date-format'=>'yyyy-mm-dd','readOnly'=>'readOnly']) ?>
                                    
                                    <?php 
                                        $url = \yii\helpers\Url::to(['custall']);
                                    // if ($state_id == 13 || $state_id == 100) {
                                    //      $url = \yii\helpers\Url::to(['custs']);
                                    // } elseif ($state_id == 23) {
                                    //     $url = \yii\helpers\Url::to(['custp']);
                                    // } elseif ($state_id == 22) {
                                    //     $url = \yii\helpers\Url::to(['custj']);
                                    // } elseif ($state_id == 21) {
                                    //     $url = \yii\helpers\Url::to(['custsrk']);
                                    // } elseif ($state_id == 20) {
                                    //     $url = \yii\helpers\Url::to(['custsbh']);
                                    // }



                                    $cName = empty($model->customer_id) ? '' : Customer::findOne($model->customer_id)->company_name;

                                    echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
                                        'initValueText' => $cName, // set the initial display text
                                        'options' => [
                                           'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl(['warranty/ship','id'=>'']).'"+$(this).val(), function(data){$("select#ship_to_warranty").html(data);})',
                                           'placeholder' => 'Search Customer Name ...',

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

                                    ]); ?>
                                    <?= $form->field($model, 'customer_pic_id')->dropDownList(
                                        $custo_ship, 
                                    [
                                        'prompt' => '-Please Choose-',
                                        'id' => 'ship_to_warranty',

                                    ]) ?>

                                    <div class="show-pic-warranty" style="display:none;">
                                            <div class="pic-warranty"></div>

                                    </div>

                                    <?= $form->field($model, 'update_customer')->dropDownList([ 'No' => 'No', 'Send' => 'Send', ]) ?>
                            </div>
                        </div>
                        <div class="form-actions ">
                            <div class="row pull-right">
                                <div class="">
                                    
                                    <a href="javascript:;" class="btn default button-previous">
                                        <i class="fa fa-angle-left"></i> Back </a>
                                    <a href="javascript:;" class="btn blue-chambray button-next"> Next
                                        <i class="fa fa-angle-right"></i>
                                    </a><!-- 
                                    <a href="javascript:;" class="btn green button-submit"> Submit
                                        <i class="fa fa-check"></i>
                                    </a> -->

                                    <?php echo Html::submitButton($model->isNewRecord ? 'Save<i class="fa fa-check"></i>' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success button-submit' : 'btn btn-primary'])  ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>

