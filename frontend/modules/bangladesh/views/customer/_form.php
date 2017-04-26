<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\LookupCountry;
use common\models\LookupState;
use common\models\LookupTerm;
use yii\helpers\ArrayHelper;
use common\models\LookupStax;
use common\models\LookupPhoneCountryCode;
use common\models\LookupArea;
use common\models\LookupAgent;
use frontend\models\User;
use common\models\LookuproleCust;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\Customer */
/* @var $form yii\widgets\ActiveForm */

$country = ArrayHelper::map(LookupCountry::find()->where(['id'=>8])->asArray()->all(),'id','country'); 
$state = ArrayHelper::map(LookupState::find()->where(['country_id'=>$model->country_id])->asArray()->all(),'id','state'); 
$term = ArrayHelper::map(LookupTerm::find()->where(['module_id'=>$module_id])->asArray()->all(),'id','term'); 
$stax = ArrayHelper::map(LookupStax::find()->where(['module_id'=>$module_id])->asArray()->all(),'id','CODE');
$role_cust = ArrayHelper::map(LookuproleCust::find()->asArray()->all(),'id','role_cust');  
$country_code = ArrayHelper::map(LookupPhoneCountryCode::find()->where(['active'=>['Yes'],'id'=>18])->asArray()->all(),'code','code');

//$sales_agent = ArrayHelper::map(User::find()->joinWith('notify')->where(['user_notify.user_notify_role'=>['2'],'user.state_id'=>13])->asArray()->all(),'id','username');
if ($model->isNewRecord) { 
$sales_agent = ArrayHelper::map(LookupAgent::find()->where(['module_id'=>$module_id])->asArray()->all(),'id','agent'); 
echo "<span id='render_state' class='".$module_id."'></span>";
$area = ArrayHelper::map(LookupArea::find()->where(['module_id'=>$module_id])->asArray()->all(),'id','area'); 


} else {
    $sales_agent = ArrayHelper::map(LookupAgent::find()->where(['module_id'=>$model->module_id])->asArray()->all(),'id','agent'); 
    echo "<span id='render_state' class='".$model->module_id."'></span>";

    $area = ArrayHelper::map(LookupArea::find()->where(['module_id'=>$model->module_id])->asArray()->all(),'id','area'); 
}



