<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\LookupPhoneCountryCode;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\widgets\Pjax;

$country_code = ArrayHelper::map(LookupPhoneCountryCode::find()->where(['active'=>['Yes']])->asArray()->all(),'code','code'); 
/* @var $this yii\web\View */
/* @var $model common\models\selangor\SelangorCustomerPic */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Add Customer Person In Charge';
?>
<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="selangor-customer-pic-form">

                    <?php $form = ActiveForm::begin(); ?>
                    <?php 
                        /*$url = \yii\helpers\Url::to(['custs']);*/
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
                               'placeholder' => 'Search Company Name ...',
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
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'style'=>'text-transform:uppercase']) ?>

                    <?= $form->field($model, 'department')->textInput(['maxlength' => true,'style'=>'text-transform:uppercase']) ?>

                    <div class="form-group field-selangorcustomer-telephone_no has-success">
                        <label class="control-label" for="selangorcustomer-telephone_no">Telephone No</label>
                            <div class="form-inline" >

                                <?= $form->field($model, 'country_code_phone')->dropDownList($country_code,['prompt' => '','class'=>'form-control input-xsmall'])->label(false) ?> - 
                                <?= $form->field($model, 'area_code_phone')->textInput(['maxlength' => 5,'class'=>'form-control input-xsmall','id'=>'mask_number'])->label(false)  ?>
                                <?= $form->field($model, 'telephone_no')->textInput(['maxlength' => 10,'class'=>'form-control input-small','id'=>'mask_number'])->label(false)  ?>
                                
                            </div>
                    </div>

                        <?= $form->field($model, 'extension')->textInput(['maxlength' => true]) ?>

                    <div class="form-group field-selangorcustomer-telephone_no has-success">
                        <label class="control-label" for="selangorcustomer-telephone_no">Mobile No</label>
                            <div class="form-inline" >

                                <?= $form->field($model, 'country_code_mobile')->dropDownList($country_code,['prompt' => '','class'=>'form-control input-xsmall'])->label(false) ?> - 
                                <?= $form->field($model, 'area_code_mobile')->textInput(['maxlength' => 5,'class'=>'form-control input-xsmall','id'=>'mask_number'])->label(false)  ?>
                                <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => 10,'class'=>'form-control input-small','id'=>'mask_number'])->label(false)  ?>
                                
                            </div>
                    </div>

                        <?= $form->field($model, 'email')->textInput(['maxlength' => true,'required'=>'']) ?>

                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn blue-steel' : 'btn blue-steel']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

