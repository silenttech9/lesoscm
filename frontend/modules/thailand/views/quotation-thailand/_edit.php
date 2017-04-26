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

$custo_ship = ArrayHelper::map(CustomerPic::find()->where(['customer_id'=>$model->customer_id])->asArray()->all(), 'id', 'name');

if (!empty($state_id) ) {
    $sales = ArrayHelper::map(LookupAgent::find()->where(['state_id'=>$state_id])->asArray()->all(), 'id', 'agent');
    $areas = ArrayHelper::map(LookupArea::find()->where(['state_id'=>$state_id])->asArray()->all(), 'id', 'area');

} else {
    $sales = ArrayHelper::map(LookupAgent::find()->where(['state_id'=>$model->state_id])->asArray()->all(), 'id', 'agent');
    $areas = ArrayHelper::map(LookupArea::find()->where(['state_id'=>$model->state_id])->asArray()->all(), 'id', 'area');

}


$staxs = ArrayHelper::map(LookupStax::find()->where(['id'=>[26,31]])->asArray()->all(), 'id', 'CODE');

$currency = ArrayHelper::map(LookupCurrency::find()->asArray()->all(), 'id', 'currency_code');
$validity = ArrayHelper::map(LookupValidity::find()->asArray()->all(), 'id', 'validity');
$delivery = ArrayHelper::map(LookupDelivery::find()->asArray()->all(), 'id', 'delivery');
$tender = ArrayHelper::map(LookupTender::find()->asArray()->all(), 'id', 'tender');
/* @var $this yii\web\View */
/* @var $model common\models\all\Quotation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quotation-form">

    <?php $form = ActiveForm::begin(); ?>

        <label>Date Time</label>
        <br>
        <span><b><?php echo $model->datetime; ?></b></span>   
        <br><br>

    <?php

    $url = \yii\helpers\Url::to(['cust']);


    $cName = empty($model->customer_id) ? '' : Customer::findOne($model->customer_id)->company_name;

    echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'initValueText' => $cName, // set the initial display text
        'options' => [
           'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl(['/malaysia/quotation/ship','id'=>'']).'"+$(this).val(), function(data){$("select#ship_to").html(data);})',
           'placeholder' => 'Search Customer Name ...',
           'disabled' => 'disabled',
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
        
        <?= $form->field($model, 'agent_id')->dropDownList(
            $sales, 
        [
            'prompt' => '-Please Choose-',
            //'disabled' => 'disabled',
            'id'=> 'salesdropdown',


        ]) ?>

 
        
        <?= $form->field($model, 'tax_code_id')->dropDownList(
            $staxs, 
        [
            //'disabled' => 'disabled',
            'id'=> 'taxsdropdown',


        ]) ?>

        <?= $form->field($model, 'area_code_id')->dropDownList(
            $areas, 
        [
            'prompt' => '-Please Choose-',
            //'disabled' => 'disabled',
            'id'=> 'areadropdown',


        ]) ?>

    <?= $form->field($model, 'currency_id')->dropDownList(
        $currency, 
    [
        'prompt' => '-Please Choose-',


    ]) ?>



<?= $form->field($model, 'remark')->widget(Summernote::className(), []) ?>


    <?= $form->field($model, 'validity_id')->dropDownList(
        $validity, 
    [
        'prompt' => '-Please Choose-',


    ]) ?>
    <?= $form->field($model, 'delivery_id')->dropDownList(
        $delivery, 
    [
        'prompt' => '-Please Choose-',


    ]) ?>

    <?= $form->field($model, 'tender')->checkbox(
    [
        'checked'=>true,
        'uncheck'=>'No',
        'value'=>'Yes',
        'label'=>'<span></span> Tender',
        'labelOptions'=>['class'=>'mt-checkbox mt-checkbox-outline'],
    ]); ?>



    <div style="display:none" class="tender-temp">
        
    <?= $form->field($model, 'tender_id')->dropDownList(
        $tender, 
    [
        'prompt' => '-Please Choose-',


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
