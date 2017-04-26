<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use frontend\models\JobOrder;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JobOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job Order List';
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
$(document).ready(function(){
    var url = window.location.pathname;
    var str = url.split('/index')[0];;
    console.log(str);
    $('.infojoborder').bind('click', function(e){
        e.preventDefault();
        $('.portlethistory').show();
        $("#location-row tr:gt(0)").detach();
        var v = $(this).attr('id');
        
        $.get(str+'/historyjoborder',{id : v},function(data){
            var data = $.parseJSON(data);
            for(var key in data){
                var b = '<tr><td>'+data[key].date_joborder+'</td><td>'+data[key].company_name+'</td><td>'+data[key].status+'</td><td>'+data[key].job_order_no+'</td><td>'+data[key].username+'</td></tr>';
                $('#location-row tr:first').after(b);
            }
        });

        // $.get('job-order/historyjoborder',{id : v},function(data){
        //     var data = $.parseJSON(data);
        //     alert(data.status);
        //     $('.status').text(data.status);
        //     $('.date').text(data.date_joborder);
        //     $('.joborderno').text(data.job_order_no);
        //     $('.enterby').text(data.username);
        // });

        // var v = $(this).attr('id');
        // $.ajax({
        //     url: 'infojoborder',
        //     data: {id: v},
        //     success: function(data) {
        //         $('.showhistory').show();
        //         $('.portlethistory').show();
        //         $('.showhistory').html(data);
        //     }
        // });
    });

    $('#close').on('click', function(){
        $('.portlethistory').hide();
    });

});
JS;
$this->registerJs($script);
?>
<div class="row portlethistory">
    <div class="col-md-12">
        <div class="portlet light ">
            
            <div class="portlet-body">

                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/bystatus?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>&status=Awaiting Troubleshoot" class="icon-btn">
                    <i class="fa fa-gear"></i>
                    <div> Awaiting <br>Troubleshoot </div>
                    <?php $count = JobOrder::troubleshoot(Yii::$app->request->get('render_state_id')); ?>
                    <span class="<?php echo ($count != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count != 0 ? $count : '');  ?></span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/bystatus?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>&status=Work In Progress" class="icon-btn">
                    <i class="fa fa-wrench"></i>
                    <div> Work In<br>Progress </div>
                    <?php $count1 = JobOrder::wip(Yii::$app->request->get('render_state_id'));  ?>
                    <span class="<?php echo ($count1 != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count1 != 0 ? $count1 : ''); ?>  </span>
                </a>
                
                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/bystatus?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>&status=Warranty Claim" class="icon-btn">
                    <i class="fa fa-check-circle-o"></i>
                    <div> Warranty<br>Claim </div>
                    <?php $count2 = JobOrder::wc(Yii::$app->request->get('render_state_id'));?>
                    <span class="<?php echo ($count2 != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count2 != 0 ? $count2 : ''); ?></span>
                </a>
                
                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/bystatus?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>&status=Awaiting To Quote" class="icon-btn">
                    <i class="fa fa-file-word-o"></i>
                    <div> Awaiting <br>Quote </div>
                    <?php $count3 = JobOrder::aq(Yii::$app->request->get('render_state_id'));?>
                    <span class="<?php echo ($count3 != 0 ? 'badge badge-danger' : ''); ?>"> <?php echo ($count3 != 0 ? $count3 : ''); ?></span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/bystatus?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>&status=Beyond Repair" class="icon-btn">
                    <i class="fa fa-wrench"></i>
                    <div> Beyond <br>Repair </div>
                    <?php $count4 = JobOrder::br(Yii::$app->request->get('render_state_id'));?>
                    <span class="<?php echo ($count4 != 0 ? 'badge badge-danger' : ''); ?>"> <?php echo ($count4 != 0 ? $count4 : ''); ?></span>
                </a>
                
                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/bystatus?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>&status=Customer Confirm" class="icon-btn">
                    <i class="fa fa-thumbs-up">
                    </i>
                    <div> Customer<br>Confirm </div>
                    <?php $count5 = JobOrder::cc(Yii::$app->request->get('render_state_id'));?>
                    <span class="<?php echo ($count5 != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count5 != 0 ? $count5 : ''); ?></span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/bystatus?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>&status=Customer Reject" class="icon-btn">
                    <i class="fa fa-close"></i>
                    <div> Customer<br>Reject </div>
                    <?php $count6 = JobOrder::cr(Yii::$app->request->get('render_state_id'));?>
                    <span class="<?php echo ($count6 != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count6 != 0 ? $count6: ''); ?></span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/bystatus?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>&status=Awaiting Spare Part" class="icon-btn">
                    <i class="fa fa-wrench"></i>
                    <div> Awaiting Spare<br>Part </div>
                    <?php $count7 = JobOrder::asp(Yii::$app->request->get('render_state_id'));?>
                    <span class="<?php echo ($count7 != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count7 != 0 ? $count7 : ''); ?></span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/bystatus?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>&status=Arrange Delivery" class="icon-btn">
                    <i class="fa fa-truck"></i>
                    <div> Arrange<br>Delivery </div>
                    <?php $count8 = JobOrder::ad(Yii::$app->request->get('render_state_id'));?>
                    <span class="<?php echo ($count8 != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count8 != 0 ? $count8 : ''); ?></span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/bystatus?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>&status=Send To Supplier" class="icon-btn">
                    <i class="fa fa-truck"></i>
                    <div> Send To <br>Supplier </div>
                    <?php $count9 = JobOrder::ss(Yii::$app->request->get('render_state_id'));?>
                    <span class="<?php echo ($count9 != 0 ? 'badge badge-danger' : ''); ?>"> <?php echo ($count9 != 0 ? $count9 : ''); ?></span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/bystatus?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>&status=Quoted" class="icon-btn">
                    <i class="fa fa-money"></i>
                    <div> Quoted </div>
                    <?php $count10 = JobOrder::quote(Yii::$app->request->get('render_state_id'));?>
                    <span class="<?php echo ($count10 != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count10 != 0 ? $count10 : ''); ?></span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/index?render_state_id=<?php echo Yii::$app->request->get('render_state_id') ?>" class="icon-btn">
                    <i class="fa fa-edit"></i>
                    <div> All </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="actions" <?php if(Yii::$app->user->identity->department != 'technical'){ echo 'style="display:none"';} ?>>
                      <b><?= Html::a('Add More', ['create','render_state_id'=>$render_state_id], ['class' => 'btn blue-steel']) ?></b>
                </div>
                <br><br>
                 <?php echo $this->render('_search', ['model' => $searchModel,'render_state_id'=>$render_state_id]); ?>
                <div class="row">
                    <div class='col-xs-12 table-responsive'>
                        <div class="portlet-body">
                            <div class="job-order-index">
                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    // 'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                            
                                            'date_joborder',
                                            'job_order_no',
                                            'custname.company_name',
                                            
                                            'status',
                                            'indoorname.indoor',
                                            // 'state.state',
                                            // 'tel_no',
                                            // 'salesman',
                                            // 'brand',
                                            // 'model',
                                            // 'description:ntext',
                                            // 'serial_no',
                                            // 'received_by',
                                            // 'receiver_name',
                                            // 'problem',
                                            // 'tech_finding:ntext',
                                            // 'tech_action_taken:ntext',
                                            // 'tech_spare_part:ntext',
                                            // 'done_by',
                                            // 'date_done_by',
                                            // 'checked_by',
                                            // 'date_checked_by',
                                            // 'send_out_by',
                                            // 'date_send_out_by',
                                            // 'remark:ntext',
                                            // 'status',

                                        // ['class' => 'yii\grid\ActionColumn'],
                                        [
                                            'header' => 'Action',
                                            'class' => 'yii\grid\ActionColumn',
                                            'template'=>'{view} {update} {delete} {historyjoborder}',
                                            'buttons' => [
                                                'view' => function ($url, $model) {
                                                    return Html::a('View', 
                                                        $url,['title'=> Yii::t('app','View'),'class'=>'btn blue-chambray']);

                                                },
                                                'update' => function ($url, $model) {
                                                    if (Yii::$app->user->identity->department != 'technical') {
                                                        
                                                    }
                                                    else{
                                                        return Html::a('Update', 
                                                        $url,['title'=> Yii::t('app','Update'),'class'=>'btn blue-chambray']);
                                                    }
                                                    

                                                },
                                                'delete' => function ($url, $model) {
                                                    return Html::a('Delete', 
                                                        $url,['title'=> Yii::t('app','Delete'),'class'=>'btn blue-chambray','data-confirm'=>"Are You Sure Want To Delete This Item ?",'data-method' => 'post']);

                                                },
                                                'historyjoborder' => function ($url, $model) {
                                                        return Html::a('History',FALSE, $url, ['title' => Yii::t('app', 'History')]);
                                                },

                                            ],
                                            'urlCreator' => function ($action, $model, $key, $index) {
                                                if ($action === 'view') {
                                                    $url = ['job-order/view','id'=>$model->id];
                                                    return $url;
                                                }
                                                if ($action === 'update') {
                                                    $url = ['job-order/update','id'=>$model->id,'render_state_id'=>$model->render_state_id];
                                                    return $url;
                                                }
                                                if ($action === 'delete') {
                                                    $url = ['job-order/delete','id'=>$model->id,'render_state_id'=>$model->render_state_id];
                                                    return $url;
                                                }
                                                if ($action === 'historyjoborder') {
                                                    // $url = ['historyjoborder','id'=>$model->id];
                                                    $url = ['value'=>Url::to(['historyjoborder','id'=>$model->id]),'class'=>'btn blue-chambray activityView'];
                                                    return $url;
                                                }
                                            }
                                        ],
                                    ],
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

