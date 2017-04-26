<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use frontend\models\EventManager;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model frontend\models\EventRegParticipant */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Add Participant';
?>
<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="event-reg-participant-form">

                    <?php $form = ActiveForm::begin(); ?>
                    <?php 
                        // $url = \yii\helpers\Url::to(['custs']);
                        // $cName = empty($model->customer_id) ? '' : EventManager::findOne($model->customer_id)->company_name;
                        echo $form->field($model, 'event_id')->widget(Select2::classname(), [
                            // 'initValueText' => $cName, // set the initial display text
                             'data' => ArrayHelper::map(EventManager::find()->all(), 'id', 'title'),
                            'options' => [
                               'placeholder' => 'Search Title Event ...',
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 1,
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                ],

                            ],
                        ]); 
                    ?>
                    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model2, 'name_participant')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model2, 'email')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model2, 'designation')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model2, 'mobile_phone')->textInput(['maxlength' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

