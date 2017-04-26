<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use marqu3s\summernote\Summernote;
/* @var $this yii\web\View */
/* @var $model common\models\Stock */

$this->title = 'Stock';
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="portlet-body">
        <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
				    <h1><?= Html::encode($this->title) ?></h1>
				        <div class="full-height-content-body">

						<div class="stock-form">

						    <?php $form = ActiveForm::begin(); ?>

						    <?= $form->field($model, 'brand')->textInput(['maxlength' => true,'class'=>'form-control']) ?>

						    <?= $form->field($model, 'ITEM_NO')->textInput(['maxlength' => true,'class'=>'form-control']) ?>

					<?= $form->field($model, 'DESCRIPTION')->textArea(['rows' => 6]) ?>


						    <div class="form-group">
						        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn blue-steel' : 'btn blue-steel']) ?>
						    </div>

						    <?php ActiveForm::end(); ?>

						</div>



						</div>
    			</div>

		</div>
	</div>