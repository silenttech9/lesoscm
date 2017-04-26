<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;


use frontend\modules\bangladesh\models\CustomerPic;
use frontend\models\User;
/* @var $this yii\web\View */
/* @var $model2 common\model2s\all\SalesActivityLog */
/* @var $form yii\widgets\ActiveForm */

$telemarketers = ArrayHelper::map(User::find()->where(['module_id'=>$module_id])->asArray()->all(),'id','username'); 

$special = ArrayHelper::map(User::find()->where(['module_id'=>$module_id])->asArray()->all(),'id','username'); 


$custo_ship = ArrayHelper::map(CustomerPic::find()->where(['customer_id'=>$mdl->customer_id])->asArray()->all(), 'id', 'name');



?>

<div class="sales-activity-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model2, 'customer_pic_id')->dropDownList(
        $custo_ship, 
    [
        'prompt' => '-Please Choose-',
        'id' => 'ship_to',

    ]) ?>

    <?= $form->field($model2, 'activity')->textarea(['rows' => 6]) ?>

    <?= $form->field($model2, 'reminder')->checkbox(
    [
        'id' => 'activity-customer-reminder',
        'class' => 'activity-customer-reminder',
        'checked'=>true,
        'uncheck'=>'No',
        'value'=>'Yes',
        'label'=>'<span></span> Reminder ? ',
        'labelOptions'=>['class'=>'mt-checkbox mt-checkbox-outline'],
    ]); ?>

    <div id="activity-reminder" class="activity-reminder" style="display:none">

        <?= $form->field($model2, 'reminder_time')->textInput(['class'=>'form-control input-large date-picker','data-date-format'=>'yyyy/mm/dd','readOnly'=>'readOnly']) ?>

        <?= $form->field($model2, 'reminder_remark')->textarea(['rows' => 6]) ?>

    </div>

    <?= $form->field($model2, 'sales_visit')->checkbox(
    [
        'checked'=>true,
        'uncheck'=>'No',
        'value'=>'Yes',
        'label'=>'<span></span> Sales Visit ? ',
        'labelOptions'=>['class'=>'mt-checkbox mt-checkbox-outline'],
    ]); ?>

    <div id="activity-visit" class="activity-visit" style="display:none">

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


    <div id="activity-info" class="activity-info" style="display:none">
        

    <?= $form->field($model2, 'sales_agent')->dropDownList($telemarketers, 
    [
        'prompt' => '-Please Choose',

    ]) ?>


    <?= $form->field($model2, 'remark')->textarea(['rows' => 6]) ?>

    </div>


    <div class="form-group">
         <?= Html::submitButton($model2->isNewRecord ? 'Save' : 'Update', ['class' => $model2->isNewRecord ? 'btn blue-steel' : 'btn blue-steel']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>