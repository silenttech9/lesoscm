<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\modules\malaysia\models\Customer;
use frontend\modules\malaysia\models\CustomerPic;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\widgets\Pjax;
use common\models\LookupValidity;
use common\models\LookupDelivery;
use common\models\LookupAgent;
use common\models\LookupStax;
use common\models\LookupArea;
use common\models\LookupCurrency;
use common\models\LookupTender;
use marqu3s\summernote\Summernote;
use common\models\LookupPhoneCountryCode;
/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\Quotation */
/* @var $form yii\widgets\ActiveForm */

$custo_ship = ArrayHelper::map(CustomerPic::find()->where(['customer_id'=>$model->customer_id])->asArray()->all(), 'id', 'name');

$country_code = LookupPhoneCountryCode::find()->where(['active'=>'Yes'])->all();
$sales = ArrayHelper::map(LookupAgent::find()->where(['state_id'=>$state_id])->asArray()->all(), 'id', 'agent');
$areas = ArrayHelper::map(LookupArea::find()->where(['state_id'=>$state_id])->asArray()->all(), 'id', 'area');

$staxs = ArrayHelper::map(LookupStax::find()->where(['id'=>[26,31]])->asArray()->all(), 'id', 'CODE');

$validity = ArrayHelper::map(LookupValidity::find()->asArray()->all(), 'id', 'validity');
$delivery = ArrayHelper::map(LookupDelivery::find()->asArray()->all(), 'id', 'delivery');

$currency = ArrayHelper::map(LookupCurrency::find()->asArray()->all(), 'id', 'currency_code');
$tender = ArrayHelper::map(LookupTender::find()->asArray()->all(), 'id', 'tender');

$script = <<< JS
$(document).ready(function(){
    
});
JS;
$this->registerJs($script);
?>

<?php if(Yii::$app->session->hasFlash('createPic_quote')) { ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert"></button>
         <?php echo  Yii::$app->session->getFlash('createPic_quote'); ?>
    </div>
    <?php } ?>

