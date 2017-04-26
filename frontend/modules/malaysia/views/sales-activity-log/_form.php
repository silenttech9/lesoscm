<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\modules\malaysia\models\CustomerPic;
/* @var $this yii\web\View */
/* @var $model common\models\all\SalesActivityLog */
/* @var $form yii\widgets\ActiveForm */
$custo_ship = ArrayHelper::map(CustomerPic::find()->where(['customer_id'=>$mdl->customer_id])->asArray()->all(), 'id', 'name');

?>

<div class="sales-activity-log-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php echo $form->field($model, 'customer_pic_id')->dropDownList(
        $custo_ship, 
    [
        'prompt' => '-Please Choose-',
        'id' => 'ship_to',

    ]) ?>


    <?= $form->field($model, 'activity')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
