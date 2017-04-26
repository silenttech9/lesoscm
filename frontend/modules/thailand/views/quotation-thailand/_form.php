<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\modules\thailand\models\Customer;
use frontend\modules\thailand\models\CustomerPic;
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
/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\Quotation */
/* @var $form yii\widgets\ActiveForm */

$custo_ship = ArrayHelper::map(CustomerPic::find()->where(['customer_id'=>$model->customer_id])->asArray()->all(), 'id', 'name');
   
$sales = ArrayHelper::map(LookupAgent::find()->where(['module_id'=>3])->asArray()->all(), 'id', 'agent');
$areas = ArrayHelper::map(LookupArea::find()->where(['module_id'=>3])->asArray()->all(), 'id', 'area');

$staxs = ArrayHelper::map(LookupStax::find()->where(['module_id'=>3])->asArray()->all(), 'id', 'CODE');

$validity = ArrayHelper::map(LookupValidity::find()->where(['module_id'=>3])->asArray()->all(), 'id', 'validity');
$delivery = ArrayHelper::map(LookupDelivery::find()->where(['module_id'=>3])->asArray()->all(), 'id', 'delivery');

$currency = ArrayHelper::map(LookupCurrency::find()->where(['module_id'=>3])->asArray()->all(), 'id', 'currency_code');
$tender = ArrayHelper::map(LookupTender::find()->where(['module_id'=>3])->asArray()->all(), 'id', 'tender');


?>

<div class="quotation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'datetime')->textInput(['maxlength' => true,'value'=>date('Y/m/d H:i:s A'),'readOnly'=>'readOnly']) ?>

    <?php



    $url = \yii\helpers\Url::to(['cust']);

    $cName = empty($model->customer_id) ? '' : Customer::findOne($model->customer_id)->company_name;

    echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'initValueText' => $cName, // set the initial display text
        'options' => [
           'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl(['/thailand/quotation-thailand/ship','id'=>'']).'"+$(this).val(), function(data){$("select#ship_to").html(data);})',
           'placeholder' => 'Search Customer Name ...',
           'id' => 'qt-customer',
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

    <div class="address-quotation-info" style="display:none;"></div>


    <?= $form->field($model, 'customer_ship_id')->dropDownList(
        $custo_ship, 
    [
        'prompt' => '-Please Choose-',
        'id' => 'ship_to',
        'class' => 'form-control',

    ]) ?>

    <?= $form->field($model, 'cc_customer_ship_id')->dropDownList(
        $custo_ship, 
    [
        'prompt' => '-Please Choose-',
        'id' => 'ship_to',
        'class' => 'form-control',

    ]) ?>


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
        'label'=>'<span></span> Tender',
        'id'=>'qt-tender',
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
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>




</div>
