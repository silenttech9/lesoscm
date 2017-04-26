<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\JsExpression;
use frontend\modules\bangladesh\models\Customer;
use frontend\modules\bangladesh\models\CustomerPic;
use frontend\models\User;
/* @var $this yii\web\View */
/* @var $model2 common\model2s\all\TelemarketingCustomer */
/* @var $form yii\widgets\ActiveForm */
$custo_ship = ArrayHelper::map(CustomerPic::find()->where(['customer_id'=>$model2->customer_id])->asArray()->all(), 'id', 'name');

$telemarketers = ArrayHelper::map(User::find()->where(['module_id'=>$module_id])->asArray()->all(),'id','username'); 

$special = ArrayHelper::map(User::find()->where(['module_id'=>$module_id])->asArray()->all(),'id','username'); 

?>

<div class="telemarketing-customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

         $url = \yii\helpers\Url::to(['custs']);

    $cName = empty($model2->customer_id) ? '' : Customer::findOne($model2->customer_id)->company_name;

    echo $form->field($model2, 'customer_id')->widget(Select2::classname(), [
        'initValueText' => $cName, // set the initial display text
        'options' => [
           'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl(['/bangladesh/telemarketing/ship','id'=>'']).'"+$(this).val(), function(data){$("select#ship_to").html(data);})',
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

    <?= $form->field($model2, 'customer_pic_id')->dropDownList(
        $custo_ship, 
    [
        'prompt' => '-Please Choose-',
        'id' => 'ship_to',

    ]) ?>
    <div class="show-pic-details" style="display:none;">
            <div class="pic-details"></div>

    </div>

    <?= $form->field($model2, 'activity')->textarea(['rows' => 6]) ?>


    <?= $form->field($model2, 'reminder')->checkbox(
    [
        'id' => 'telemarketing-customer-reminder',
        'class' => 'telemarketing-customer-reminder',
        'checked'=>true,
        'uncheck'=>'No',
        'value'=>'Yes',
        'label'=>'<span></span> Reminder ? ',
        'labelOptions'=>['class'=>'mt-checkbox mt-checkbox-outline'],
    ]); ?>

    <div id="telemarketing-reminder" class="telemarketing-reminder" style="display:none">

        <?= $form->field($model2, 'datetime')->textInput(['class'=>'form-control input-large date-picker','data-date-format'=>'yyyy/mm/dd','readOnly'=>'readOnly']) ?>

        <?= $form->field($model2, 'remark_reminder')->textarea(['rows' => 6]) ?>

    </div>


        <?= $form->field($model2, 'sales_visit')->checkbox(
    [
        'checked'=>true,
        'uncheck'=>'No',
        'value'=>'Yes',
        'label'=>'<span></span> Sales Visit ? ',
        'labelOptions'=>['class'=>'mt-checkbox mt-checkbox-outline'],
    ]); ?>

    <div id="sales-visit" class="sales-visit" style="display:none">

    <?= $form->field($model2, 'sales_visit_date')->textInput(['class'=>'form-control input-large date-picker','data-date-format'=>'dd/mm/yyyy','readOnly'=>'readOnly']) ?>


    <?= $form->field($model2, 'sales_specialist_id')->dropDownList($special, 
    [
        'prompt' => '-Please Choose',

    ]) ?>


    <?= $form->field($model2, 'sales_visit_information')->textarea(['rows' => 6]) ?>
    </div>

    <?= $form->field($model2, 'quotation')->checkbox(
    [
        'checked'=>true,
        'uncheck'=>'No',
        'value'=>'Yes',
        'label'=>'<span></span> Quotation ? ',
        'labelOptions'=>['class'=>'mt-checkbox mt-checkbox-outline'],
    ]); ?>


    <div id="quotation-info" class="quotation-info" style="display:none">
        

    <?= $form->field($model2, 'sales_agent')->dropDownList($telemarketers, 
    [
        'prompt' => '-Please Choose',

    ]) ?>


    <?= $form->field($model2, 'remark')->textarea(['rows' => 6]) ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model2->isNewRecord ? 'Create' : 'Update', ['class' => $model2->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


