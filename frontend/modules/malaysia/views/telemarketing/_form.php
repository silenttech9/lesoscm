<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\LookupProgramProduct;
use frontend\models\User;

if ($model->isNewRecord) {
    $product = ArrayHelper::map(LookupProgramProduct::find()->asArray()->all(), 'id', 'program_product');



$telemarketers = ArrayHelper::map(User::find()->joinWith(['role','akses'])->where(['user_role.user_role'=>['Indoor'],'user_state_akses.state_akses'=>$state_id])->asArray()->all(),'id','username'); 



} else {

    
    $product = ArrayHelper::map(LookupProgramProduct::find()->asArray()->all(), 'id', 'program_product');
    
$telemarketers = ArrayHelper::map(User::find()->joinWith(['role','akses'])->where(['user_role.user_role'=>['Indoor'],'user_state_akses.state_akses'=>$model->state_id])->asArray()->all(),'id','username'); 


}

?>

<div class="telemarketing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->isNewRecord) {  ?>

        <?= $form->field($model, 'datetime')->textInput(['maxlength' => true,'value'=>date('Y/m/d H:i:s A'),'readOnly'=>'readOnly']) ?>

    <?php } else { ?>

        <label>Date Time</label>
        <br>
        <span><b><?php echo $model->datetime; ?></b></span>   
        <br><br>
     

    <?php } ?>

    <?= $form->field($model, 'program_product_id')->dropDownList($product, 
    [
        'prompt' => '-Please Choose',
        'class' => 'form-control'

    ])?>

    <?= $form->field($model, 'telemarketers_id')->dropDownList($telemarketers, 
    [
        'prompt' => '-Please Choose',

    ]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
