<?php

use yii\helpers\Html;
use frontend\models\JobOrder;
/* @var $this yii\web\View */

$this->title = 'Job Order';

$joborder = JobOrder::joborder();
$listjoborder = JobOrder::joborderlist();
foreach ($joborder as $key => $value) {
    $totaljoborder = $value['totalJoborder'];
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PORTLET -->
        <div class="portlet light  tasks-widget">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font hide"></i>
                    <span class="caption-subject font-blue-madison bold uppercase">Job Order</span>
                    <span class="caption-helper"><?php echo $totaljoborder; ?> Today (<?php echo date( 'd-m-Y' ) ?>)</span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="task-content">
                    <div class="scroller" style="height: 150px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                        <!-- START TASK LIST -->
                        <ul class="task-list">

                        <?php foreach ($model as $key => $value) { ?>
                            
                            <li>
                                <div class="task-title">
                                    <span class="label label-sm label-success">Job Order</span>
                                    <span class="task-title-sp"> 
                                        <?= Html::a($value["job_order_no"]." - ".$value["text"],['job-order/view','id'=>$value['job_order_id'],'notify'=>$value['id']]) ?>    
                                    </span>
                                    <span class="task-bell">
                                        <i class="fa fa-bell-o"></i>
                                         ( <?php echo date('d/m/Y h:i:s',strtotime($value['date_receive']))  ?> )
                                    </span>
                                    
                                </div>
                                <!-- <div class="task-config">
                                    <div class="task-config-btn btn-group">
                                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <i class="fa fa-cog"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        
                                    </div>
                                </div> -->
                            </li>

                        <?php } ?>


                        </ul>
                        <!-- END START TASK LIST -->
                    </div>
                </div>
     
            </div>
        </div>
        <!-- END PORTLET -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light tasks-widget">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font hide"></i>
                    <span class="caption-subject font-blue-madison bold uppercase">Job Order List</span>
                    <span class="caption-helper"><?php echo $model3; ?> All</span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="task-content">
                    <div class="scroller" style="height: 150px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                        <!-- START TASK LIST -->
                        <ul class="task-list">

                        <?php foreach ($model2 as $key => $value) { ?>
                            
                            <li>
                                <div class="task-title">
                                    <span class="label label-sm label-success">Job Order</span>
                                    <span class="task-title-sp"><?= Html::a($value["job_order_no"]." - ".$value["text"],['job-order/view','id'=>$value['id']]) ?></span>
                                    <span class="task-bell">
                                        <i class="fa fa-bell-o"></i>
                                         ( <?php echo date('d/m/Y h:i:s',strtotime($value['date_receive']))  ?> )
                                    </span>
                                   
                                </div>
                                <!-- <div class="task-config">
                                    <div class="task-config-btn btn-group">
                                        <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <i class="fa fa-cog"></i>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        
                                    </div>
                                </div> -->
                            </li>

                        <?php } ?>


                        </ul>
                        <!-- END START TASK LIST -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


       
