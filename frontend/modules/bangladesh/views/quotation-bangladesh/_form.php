<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\modules\bangladesh\models\Customer;
use frontend\modules\bangladesh\models\CustomerPic;
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
   
$sales = ArrayHelper::map(LookupAgent::find()->where(['module_id'=>8])->asArray()->all(), 'id', 'agent');
$areas = ArrayHelper::map(LookupArea::find()->where(['module_id'=>8])->asArray()->all(), 'id', 'area');

$staxs = ArrayHelper::map(LookupStax::find()->where(['module_id'=>8])->asArray()->all(), 'id', 'CODE');

$validity = ArrayHelper::map(LookupValidity::find()->where(['module_id'=>8])->asArray()->all(), 'id', 'validity');
$delivery = ArrayHelper::map(LookupDelivery::find()->where(['module_id'=>8])->asArray()->all(), 'id', 'delivery');

$currency = ArrayHelper::map(LookupCurrency::find()->where(['module_id'=>8])->asArray()->all(), 'id', 'currency_code');
$tender = ArrayHelper::map(LookupTender::find()->where(['module_id'=>8])->asArray()->all(), 'id', 'tender');

$script = <<< JS
$(document).ready(function(){
    $('.checkpic').on('change', function() {
        $('.addmorepic').show();
    });
});
JS;
$this->registerJs($script);


?>
<style type="text/css">
    .loading {
    
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .5 ) 
                url('<?php echo Yii::$app->request->baseUrl ?>/theme/assets/layouts/layout2/img/anim-loading.gif') 
                50% 50% 
                no-repeat;
}
</style>

<div class="loading" style="display: none;"></div>

<div class="quotation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'datetime')->textInput(['maxlength' => true,'value'=>date('Y/m/d H:i:s A'),'readOnly'=>'readOnly']) ?>

    <?php



    $url = \yii\helpers\Url::to(['cust']);

    $cName = empty($model->customer_id) ? '' : Customer::findOne($model->customer_id)->company_name;

    echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'initValueText' => $cName, // set the initial display text
        'options' => [
           'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl(['/bangladesh/quotation-bangladesh/ship','id'=>'']).'"+$(this).val(), function(data){$("select#ship_to").html(data);})',
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
    ]); ?>

    <div class="address-quotation-info" style="display:none;"></div>


    <?= $form->field($model, 'customer_ship_id')->dropDownList(
        $custo_ship, 
    [
        'prompt' => '-Please Choose-',
        'id' => 'ship_to',
        'class' => 'form-control',

    ]) ?>

    <div class="addmorepic" style="display: none;">
        <span class='font-red-soft font-md'>Add More Customer PIC - </span>
        <?= Html::a('Add More', ['createmorepic','module_id'=>8], ['class' => '']) ?><br>
    </div>
    <br>
    <?= $form->field($model, 'cc_customer_ship_id')->dropDownList(
        $custo_ship, 
    [
        'prompt' => '-Please Choose-',
        'id' => 'ship_to',
        'class' => 'form-control',

    ]) ?>


    <div class="sale-quotation-info" style="display:none;"></div>

    <div class="sale-quotation-info-change" style="display:none;">
        <?php Pjax::begin(['id'=>'refreshagent']); ?>
            <?= $form->field($model, 'agent_id')->dropDownList(
                $sales, 
            [
                'prompt' => '-Please Choose-',
                'disabled' => 'disabled',
                'id'=> 'salesdropdown',
                'class'=>"form-control a",

            ]) ?>
        <?php Pjax::end(); ?>
        <span class='font-red-soft font-md'>Add More Agent - <?= Html::a('Click Here',FALSE, ['value'=>Url::to(['addagent_']),'class' => 'picCreate','id'=>'picCreate','title' => 'Add more agent',]) ?> 
        </span>
        <br><br>
    </div>

    <!-- <div class="tax-quotation-info" style="display:none;"></div> -->

    <!-- <div class="tax-quotation-info-change" style="display:none;"> -->
        <!-- <?php Pjax::begin(['id'=>'refreshtax']); ?>
            <?= $form->field($model, 'tax_code_id')->dropDownList(
                $staxs, 
            [
                'prompt' => '-Please Choose-',
                'disabled' => 'disabled',
                'id'=> 'taxsdropdown',


            ]) ?>
        <?php Pjax::end(); ?> -->
        <!-- <span class='font-red-soft font-md'>Add More Tax Code - <?= Html::a('Click Here',FALSE, ['value'=>Url::to(['addtax_']),'class' => 'picCreate','id'=>'picCreate','title' => 'Add more tax code',]) ?> 
        </span>
        <br><br>

    </div> -->

    <div class="area-quotation-info" style="display:none;"></div>

    <div class="area-quotation-info-change" style="display:none;">
        <?php Pjax::begin(['id'=>'refresharea']); ?>
            <?= $form->field($model, 'area_code_id')->dropDownList(
                $areas, 
            [
                'prompt' => '-Please Choose-',
                'disabled' => 'disabled',
                'id'=> 'areadropdown',


            ]) ?>
        <?php Pjax::end(); ?>

        <span class='font-red-soft font-md'>Add More Area Code - <?= Html::a('Click Here',FALSE, ['value'=>Url::to(['addarea_']),'class' => 'picCreate','id'=>'picCreate','title' => 'Add more area code',]) ?> 
        </span>
        <br><br>

    </div>


    <?= $form->field($model, 'currency_id')->dropDownList(
        $currency, 
    [
        'prompt' => '-Please Choose-',

    ]) ?>


<?= $form->field($model, 'remark')->widget(Summernote::className(), [
    'options' => ['rows' => 6],


]) ?>
    
    <?php Pjax::begin(['id'=>'refreshvalidity']); ?>

            <?= $form->field($model, 'validity_id')->dropDownList(
                $validity,
            [
                'prompt' => '-Please Choose-',

            ]) ?>

            
    <?php Pjax::end(); ?>
    <span class='font-red-soft font-md'>Add More Validity - <?= Html::a('Click Here',FALSE, ['value'=>Url::to(['addvalidity_']),'class' => 'picCreate','id'=>'picCreate','title' => 'Add more validity',]) ?> 
        </span>
    
    <?php Pjax::begin(['id'=>'refreshdelivery']); ?>
        <?= $form->field($model, 'delivery_id')->dropDownList(
            $delivery,
        [
            'prompt'=>'-Please Choose-',
        ]
        ) ?>
    <?php Pjax::end(); ?>
    <span class='font-red-soft font-md'>Add More Delivery - <?= Html::a('Click Here',FALSE, ['value'=>Url::to(['adddelivery_']),'class' => 'picCreate','id'=>'picCreate','title' => 'Add more delivery',]) ?> 
        </span>

    <br>
    <br>
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
    <?php Pjax::begin(['id'=>'refreshtender']); ?>
        
        <?= $form->field($model, 'tender_id')->dropDownList(
            $tender, 
        [
            'prompt' => '-Please Choose-',
            'id'=>'qt-drop-tender',


        ]) ?>
    <?php Pjax::end(); ?>

    <span class='font-red-soft font-md'>Add More Tender List - <?= Html::a('Click Here',FALSE, ['value'=>Url::to(['addtender_']),'class' => 'picCreate','id'=>'picCreate','title' => 'Add more tender list',]) ?> 
        </span>

    <br>
    <br>

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
