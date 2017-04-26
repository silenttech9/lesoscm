<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Stock;
use common\models\LookupUnitOfMeasure;


$uom = ArrayHelper::map(LookupUnitOfMeasure::find()->where(['module_id'=>8])->asArray()->all(), 'id', 'unit_of_measure');

//$stock = ArrayHelper::map(Stock::find()->where(['id'=>$model->stock_id])->asArray()->all(),'id','ITEM_NO'); 

?>

<div class="quotation-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($item == 'quantity') { ?>

    	<?= $form->field($model, 'quantity')->textInput() ?>

    <?php } elseif ($item == 'unit') { ?>

    	<?= $form->field($model, 'unit')->dropDownList($uom) ?>

    <?php } elseif ($item == 'price') { ?>

    	<?= $form->field($model, 'price')->textInput() ?>

    <?php } ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>