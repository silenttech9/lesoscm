<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TimePicker;
use marqu3s\summernote\Summernote;
/* @var $this yii\web\View */
/* @var $model frontend\models\EventManager */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
$(document).ready(function(){
    $("#addmoresesi").click(function(){
        var c = $("#itemorder").clone();
        c.find("input[type=text]").val("");
        c.appendTo(".adddivorder");
        $('div#del').not(':first').show();
        $('.horizontal').not(':first').show(500);
        $(".time-picker").timepicker();
    });

    $(".adddivorder").on("click", "#removeorder", function(e) {
        e.preventDefault();
        $(this).fadeOut("slow", function(){ 
            $(this).closest("#itemorder").remove();
            $(this).closest(".horizontal").remove();  
        });
    });
});
JS;
$this->registerJs($script);


?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="panel panel-default">
    <div class = "panel-heading">Event Information</div>
    <div class="panel-body">
        <div class="event-manager-form">

            

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'organizer_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'organizer_email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone_organizer')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'objective_event')->widget(Summernote::className(), [
                'options' => ['rows' => 6],
            ]) ?>

            <?= $form->field($model, 'date_event')->textInput(['maxlength' => true,'class'=>'form-control date-picker','data-date-format'=>'yyyy-mm-dd']) ?>
            <?= $form->field($model, 'reg_due_date')->textInput(['maxlength'=>true,'class'=>'form-control date-picker','data-date-format'=>'yyyy-mm-dd']) ?>

            <label class="control-label" for="eventmanager-time_event_end">Begin Time</label>
            <?= $form->field($model, 'time_event_start')->widget(TimePicker::classname(), [])->label(false); ?>
                    
            <label class="control-label" for="eventmanager-time_event_end">End Time</label>
            <?= $form->field($model, 'time_event_end')->widget(TimePicker::classname(), [])->label(false); ?>
                    

            <!-- <?= $form->field($model, 'time_event_start')->textInput(['maxlength' => true]) ?> -->

            <!-- <?= $form->field($model, 'time_event_end')->textInput(['maxlength' => true]) ?> -->

            <?= $form->field($model, 'venue_event')->textInput(['maxlength' => true,'placeholder'=>'Eg. Lesoshoppe Penang']) ?>

            <?= $form->field($model, 'address_event')->widget(Summernote::className(), [
                'options' => ['rows' => 6],


            ]) ?>
            <!-- <?= $form->field($model, 'objective_event')->textarea(['rows' => 6]) ?> -->
            

            <?= $form->field($model, 'max_participant_perevent')->textInput() ?>

            <?= $form->field($model, 'max_participant_percompany')->textInput() ?>

            <?= $form->field($model, 'fee_event')->textInput(['maxlength'=>true,'placeholder'=>'FOC (unless otherwise stated)']) ?>

            <?= $form->field($model, 'incentive_company')->textInput(['maxlength'=>true,'placeholder'=>'Participation incentives for Company']) ?>

            <?= $form->field($model, 'incentive_attendee')->textInput(['maxlength'=>true,'placeholder'=>'Participation incentives for Attendee']) ?>
            <?= $form->field($model, 'file')->fileInput() ?>

        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class = "panel-heading">Event Session</div>
    <div class="panel-body">
        <!-- <?= Html::a('Add More',FALSE, ['id'=>'addmoresesi','class' => 'btn blue-steel']) ?> -->
        <div class="adddivorder">
            <div id='itemorder'>
                <hr class='horizontal' style='display:none;'>
                <div class="row">
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="col-md-4">
                                <label class="control-label">Time</label>
                                <input type="text" id="eventsession-time" class="form-control time-picker" name="EventSession[time][]" data-krajee-timepicker="timepicker_00000000">
                                <!-- <?= $form->field($model2, 'time')->widget(TimePicker::classname(), ['class'=>'form-control time-picker'])->label(); ?> -->
                            </div>
                            <div class="col-md-8">
                                <!-- <?= $form->field($model2, 'activity[]')->textInput(['maxlength' => true]) ?> -->
                                <?= $form->field($model2, 'activity[]')->textarea(['rows' => 6]) ?>
                            </div>
                            <div class="col-md-1" id="del"  style="display:none;">
                                <div class="form-group">
                                    <input type="button" id="removeorder" class="btn red-sunglo"  value="Delete">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="pull-right"><?= Html::a('Add More',FALSE, ['id'=>'addmoresesi','class' => 'btn blue-steel']) ?></p>
    </div>
</div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
