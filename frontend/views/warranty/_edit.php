<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\LookupDeliveryMode;
use frontend\modules\malaysia\models\Customer;
use frontend\modules\malaysia\models\CustomerPic;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model common\models\Warranty */
/* @var $form yii\widgets\ActiveForm */
$custo_ship = ArrayHelper::map(CustomerPic::find()->where(['customer_id'=>$model->customer_id])->asArray()->all(), 'id', 'name');
$mode = ArrayHelper::map(LookupDeliveryMode::find()->asArray()->all(), 'id', 'delivery_type');
?>
<div class="warranty-selangor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'delivery_mode_id')->dropDownList($mode, 
    [
        'prompt' => '-Please Choose',

    ]) ?>

    <?= $form->field($model, 'delivery_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consignment_number')->textInput(['maxlength' => true]) ?>


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
           'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl(['warranty/ship','id'=>'']).'"+$(this).val(), function(data){$("select#ship_to").html(data);})',
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
        'id' => 'ship_to',

    ]) ?>

    <?= $form->field($model, 'update_customer')->dropDownList([ 'No' => 'No', 'Send' => 'Send', ]) ?>





    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn blue-steel' : 'btn blue-steel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

