<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\JsExpression;
use frontend\modules\malaysia\models\Customer;
/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\SalesActivity */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
$(document).ready(function(){


    $('#salesactivity-customer_id').on('change', function() {
        var v = $(this).val();

        $.ajax({
               url: 'address',
               data: {id: v},
               success: function(data) {
             
                    $(".address-saleactivity-info").show();
                    $(".address-saleactivity-info").html(data);

               }
        });
      
    });


}); 
JS;
$this->registerJs($script);


?>

<div class="sales-activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->isNewRecord) {  ?>

        <?= $form->field($model, 'datetime')->textInput(['maxlength' => true,'value'=>date('Y/m/d H:i:s A'),'readOnly'=>'readOnly']) ?>

    <?php } else { ?>

        <label>Date Time</label>
        <br>
        <span><b><?php echo $model->datetime; ?></b></span>   
        <br><br>
     

    <?php } ?>

    <?php

    if ($state_id == 13 || $state_id == 100) {
         $url = \yii\helpers\Url::to(['custs']);
    } elseif ($state_id == 23) {
        $url = \yii\helpers\Url::to(['custp']);
    } elseif ($state_id == 22) {
        $url = \yii\helpers\Url::to(['custj']);
    } elseif ($state_id == 21) {
        $url = \yii\helpers\Url::to(['custsrk']);
    } elseif ($state_id == 20) {
        $url = \yii\helpers\Url::to(['custsbh']);
    }


    $cName = empty($model->customer_id) ? '' : Customer::findOne($model->customer_id)->company_name;

    echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'initValueText' => $cName, // set the initial display text
        'options' => [
           //'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl(['sales-activity/ship','id'=>'']).'"+$(this).val(), function(data){$("select#ship_to").html(data);})',
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




    <div class="address-saleactivity-info" style="display:none;"></div>

    <div class="form-group">
     <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn blue-steel' : 'btn blue-steel']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
