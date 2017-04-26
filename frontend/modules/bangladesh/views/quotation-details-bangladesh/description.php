<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Stock;
use marqu3s\summernote\Summernote;


?>

<div class="quotation-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'extra_description')->widget(Summernote::className(), [
        'options' => ['rows' => 6],

    ]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>