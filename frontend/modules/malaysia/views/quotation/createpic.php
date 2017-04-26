<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\LookupPhoneCountryCode;
$country_code = ArrayHelper::map(LookupPhoneCountryCode::find()->where(['active'=>['Yes']])->asArray()->all(),'code','code'); 
/* @var $this yii\web\View */
/* @var $model common\models\selangor\SelangorCustomerPic */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Customer PIC';
$this->params['breadcrumbs'][] = ['label' => 'Customer Pics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                <div class="customer-pic-create">

                    <div class="selangor-customer-pic-form">

                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>

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
</div>



