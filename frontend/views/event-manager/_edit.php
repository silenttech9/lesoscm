<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TimePicker;
use marqu3s\summernote\Summernote;
use yii\helpers\Url;
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
<?php $form = ActiveForm::begin(); ?>
<div class="panel panel-default">
    <div class = "panel-heading">Event Information</div>
    <div class="panel-body">
        <div class="event-manager-form">

            

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

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
            <div class="form-group">
                <center>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/uploads/event/<?= $model->img_brochure ?>" class="img-responsive" height='300' width='300'><br>
                    <label class="control-label">Change Image Brochure</label>
                    <?= $form->field($model, 'file')->fileInput()->label(false) ?>
                </center>
                
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class = "panel-heading">Event Session</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-responsive table-condensed table-striped">
                    <tr>
                        <th>Time</th>
                        <th>Activity</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($model2 as $key => $value) {?>
                        <tr>
                            <td width="130"><?= $value->time ?></td>
                            <td><?= $value->activity ?></td>
                            <td><?= Html::a('Update',FALSE, ['value'=>Url::to(['event-session/update','id'=>$value->id]),'class' => 'btn btn-info picCreate'])?>
                                
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        
    </div>
</div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