?>
<?php if(Yii::$app->session->hasFlash('createPic')) { ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert"></button>
         <?php echo  Yii::$app->session->getFlash('createPic'); ?>
    </div>
<?php } elseif(Yii::$app->session->hasFlash('updatePic')) { ?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert"></button>
         <?php echo  Yii::$app->session->getFlash('updatePic'); ?>
    </div>
<?php } elseif(Yii::$app->session->hasFlash('deletePic')) {?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert"></button>
         <?php echo  Yii::$app->session->getFlash('deletePic'); ?>
    </div>
<?php }?>
    <div class="panel-group accordion" id="accordion3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1">Company Information </a>
                </h4>
            </div>
            <div id="collapse_3_1" class="panel-collapse in">
                <div class="panel-body">
                    <div class="selangor-customer-form">

                        <?php $form = ActiveForm::begin(); ?>

                        <?php if ($model->isNewRecord) { ?>
                            <?= $form->field($model, 'company_name')->textInput(['maxlength' => true,'id'=>'searchTry','class'=>'form-control '.$module_id,'style'=>'text-transform:uppercase']) ?>
                        <?php } else { ?>
                            <?= $form->field($model, 'company_name')->textInput(['maxlength' => true,'id'=>'searchTry','class'=>'form-control '.$model->module_id,'style'=>'text-transform:uppercase']) ?>
                        <?php } ?>
                        

                                        
                        <!-- BEGIN PORTLET-->
                        <div class="portlet light bordered" id="resultDiv" style="display:none;">

                                <div class="scroller" id="result" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                </div>
                      
                        </div>
                                        
                        <?= $form->field($model, 'address')->textarea(['rows' => 6,'style'=>'text-transform:uppercase']) ?>

                        <div class="form-group field-selangorcustomer-telephone_no has-success">
                            <label class="control-label" for="selangorcustomer-telephone_no">Telephone No</label>
                                <div class="form-inline" >

                                    <?= $form->field($model, 'country_code_phone')->dropDownList($country_code,['prompt' => '','class'=>'form-control input-xsmall'])->label(false) ?> - 
                                    <?= $form->field($model, 'area_code_phone')->textInput(['maxlength' => 5,'class'=>'form-control input-xsmall','id'=>'mask_number'])->label(false)  ?>
                                    <?= $form->field($model, 'telephone_no')->textInput(['maxlength' => 10,'class'=>'form-control input-small','id'=>'mask_number'])->label(false)  ?>
                                    
                                </div>
                        <br>
                        <div class="country-info"></div>

                        </div>

                        <div class="form-group field-selangorcustomer-telephone_no has-success">
                            <label class="control-label" for="selangorcustomer-telephone_no">Fax No</label>
                                <div class="form-inline" >

                                    <?= $form->field($model, 'country_code_fax')->dropDownList($country_code,['prompt' => '','class'=>'form-control input-xsmall'])->label(false) ?> - 
                                    <?= $form->field($model, 'area_code_fax')->textInput(['maxlength' => 5,'class'=>'form-control input-xsmall','id'=>'mask_number'])->label(false)  ?>
                                    <?= $form->field($model, 'fax_no')->textInput(['maxlength' => 10,'class'=>'form-control input-small','id'=>'mask_number'])->label(false)  ?>
                                    
                                </div>

                        </div>

                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'city')->textInput(['maxlength' => true,'style'=>'text-transform:uppercase']) ?>



                        <?= $form->field($model, 'country_id')->dropDownList($country, 
                        [
                            'prompt' => '-Please Choose-',
                            'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl(['/bangladesh/customer/state','id'=>'']).'"+$(this).val(), function(data){$("select#state-id").html(data);})',

                        ]) ?>


                        <?= $form->field($model, 'state_id')->dropDownList($state, 
                        [
                            'prompt' => '-Please Choose-',
                            'id'=> 'state-id'

                        ]) ?>

                        <?= $form->field($model, 'crlimit')->textInput() ?>

                        <?= $form->field($model, 'term_id')->dropDownList($term, 
                        [
                            'prompt' => '-Please Choose',

                        ]) ?>

                        <?= $form->field($model, 'area_code_id')->dropDownList($area, 
                        [
                            'prompt' => '-Please Choose-',

                        ]) ?>

                        <?= $form->field($model, 'agent_id')->dropDownList($sales_agent, 
                        [
                            'prompt' => '-Please Choose-',

                        ]) ?>

                        <?= $form->field($model, 'staxcode_id')->dropDownList($stax, 
                        [
                            'prompt' => '-Please Choose',

                        ]) ?>
                        <?= $form->field($model, 'type_cust')->dropDownList($role_cust, 
                        [
                            'prompt' => '-Please Choose',

                        ]) ?>



                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn blue-steel' : 'btn blue-steel']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
                
            </div>
        </div>
        <?php if ($model->isNewRecord) { ?>
        <?php } else {?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2">Customer Person In Charge </a>
                </h4>
            </div>
            <div id="collapse_3_2" class="panel-collapse collapse">
                <div class="panel-body">
                    

                        
                            
                            <div class="caption">
                                <span class="caption-subject bold uppercase font-dark">Customer Person In Charge</span>
                                <span class="pull-right">
                                    <?= Html::a('Add More',FALSE, ['value'=>Url::to(['customer-pic/create','id'=>$model->id,'module_id'=>$model->module_id]),'class' => 'btn btn-sm blue-chambray picCreate','id'=>'picCreate','title' => 'Add Customer PIC',]) ?> 
                                </span>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 table-responsive">
                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            'name',
                                            [
                                                'attribute' => 'Telephone',
                                             
                                                'value' => function($model) {
                                                    return $model->country_code_phone.$model->area_code_phone.$model->telephone_no;
                                                }
                                            ],
                                            'extension',
                                            [
                                                'attribute' => 'Mobile No',
                                             
                                                'value' => function($model) {
                                                    return $model->country_code_mobile.$model->area_code_mobile.$model->mobile_no;
                                                }
                                            ],
                                            'email:email',
                                            [
                                                'header' => 'Action',
                                                'class' => 'yii\grid\ActionColumn',
                                                'template'=>'{view}   {edit}   {delete}',
                                                    'buttons' => [
                                                        'view' => function ($url, $model) {
                                                            return Html::a('View',FALSE, $url);

                                                        },

                                                        'edit' => function ($url, $model) {
                                                            return Html::a('Edit',FALSE, $url);
                                                        },

                                                        'delete' => function ($url, $model) {
                                                            return Html::a('Delete', $url, [
                                                                            'data-method' => 'post',

                                                                            'title' => 'Delete',
                                                                            'class' => 'btn btn-sm blue-chambray'
                                                            ]);

                                                        },



                                                    ],
                                                    'urlCreator' => function ($action, $model, $key, $index) {

                                                        if ($action === 'view') {
                                                            $url = ['value'=>Url::to(['customer-pic/view','id'=>$model->id]),'class'=>'btn btn-sm blue-chambray picView','title'=>'View'];
                                                            return $url;
                                                        }
                                                        if ($action === 'edit') {
                                                            $url = ['value'=>Url::to(['customer-pic/update','id'=>$model->id,'module_id'=>12]),'class'=>'btn btn-sm blue-chambray picUpdate','title'=>'Edit'];
                                                            return $url;
                                                        }
                                                        if ($action === 'delete') {
                                                            $url = ['customer-pic/delete','id'=>$model->id,'customer_id'=>$model->customer_id,'module_id'=>12];
                                                            return $url;
                                                        }

                                                    }
                                                ],



                                        ],
                                        'tableOptions' =>['class' => 'table table-striped table-hover'],
                                    ]); ?>
                            
                                </div>
                            </div>
                                
                </div>
            </div>
        </div>
        <?php } ?>
    </div>


<hr>