<div class="quotation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'datetime')->textInput(['maxlength' => true,'value'=>date('Y/m/d H:i:s A'),'readOnly'=>'readOnly']) ?>

    <?php


    if ($state_id == 13 || $state_id == 100) {
         $url = \yii\helpers\Url::to(['custs']);
    } elseif ($state_id == 23) {
        $url = \yii\helpers\Url::to(['custp']);
    } elseif ($state_id == 22) {
        $url = \yii\helpers\Url::to(['custj']);
    } elseif ($state_id == 20) {
        $url = \yii\helpers\Url::to(['custsabah']);
    } elseif ($state_id == 21) {
        $url = \yii\helpers\Url::to(['custsarawak']);
    }
   


    $cName = empty($model->customer_id) ? '' : Customer::findOne($model->customer_id)->company_name;
    
    echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'initValueText' => $cName, // set the initial display text
        'options' => [
           'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl(['/malaysia/quotation/ship_2','id'=>'']).'"+$(this).val(), function(data){$("select#ship_to").html(data);})',
           'placeholder' => 'Search Customer Name ...',
           'id' => 'qt-customer',
           'class'=>'checkpic',
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
    <?php if(isset($_GET['id'])) { //if i have this post
    echo $_GET['id']; // print it
} ?>
    <div class="address-quotation-info" style="display:none;"></div>
    <div class="company-info" style="display:none;"></div>
    <!-- <div class="companynot-complete" style="display: none;margin-bottom: 10px;">
        <span class='font-red-soft font-md linkcomp_not_complete'>Company information not complete <a class="company_edit" href="#">- Edit</a></span>
    </div> -->

    <div class="form-group boxcompany" style="display: none;margin-bottom: 10px;">
        <label class="control-label" for="selangorcustomer-telephone_no">Company Telephone No</label>
            <div class="form-inline">

                <div class="form-group field-customer-country_code_phone">

                    <select id="customer-comp_country_code_phone" class="form-control input-xsmall" name="comp_country_code_phone" disabled="">
                        <option value=""></option>
                        <?php foreach ($country_code as $key => $value) { ?>
                                <option value="<?= $value->code ?>"><?= $value->code ?></option>
                        <?php }  ?>
                    </select>
                </div> - 
                <div class="form-group field-mask_number">

                    <input type="text" id="mask_number " class="form-control input-xsmall cust_area_code_phone" name="cust_area_code_phone" maxlength="5" disabled="">
                </div>            
                <div class="form-group field-mask_number">

                    <input type="text" id="mask_number " class="form-control input-small cust_telephone_no" name="cust_telephone_no" maxlength="10" disabled="">
                </div>            
            </div>
            <br>
    </div>
    <div class="form-group boxemail_company" style="display: none">
        <label class="control-label">Company Email</label>
        <input type="email" name="email_comp" class="form-control email_comp" id="email_comp" disabled="disabled" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" autocomplete="off">
    </div>

    <?= $form->field($model, 'customer_ship_id')->dropDownList(
        $custo_ship, 
    [
        'prompt' => '-Please Choose-',
        'id' => 'ship_to',
        'class' => 'form-control picdetail',
        'required'=>'',

    ]) ?>
    <div class="pic-info" style="display:none;"></div>
    <div class="addmorepic" style="display: none">
        <span class='font-red-soft font-md'>Add More Customer PIC - </span>
        <?= Html::a('Add More', ['createmorepic','state_id'=>$state_id], ['class' => '']) ?><br>
    </div>
    <div class="not-complete" style="display: none;margin-bottom: 10px;">
        <span class='font-red-soft font-md'>PIC information not complete <a class="editpic" href="#">- Edit</a></span>
    </div>
    <!-- <div class="form-group boxpic" style="display: none">
        <label class="control-label" for="selangorcustomer-telephone_no">Telephone No</label>
            <div class="form-inline">

                <div class="form-group field-customer-country_code_phone has-success">

                    <select id="customer-country_code_phone" class="form-control input-xsmall" name="country_code_phone" disabled="">
                        <option value=""></option>
                        <?php foreach ($country_code as $key => $value) { ?>
                                <option value="<?= $value->code ?>"><?= $value->code ?></option>
                        <?php }  ?>
                    </select>
                </div> - 
                <div class="form-group field-mask_number">

                    <input type="text" id="mask_number " class="form-control input-xsmall area_code_phone" name="area_code_phone" maxlength="5" disabled="">
                </div>            
                <div class="form-group field-mask_number">

                    <input type="text" id="mask_number " class="form-control input-small telephone_no" name="telephone_no" maxlength="10" disabled="">
                </div>            
            </div>
            <br>
    </div> -->
    <div class="form-group boxemail" style="display: none">
        <label class="control-label">Email</label>
        <input type="text" name="email" class="form-control email" id="email" disabled="disabled" autocomplete="off" required="">
    </div>
    <div class="editpic"></div>
    <br>
    <?= $form->field($model, 'cc_customer_ship_id')->dropDownList(
        $custo_ship, 
    [
        'prompt' => '-Please Choose-',
        'id' => 'ship_to',
        'class' => 'form-control',

    ]) ?>

    <div class="checkpicexist" style="display: none;">
        
    </div>
    <div class="quote">
        <div class="sale-quotation-info" style="display:none;"></div>

        <div class="sale-quotation-info-change" style="display:none;">
            
            <?= $form->field($model, 'agent_id')->dropDownList(
                $sales, 
            [
                'prompt' => '-Please Choose-',
                'disabled' => 'disabled',
                'id'=> 'salesdropdown',


            ]) ?>

        </div>

        <div class="tax-quotation-info" style="display:none;"></div>

        <div class="tax-quotation-info-change" style="display:none;">
            
            <?= $form->field($model, 'tax_code_id')->dropDownList(
                $staxs, 
            [
                'disabled' => 'disabled',
                'id'=> 'taxsdropdown',


            ]) ?>

        </div>

        <div class="area-quotation-info" style="display:none;"></div>

        <div class="area-quotation-info-change" style="display:none;">
            
            <?= $form->field($model, 'area_code_id')->dropDownList(
                $areas, 
            [
                'prompt' => '-Please Choose-',
                'disabled' => 'disabled',
                'id'=> 'areadropdown',


            ]) ?>

        </div>


        <?= $form->field($model, 'currency_id')->dropDownList(
            $currency, 
        [


        ]) ?>


    <?= $form->field($model, 'remark')->widget(Summernote::className(), [
        'options' => ['rows' => 6],


    ]) ?>

        <?= $form->field($model, 'validity_id')->dropDownList(
            $validity) ?>
        <?= $form->field($model, 'delivery_id')->dropDownList(
            $delivery) ?>

        <?= $form->field($model, 'tender')->checkbox(
        [
            'checked'=>true,
            'uncheck'=>'No',
            'value'=>'Yes',
            'id'=>'qt-tender',
            'label'=>'<span></span> Tender',
            'labelOptions'=>['class'=>'mt-checkbox mt-checkbox-outline'],
        ]); ?>

        <div style="display:none" class="tender-temp">
            
        <?= $form->field($model, 'tender_id')->dropDownList(
            $tender, 
        [
            'prompt' => '-Please Choose-',
            'id'=>'qt-drop-tender',


        ]) ?>


        <?= $form->field($model, 'tender_visible')->checkbox(
        [
            'checked'=>true,
            'uncheck'=>'No',
            'value'=>'Yes',
            'label'=>'<span></span> Visible On Quotation ?',
            'labelOptions'=>['class'=>'mt-checkbox mt-checkbox-outline'],
        ]); ?>

        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success picnotcomplete' : 'btn btn-primary']) ?>
        </div>
    </div>
    

    <?php ActiveForm::end(); ?>




</div>
