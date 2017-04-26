<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\LookupAgent;

$sales = ArrayHelper::map(LookupAgent::find()->where(['state_id'=>$state_id])->asArray()->all(), 'id', 'agent');
/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\QuotationSearch */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
$(document).ready(function(){

    $('#resetbut').click(function(){
       
        $('#resetform')[0].reset();
        // document.getElementById("resetform").reset();
    });
});
JS;
$this->registerJs($script);

?>
<div class="warranty-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index','state_id'=>$state_id],
        'method' => 'get',
        'options' => [
            'id' => 'resetform',
        ],
    ]); ?>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="col-xs-6 col-md-6 col-lg-6">
                <label class="control-label">Start Date</label>
                <?= $form->field($model, 'mindate')->textInput(['maxlength' => true,'class'=>'form-control date-picker','data-date-format'=>'yyyy/mm/dd'])->label(false) ?>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6">
            <label class="control-label">End Date</label>
                <?= $form->field($model, 'maxdate')->textInput(['maxlength' => true,'class'=>'form-control date-picker','data-date-format'=>'yyyy/mm/dd'])->label(false) ?>
            </div>
            
        </div>
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="col-xs-6 col-md-6 col-lg-6">
            <label class="control-label">Min Amount</label>
               <?= $form->field($model, 'minamount')->label(false) ?>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6">
            <label class="control-label">Max Amount</label>
                <?= $form->field($model, 'maxamount')->label(false) ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="col-xs-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'company_name') ?>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'agent_id')->dropDownList($sales, 
                    [
                        'prompt' => '-Please Choose-',
                    ]) ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="col-xs-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'status_quote')->dropDownList(
                    [
                        'Pending'=>'Pending',
                        'Win'=>'Win',
                        'Lost'=>'Lost',
                        'Active'=>'Active',
                        'Requote'=>'Requote',
                    ], 
                    [
                        'prompt' => '-Please Choose-',
                    ]) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Filter', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset',['index','state_id'=>$state_id,'reset'=>'reset'],['class'=>'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>