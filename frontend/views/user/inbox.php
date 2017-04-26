<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Message';


?>
       <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <div class="portlet light  tasks-widget">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Message</span>
                            <span class="caption-helper"><?php echo $todayMessage; ?> Today (<?php echo date( 'd-m-Y' ) ?>)</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="task-content">
                            <div class="scroller" style="height: 150px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                <!-- START TASK LIST -->
                                <ul class="task-list">

                                <?php foreach ($today as $key => $value) { ?>
                                    
                                    <li>
                                        <div class="task-title">

                                                <?php if ($value['module'] == "Sales Activity") { ?>
                                                    <span class="label label-sm label-warning"><?php echo $value['module']; ?></span>
                                                    - <b><?php echo $value['sub_module']; ?></b>
                                                <?php } elseif ($value['module'] == "Telemarketing") { ?>
                                                    <span class="label label-sm label-success"><?php echo $value['module']; ?></span>
                                                    - <b><?php echo $value['sub_module']; ?></b>
                                                <?php } ?>


                                            <span class="task-title-sp"> <?php echo $value['log_message'] ?> </span>

                                        </div>


                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                    <i class="fa fa-cog"></i>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <?php if ($value['status'] == 'Complete') { ?>
                                                  
                                                    <?php } else { ?>
                                                        <li>
                                                            <?= Html::a('<i class="fa fa-check"></i>Complete', ['solve','id'=>$value['message_id']]) ?>
                                                        </li>
                                                        <?php if ($value['module'] == "Sales Activity") { 
                                                                if (Yii::$app->user->identity->module_id == 1) {
                                                        ?>
                                                            <li>
                                                                <?= Html::a('View Details', ['/malaysia/sales-activity/show','id'=>$value['id_module']]) ?>
                                                            </li>
                                                        <?php }elseif(Yii::$app->user->identity->module_id == 3){ ?> 
                                                            <li>
                                                                <?= Html::a('View Details', ['/thailand/sales-activity/show','id'=>$value['id_module']]) ?>
                                                            </li>
                                                        <?php }elseif(Yii::$app->user->identity->module_id == 12){ ?>
                                                            <li>
                                                                <?= Html::a('View Details', ['/philippines/sales-activity/show','id'=>$value['id_module']]) ?>
                                                            </li>
                                                        <?php }elseif(Yii::$app->user->identity->module_id == 8){ ?>
                                                            <li>
                                                                <?= Html::a('View Details', ['/bangladesh/sales-activity/show','id'=>$value['id_module']]) ?>
                                                            </li>
                                                        <?php } ?>
                                                        <?php 
                                                            } elseif ($value['module'] == "Telemarketing") { 
                                                                if (Yii::$app->user->identity->module_id == 1) {
                                                        ?>
                                                            <li>
                                                                <?= Html::a('View Details', ['/malaysia/telemarketing/show','id'=>$value['id_module']]) ?>
                                                            </li>
                                                        <?php }elseif(Yii::$app->user->identity->module_id == 3){ ?>
                                                                <li>
                                                                    <?= Html::a('View Details', ['/thailand/telemarketing/show','id'=>$value['id_module']]) ?>
                                                                </li>
                                                        <?php }elseif(Yii::$app->user->identity->module_id == 12){?>
                                                                <li>
                                                                    <?= Html::a('View Details', ['/philippines/telemarketing/show','id'=>$value['id_module']]) ?>
                                                                </li>
                                                        <?php }elseif(Yii::$app->user->identity->module_id == 8){?>
                                                                <li>
                                                                    <?= Html::a('View Details', ['/bangladesh/telemarketing/show','id'=>$value['id_module']]) ?>
                                                                </li>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>

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
                <!-- BEGIN PORTLET -->
                <div class="portlet light  tasks-widget">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Message</span>
                            <span class="caption-helper"><?php echo $allMessage; ?> All</span>
                        </div>

                    </div>
                    <div class="portlet-body">

  
                        <table data-toggle="table" data-height='600'>
                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Message</th>
                                    <th>Date time / Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all as $key => $value) { ?>
                            <tr>
                                <td>
                                    <?php if ($value['module'] == "Sales Activity") { ?>
                                        <span class="label label-sm label-warning"><?php echo $value['module']; ?></span>
                                        - <b><?php echo $value['sub_module']; ?></b>

                                    <?php } elseif ($value['module'] == "Telemarketing") { ?>
                                        <span class="label label-sm label-success"><?php echo $value['module']; ?></span>
                                        - <b><?php echo $value['sub_module']; ?></b>

                                    <?php } ?>
                                    
                                </td>
                                <td><?php echo $value['log_message'] ?></td>

                                <td>
                                
                                    <?php if ($value['module'] == "Sales Activity") { ?>
      
                              
                                            ( <?php echo $value['date_create'] ?> )
                               
                                        <?php if ($value['status'] == "Complete") { ?>
                                            <span class="label label-sm label-info"><?php echo $value['status']; ?></span>

                                        <?php } else { ?>
                                            <span class="label label-sm label-danger"><?php echo $value['status']; ?></span>
                                        <?php } ?>
                    

                                    <?php } elseif ($value['module'] == "Telemarketing") { ?>
                                    
                    
                                            ( <?php echo $value['date_create'] ?> )
                                      
                                        <?php if ($value['status'] == "Complete") { ?>
                                            <span class="label label-sm label-info"><?php echo $value['status']; ?></span>
                                        <?php } else { ?>
                                            <span class="label label-sm label-danger"><?php echo $value['status']; ?></span>
                                        <?php } ?>


                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($value['status'] == 'Complete') { ?>
                                                <?php if ($value['module'] == "Sales Activity") {
                                                        if (Yii::$app->user->identity->module_id == 1){ 
                                                ?>
                                                            <?= Html::a('<i class="fa fa-file-o"></i>', ['/malaysia/sales-activity/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>
                                                    <?php }elseif(Yii::$app->user->identity->module_id == 3){ ?>
                                                            <?= Html::a('<i class="fa fa-file-o"></i>', ['/thailand/sales-activity/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>
                                                    <?php }elseif(Yii::$app->user->identity->module_id == 12){?>
                                                            <?= Html::a('<i class="fa fa-file-o"></i>', ['/philippines/sales-activity/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>
                                                    <?php } elseif(Yii::$app->user->identity->module_id == 8){ ?>
                                                            <?= Html::a('<i class="fa fa-file-o"></i>', ['/bangladesh/sales-activity/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>
                                                    <?php } ?>
                                                <?php }elseif ($value['module'] == "Telemarketing") { 
                                                        if (Yii::$app->user->identity->module_id == 1){
                                                ?>
                                                            <?= Html::a('<i class="fa fa-file-o"></i>', ['/malaysia/telemarketing/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>
                                                    <?php }elseif(Yii::$app->user->identity->module_id == 3){ ?>
                                                            <?= Html::a('<i class="fa fa-file-o"></i>', ['/thailand/telemarketing/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>
                                                    <?php }elseif(Yii::$app->user->identity->module_id == 12){?>
                                                            <?= Html::a('<i class="fa fa-file-o"></i>', ['/philippines/telemarketing/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>
                                                    <?php } elseif(Yii::$app->user->identity->module_id == 8){ ?>
                                                            <?= Html::a('<i class="fa fa-file-o"></i>', ['/bangladesh/telemarketing/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>
                                                    <?php } ?>
                                                <?php }?>

                                            
                                    <?php } else { ?>

                                                <?= Html::a('<i class="fa fa-check"></i>', ['solve','id'=>$value['message_id']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'Complete']) ?>
                                            
                                                <?php if ($value['module'] == "Sales Activity") {
                                                    if (Yii::$app->user->identity->module_id == 1){
                                                 ?>
                                                    <?= Html::a('<i class="fa fa-file-o"></i>', ['/malaysia/sales-activity/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>

                                                 <?php }elseif(Yii::$app->user->identity->module_id == 3){ ?>
                                                    <?= Html::a('<i class="fa fa-file-o"></i>', ['/thailand/sales-activity/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>

                                                 <?php } elseif(Yii::$app->user->identity->module_id == 12){?>
                                                    <?= Html::a('<i class="fa fa-file-o"></i>', ['/philippines/sales-activity/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>

                                                 <?php } elseif(Yii::$app->user->identity->module_id == 8){ ?>
                                                    <?= Html::a('<i class="fa fa-file-o"></i>', ['/bangladesh/sales-activity/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>
                                                 <?php } ?>
                                                <?php } elseif ($value['module'] == "Telemarketing") { 
                                                    if (Yii::$app->user->identity->module_id == 1){
                                                ?>
                                                    <?= Html::a('<i class="fa fa-file-o"></i>', ['/malaysia/telemarketing/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>
                                                <?php }elseif(Yii::$app->user->identity->module_id == 3){ ?>
                                                    <?= Html::a('<i class="fa fa-file-o"></i>', ['/thailand/telemarketing/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>

                                                 <?php } elseif(Yii::$app->user->identity->module_id == 12){?>
                                                   <?= Html::a('<i class="fa fa-file-o"></i>', ['/philippines/telemarketing/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>

                                                 <?php } elseif(Yii::$app->user->identity->module_id == 8){ ?>
                                                    <?= Html::a('<i class="fa fa-file-o"></i>', ['/bangladesh/telemarketing/show','id'=>$value['id_module']],['class'=>'btn btn-circle btn-icon-only blue-chambray','title'=>'View Details']) ?>
                                                 <?php } ?>
                                                <?php } ?>
                                    <?php } ?>

                                </td>


                                
                            </tr>
                            <?php } ?>
                            </tbody>
                            
                        </table>

             
                    </div>
                </div>
                <!-- END PORTLET -->
            </div>
        </div>