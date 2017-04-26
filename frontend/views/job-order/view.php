<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model frontend\models\JobOrder */

$this->title = $model->job_order_no;
$this->params['breadcrumbs'][] = ['label' => 'Job Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="note note-danger">
        <h4 class="block">Current Status : <?= $model->status ?></h4>
        <!-- <p>
            <?php if (isset($model5->text)) { ?>
            <strong>Status Description :</strong> "<?= $model5->text ?> " - By <?= $model6->historyenterby->username ?>
            <?php }?>
        </p> -->
    </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-7 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase">Job Order Number : <?= Html::encode($this->title) ?></span>
                </div>
                <!-- <div class="actions">
                    <b><?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></b>
                </div> -->
                
                <div class="tools actions" >

                    <div class="btn-group">
                        <a class="btn dark btn-outline btn-sm dropdown-toggle" href="javascript:;" data-toggle="dropdown"> Action
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <?php if (Yii::$app->user->identity->department != 'technical') {
                                        if($model->status == 'Awaiting Troubleshoot' || $model->status == 'Work In Progress' ){
                                ?>

                                <?php }else{ ?>
                                    <?= Html::a('Update Status', ['updatestatus_indoor', 'id' => $model->id,'render_state_id'=>$model->render_state_id], ['class' => '']) ?>
                                <?php } }else{ ?>
                                    <?= Html::a('Update Status', ['updatestatus', 'id' => $model->id,'render_state_id'=>$model->render_state_id], ['class' => '']) ?>
                                <?php } ?>
                            </li>
                            <li <?php if(Yii::$app->user->identity->department != 'technical'){ echo 'style="display:none"';} ?>>
                                <?= Html::a('Edit Job Order', ['update', 'id' => $model->id,'render_state_id'=>$model->render_state_id], ['class' => '']) ?>
                            </li>
                            <li>
                                <?= Html::a('Print', ['print', 'id' => $model->id], ['class' => '','target'=>'_BLANK']) ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="job-order-view">

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'job_order_no',
                            'status',
                            'custname.company_name',
                            // 'customer_name',
                            // 'email:email',
                            // 'tel_no',
                            'date_joborder',
                            'pic.salesman',
                            'indoorname.indoor',
                            // 'pic.salesman',
                            'description:ntext',
                            'brand',
                            'model',
                            'serial_no',
                            'accessory',
                            'received_by',
                            'receiver_name',
                            'problem',
                            'tech_finding:ntext',
                            'tech_action_taken:ntext',
                            'tech_spare_part:ntext',
                            // 'item_quote:ntext',
                            [
                                'label' => 'Item To Quote',
                               'format' => ['raw'],
                                'value' => $model->item_quote,
                            ],
                            'done_by',
                            'date_done_by',
                            'checked_by',
                            'date_checked_by',
                            'send_out_by',
                            'date_send_out_by',
                            'remark:ntext',
                            
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase">Customer Person In Charge</span>
                </div>

            </div>
            <div class="portlet-body flip-scroll">
                <table class="table table-bordered table-striped table-condensed flip-content">
                    <tr>
                        <th>Name</th>
                        <th>Telephone No</th>
                    </tr>
                    <tr>
                        <td>
                            <?php if (isset($model2)) {
                                    echo $model2->name;
                                }
                                else{

                                } 
                            ?> 
                        </td>
                        <td>
                            <?php if (isset($model2)) {
                                    echo $model2->country_code_phone.$model2->area_code_phone.$model2->telephone_no;
                                }
                                else{
                                    
                                } 
                            ?>
                        </td>
                    </tr>
                </table>
                
            </div>
        </div>
    </div>
</div>

