<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Menu;
use yii\bootstrap\Modal;
use yii\filters\AccessControl;
use common\models\User;
//use common\models\User;
use frontend\models\Reminder;
use frontend\models\JobOrder;
use frontend\models\Message;
use frontend\models\ChatMessage;
//use common\models\all\Chat;
//use common\models\all\ChatMessage;
$remind = Reminder::reminder();

foreach ($remind as $key => $value) { 
        
        $totalReminder =  $value['totalReminder'];
 }
$joborder = JobOrder::joborder();
$listjoborder = JobOrder::joborderlist();

foreach ($joborder as $key => $value) {
    $totaljoborder = $value['totalJoborder'];
}

$remindList = Reminder::reminderlist();

$message = Message::message();

foreach ($message as $key => $value) { 
        
        $totalMessage =  $value['totalMessage'];
 }
$messageList = Message::messagelist();

$totalChatbyuser = ChatMessage::chatlist();
$totalchat = ChatMessage::chatTotal();

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="page-sidebar-closed-hide-logo page-container-bg-solid page-md page-header-fixed page-sidebar-fixed">

<?php $this->beginBody() ?>
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="<?php echo Yii::$app->request->baseUrl; ?>/site/index">
                        <label class="logo-default" style="font-size:19px;margin-top:21px;color:#fff;">LesoSCM</label>

                         </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

                <div class="page-top">
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-list"></i>
                                    <?php 
                                        if ($totaljoborder == 0) {}
                                        else{
                                    ?>
                                    <span class="badge badge-default">
                                    <?php echo $totaljoborder; }?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold"><?php echo $totaljoborder; ?></span> Job Order (Today)
                                        </h3>
                                        <!-- <?= Html::a('view all', ['job-order/notify_joborder']) ?> -->
                                        <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/notify_joborder">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 250px; width: auto;" data-handle-color="#637283">
                                            <?php foreach ($listjoborder as $key => $value) { ?>
                                                <li>
                                                    <a href="<?php echo Yii::$app->request->baseUrl ?>/job-order/view?id=<?php echo $value['jobid'] ?>&notify=<?php echo $value['id'] ?>">
                                                        <span class="time"><?= date('h:i:s',strtotime($value['date_receive']))  ?></span>
                                                        <span class="details">
                                                             <?php echo $value['job_order_no'].' - '.$value['text']; ?> 
                                                        </span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <?php if ($totalReminder == 0) { ?>


                                    <?php } else { ?>

                                         <span class="badge badge-default"><?php echo $totalReminder; ?></span>

                                    <?php } ?>
                                     
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>

                                            <span class="bold"><?php echo $totalReminder; ?></span> Reminder (Today)
                                           
                                        </h3>
                                        <?= Html::a('view all', ['/user/reminder']) ?>
                                   
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 200px;" data-handle-color="#637283">
                                            <?php foreach ($remindList as $key => $value) { ?>
                                                <li>
                                                    <a href="javascript:;">
                                                        <span class="time">
                                                        <?php $date = date('Y-m-d');
                                                                if ($value['date_remind'] == $date) {
                                                                    echo "Today";
                                                                } else {

                                                                    echo $value['date_remind'];
                                                                }
                                                                 ?></span>
                                                        <span class="details">
                                                            <?php if ($value['module'] == "Sales Activity") { ?>
                                                                <span class="label label-sm label-warning"><?php echo $value['module']; ?></span>
                                                            <?php } elseif ($value['module'] == "Telemarketing") { ?>
                                                                <span class="label label-sm label-success"><?php echo $value['module']; ?></span>
                                                            <?php } ?>
                                                     
                                                            
                                                             <?php echo $value['log_reminder']; ?>  - <span class="label label-sm label-danger"><?php echo $value['status']; ?></span>
                                                         </span>
                                                    </a>
                                                </li>
                                            <?php } ?>

 

                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-envelope-open"></i>
                                    <?php if ($totalMessage == 0) { ?>


                                    <?php } else { ?>

                                         <span class="badge badge-default"><?php echo $totalMessage; ?></span>

                                    <?php } ?>

                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>You have
                                            <span class="bold"><?php  echo $totalMessage; ?> </span> Messages</h3>
                                        <?= Html::a('view all', ['/user/inbox']) ?>
       
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 200px;" data-handle-color="#637283">
                                        <?php foreach ($messageList as $key => $value) { ?>

                                            <li>
                                                <a href="#">

                                            <?php if ($value['module'] == "Sales Activity") { ?>
                                                <span class="label label-sm label-warning"><?php echo $value['module']; ?> - <?php echo $value['sub_module']; ?></span>
                                            <?php } elseif ($value['module'] == "Telemarketing") { ?>
                                                <span class="label label-sm label-success"><?php echo $value['module']; ?> - <?php echo $value['sub_module']; ?></span>
                                            <?php } ?>
                                                    
                                                    <span class="subject">
                                                        <span class="from"> <?php echo $value['from_who'] ?> </span>
                                                        <span class="time"><?php $date = date('Y-m-d');
                                                                if ($value['date_message'] == $date) {
                                                                    echo "Today";
                                                                } else {

                                                                    echo $value['date_message'];
                                                                }
                                                                 ?></span>
                                                    </span>
                                                    <span class="message"> <?php echo $value['log_message']; ?> - <span class="label label-sm label-danger"><?php echo $value['status']; ?></span></span>
                                                </a>
                                            </li>

                                        <?php } ?>

                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bubbles" ></i>
                               
                                         <span id="totalChat"  class="badge badge-default "><?php if($totalchat == 0){}else{ echo $totalchat;} ?></span>
                                </a>
                                
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>You have
                                            <span class="bold" id="havechat">  </span> Chat
                                        </h3>
                                        <?= Html::a('view all', ['user/list'],['class'=>'chatlist']) ?>
                                     
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 200px;" data-handle-color="#637283">
                                            <?php foreach ($totalChatbyuser as $key => $value) { ?>
              
                                            <li class="" id="">
                                             
                                                <a href="<?php echo Yii::$app->request->baseUrl ?>/site/return?id=<?php echo $value['message_from']; ?>" class="chatbox" >
                                                    <span class="photo">
                                                        <img src="<?php echo Yii::$app->request->baseUrl ?>/theme/assets/layouts/layout2/img/avatar.png" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> <?php echo $value['username'];?> </span>
                                                        <span class="time">You got <?php echo $value['total_chat_message']; ?> chat from <?php echo $value['username'];?></span>
                                                    </span>

                                                </a>
                                            </li>


                                             <?php } ?>
                                        </ul>
                                    </li>


                                </ul>
                            </li>



                            <li class="dropdown dropdown-user">


                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <!--<img alt="" class="img-circle" src="theme/assets/layouts/layout2/img/avatar.png" />-->
                                    <span class="username username-hide-on-mobile"><?= Yii::$app->user->identity->username ?>  </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                   <?= Html::a(' <i class="icon-user"></i> My Profile ', ['/user/update','id'=>Yii::$app->user->identity->id]) ?>

                                    </li>
                                    <li>
                                        <?= Html::a('<i class="icon-key"></i> Log out', ['/site/logout'],['data-method'=>'post']) ?>
                                    </li>
                                </ul>
                            </li>


                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->


        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">


                <div class="page-sidebar navbar-collapse collapse">

                        <?php
                        echo Menu::widget([
                            'items' => [
                                ['label' => '<i class="glyphicon glyphicon-home"></i><span class="title"><b>Dashboard</b></span>', 'url' => ['/site/index'],'visible'=>User::checkMenu('67')],

                               ['label' => '',
                                    'options'=>['class'=>'nav-item'],
                                    'template' => '<a href="javascript:;" class="nav-link nav-toggle"><i class="glyphicon glyphicon-home"></i><span class="title">Dashboard</span><span class="arrow"></span></a>',
                                    'items' => [
                                        ['label' => '<span class="title">Malaysia</span>', 'url' => ['/site/dashboard','module_id'=>1],'visible'=>User::checkMenu('68')],
                                        ['label' => '<span class="title">Thailand</span>', 'url' => ['/site/dashboard','module_id'=>3],'visible'=>User::checkMenu('69')],
                                    ]
                                ],
                               ['label' => '',
                                    'options'=>['class'=>'nav-item'],
                                    'template' => '<a href="javascript:;" class="nav-link nav-toggle"><i class="glyphicon glyphicon-file"></i><span class="title">Quotation</span><span class="arrow"></span></a>',
                                    'items' => [
                                        ['label' => '<span class="title">Searching</span>', 'url' => ['/site/quotation','module_id'=>1],'visible'=>User::checkMenu('70')],
                                        ['label' => '<span class="title">Searching</span>', 'url' => ['/site/quotation','module_id'=>3],'visible'=>User::checkMenu('71')],
                                        ['label' => '<span class="title">Searching</span>', 'url' => ['/site/quotation','module_id'=>8],'visible'=>User::checkMenu('98')],
                                        ['label' => '<span class="title">Selangor</span>', 'url' => ['/malaysia/quotation/index','state_id'=>13],'visible'=>User::checkMenu('11')],
                                        ['label' => '<span class="title">Pulau Pinang</span>', 'url' => ['/malaysia/quotation/index','state_id'=>23],'visible'=>User::checkMenu('12')],
                                        ['label' => '<span class="title">Johor</span>', 'url' => ['/malaysia/quotation/index','state_id'=>22],'visible'=>User::checkMenu('13')],
                                        ['label' => '<span class="title">Oversea</span>', 'url' => ['/malaysia/quotation/index','state_id'=>100],'visible'=>User::checkMenu('14')],
                                        ['label' => '<span class="title">Sarawak</span>', 'url' => ['/malaysia/quotation/index','state_id'=>21],'visible'=>User::checkMenu('23')],
                                        ['label' => '<span class="title">Sabah</span>', 'url' => ['/malaysia/quotation/index','state_id'=>20],'visible'=>User::checkMenu('24')],
                                        ['label' => '<span class="title">Thailand</span>', 'url' => ['/thailand/quotation-thailand/index'],'visible'=>User::checkMenu('31')],
                                        ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/bangladesh/quotation-bangladesh/index'],'visible'=>User::checkMenu('97')],
                                    ]
                                ],
                                ['label' => '',
                                    'options'=>['class'=>'nav-item'],
                                    'template' => '<a href="javascript:;" class="nav-link nav-toggle"><i class="glyphicon glyphicon-transfer"></i><span class="title">Sales Activities</span><span class="arrow"></span></a>',
                                    'items' => [

                                        ['label' => '<span class="title">Selangor</span>', 'url' => ['/malaysia/sales-activity/index','state_id'=>13],'visible'=>User::checkMenu('1')],
                                        ['label' => '<span class="title">Pulau Pinang</span>', 'url' => ['/malaysia/sales-activity/index','state_id'=>23],'visible'=>User::checkMenu('2')],
                                        ['label' => '<span class="title">Johor</span>', 'url' => ['/malaysia/sales-activity/index','state_id'=>22],'visible'=>User::checkMenu('3')],
                                        ['label' => '<span class="title">Sarawak</span>', 'url' => ['/malaysia/sales-activity/index','state_id'=>21],'visible'=>User::checkMenu('19')],
                                        ['label' => '<span class="title">Sabah</span>', 'url' => ['/malaysia/sales-activity/index','state_id'=>20],'visible'=>User::checkMenu('20')],
                                        ['label' => '<span class="title">Oversea</span>', 'url' => ['/malaysia/sales-activity/oversea','state_id'=>100],'visible'=>User::checkMenu('28')],
                                        ['label' => '<span class="title">Thailand</span>', 'url' => ['/thailand/sales-activity/index','module_id'=>3],'visible'=>User::checkMenu('34')],
                                        ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/bangladesh/sales-activity/index','module_id'=>8],'visible'=>User::checkMenu('92')],
                                    ]
                                ],

                                ['label' => '',
                                    'options'=>['class'=>'nav-item'],
                                    'template' => '<a href="javascript:;" class="nav-link nav-toggle"><i class="glyphicon glyphicon-user"></i><span class="title">Customer</span><span class="arrow"></span></a>',
                                    'items' => [
                                        ['label' => '<span class="title">Selangor</span>', 'url' => ['/malaysia/customer/index','render_state_id'=>13],'visible'=>User::checkMenu('15')],
                                        ['label' => '<span class="title">Pulau Pinang</span>', 'url' => ['/malaysia/customer/index','render_state_id'=>23],'visible'=>User::checkMenu('16')],
                                        ['label' => '<span class="title">Johor</span>', 'url' => ['/malaysia/customer/index','render_state_id'=>22],'visible'=>User::checkMenu('17')],
                                        ['label' => '<span class="title">Oversea</span>', 'url' => ['/malaysia/customer/oversea','render_state_id'=>13,'agent_id'=>13],'visible'=>User::checkMenu('18')],
                                        ['label' => '<span class="title">Sarawak</span>', 'url' => ['/malaysia/customer/index','render_state_id'=>21],'visible'=>User::checkMenu('25')],
                                        ['label' => '<span class="title">Sabah</span>', 'url' => ['/malaysia/customer/index','render_state_id'=>20],'visible'=>User::checkMenu('26')],
                                        ['label' => '<span class="title">Thailand</span>', 'url' => ['/thailand/customer/index','module_id'=>3],'visible'=>User::checkMenu('32')],
                                        ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/bangladesh/customer/index','module_id'=>8],'visible'=>User::checkMenu('93')],



                                    ]
                                ],

                                ['label' => '',
                                    'options'=>['class'=>'nav-item'],
                                    'template' => '<a href="javascript:;" class="nav-link nav-toggle"><i class="glyphicon glyphicon-th"></i><span class="title"><b>Stock</b></span><span class="arrow"></span></a>',
                                    'items' => [
                                        ['label' => '<span class="title">Malaysia</span>', 'url' => ['/malaysia/all/index'],'visible'=>User::checkMenu('7')],
                                        ['label' => '<span class="title">Selangor</span>', 'url' => ['/malaysia/selangor-stock/index','state_id'=>13],'visible'=>User::checkMenu('8')],
                                        ['label' => '<span class="title">Pulau Pinang</span>', 'url' => ['/malaysia/penang-stock/index','state_id'=>23],'visible'=>User::checkMenu('9')],
                                        ['label' => '<span class="title">Johor Bahru</span>', 'url' => ['/malaysia/johor-stock/index','state_id'=>22],'visible'=>User::checkMenu('10')],
                                        ['label' => '<span class="title">Stock</span>', 'url' => ['/stock/index'],'visible'=>User::checkMenu('27')],
                                        ['label' => '<span class="title">Thailand</span>', 'url' => ['/thailand/thailand-stock/index','country_id'=>3],'visible'=>User::checkMenu('33')],
                                        ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/bangladesh/bangladesh-stock/index','country_id'=>8],'visible'=>User::checkMenu('96')],

                                    ]
                                ],



                                ['label' => '',
                                    'options'=>['class'=>'nav-item'],
                                    'template' => '<a href="javascript:;" class="nav-link nav-toggle"><i class="glyphicon glyphicon-headphones"></i><span class="title">Telemarketing</span><span class="arrow"></span></a>',
                                    'items' => [

                                        ['label' => '<span class="title">Selangor</span>', 'url' => ['/malaysia/telemarketing/index','state_id'=>13],'visible'=>User::checkMenu('4')],
                                        ['label' => '<span class="title">Pulau Pinang</span>', 'url' => ['/malaysia/telemarketing/index','state_id'=>23],'visible'=>User::checkMenu('5')],
                                        ['label' => '<span class="title">Johor</span>', 'url' => ['/malaysia/telemarketing/index','state_id'=>22],'visible'=>User::checkMenu('6')],
                                        ['label' => '<span class="title">Sarawak</span>', 'url' => ['/malaysia/telemarketing/index','state_id'=>21],'visible'=>User::checkMenu('21')],
                                        ['label' => '<span class="title">Sabah</span>', 'url' => ['/malaysia/telemarketing/index','state_id'=>20],'visible'=>User::checkMenu('22')],
                                        ['label' => '<span class="title">Thailand</span>', 'url' => ['/thailand/telemarketing/index','module_id'=>3],'visible'=>User::checkMenu('35')],
                                        ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/bangladesh/telemarketing/index','module_id'=>8],'visible'=>User::checkMenu('94')],


                                    ]
                                ],

                                ['label' => '',
                                    'options'=>['class'=>'nav-item'],
                                    'template' => '<a href="javascript:;" class="nav-link nav-toggle"><i class="glyphicon glyphicon-credit-card"></i><span class="title">Warranty</span><span class="arrow"></span></a>',
                                    'items' => [

                                        ['label' => '<span class="title">Searching</span>', 'url' => ['/warranty/searching','state_id'=>13],'visible'=>User::checkMenu('72')],
                                         ['label' => '<span class="title">Searching</span>', 'url' => ['/warranty/searching','state_id'=>23],'visible'=>User::checkMenu('77')],
                                          ['label' => '<span class="title">Searching</span>', 'url' => ['/warranty/searching','state_id'=>22],'visible'=>User::checkMenu('78')],
                                        ['label' => '<span class="title">Selangor</span>', 'url' => ['/malaysia/selangor-invoice/index','state_id'=>13],'visible'=>User::checkMenu('73')],
                                        ['label' => '<span class="title">Pulau Pinang</span>', 'url' => ['/malaysia/penang-invoice/index','state_id'=>23],'visible'=>User::checkMenu('75')],
                                         ['label' => '<span class="title">Johor</span>', 'url' => ['/malaysia/johor-invoice/index','state_id'=>22],'visible'=>User::checkMenu('76')],

                                    ]
                                ],

                                ['label' => '',
                                    'options'=>['class'=>'nav-item'],
                                    'template' => '<a href="javascript:;" class="nav-link nav-toggle"><i class="glyphicon glyphicon-refresh"></i><span class="title">Annual Service</span><span class="arrow"></span></a>',
                                    'items' => [

                                        ['label' => '<span class="title">Selangor</span>', 'url' => ['/malaysia/selangor-invoice/annual','state_id'=>13],'visible'=>User::checkMenu('74')],

                                    ]
                                ],
                                ['label' => '',
                                    'options'=>['class'=>'nav-item'],
                                    'template' => '<a href="javascript:;" class="nav-link nav-toggle"><i class="icon-note"></i><span class="title">Job Order</span><span class="arrow"></span></a>',
                                    'items' => [
                                        // ['label' => '<span class="title">Searching</span>', 'url' => ['/job-order/searching'],'visible'=>User::checkMenu('79')],
                                        ['label' => '<span class="title">Selangor</span>', 'url' => ['/job-order','render_state_id'=>13],'visible'=>User::checkMenu('79')],
                                        ['label' => '<span class="title">Pulau Pinang</span>', 'url' => ['/job-order','render_state_id'=>23],'visible'=>User::checkMenu('80')],
                                        ['label' => '<span class="title">Johor Bahru</span>', 'url' => ['/job-order','render_state_id'=>22],'visible'=>User::checkMenu('81')],
                                        // ['label' => '<span class="title">Johor Bahru</span>', 'url' => ['/job-order','render_state_id'=>22]],

                                    ]
                                ],
                                ['label' => '',
                                    'options'=>['class'=>'nav-item'],
                                    'template' => '<a href="javascript:;" class="nav-link nav-toggle"><i class="glyphicon glyphicon-calendar"></i><span class="title">Event Manager</span><span class="arrow"></span></a>',
                                    'items' => [
                                         ['label' => '<span class="title">Event Panel</span>', 'url' => ['/event-manager/index']],
                                         ['label' => '<span class="title">Target Participant</span>', 'url' => ['/event-manager/target_participant']],
                                         ['label' => '<span class="title">Registered Participant</span>', 'url' => ['/event-manager/registered_participant']],
                                         ['label' => '<span class="title">Attendance</span>', 'url' => ['/event-manager/listevent']],
                                         ['label' => '<span class="title">Survey</span>', 'url' => ['/event-manager/survey_event']],

                                        /*['label' => '<span class="title">Event Panel</span>', 'url' => ['/event-manager/maintenance']],
                                        ['label' => '<span class="title">Target Participant</span>', 'url' => ['/event-manager/maintenance']],
                                        ['label' => '<span class="title">Registered Participant</span>', 'url' => ['/event-manager/maintenance']],
                                        ['label' => '<span class="title">Attendance</span>', 'url' => ['/event-manager/maintenance']],
                                        ['label' => '<span class="title">Survey</span>', 'url' => ['/event-manager/maintenance']],*/
                                    ]
                                ],
                                // ['label' => '<i class="glyphicon glyphicon-home"></i><span class="title"><b>Job Order</b></span>', 'url' => ['/job-order']],



                                ['label' => '',
                                    'options'=>['class'=>'nav-item'],
                                    'template' => '<a href="javascript:;" class="nav-link nav-toggle"><i class="glyphicon glyphicon-wrench"></i><span class="title">Setting</span><span class="arrow"></span></a>',
                                    'items' => [
                                            ['label' => '',
                                                'options'=>['class'=>'nav-item'],
                                                'template' => '<a href="javascript:;" class="nav-link nav-toggle"><span class="title">Unit Of Measure</span><span class="arrow"></span></a>',
                                                'items' => [

                                                    ['label' => '<span class="title">Malaysia</span>', 'url' => ['/lookup-unit-of-measure/index','module_id'=>1],'visible'=>User::checkMenu('36')],
                                                    ['label' => '<span class="title">Thailand</span>', 'url' => ['/lookup-unit-of-measure/index','module_id'=>3],'visible'=>User::checkMenu('37')],
                                                    ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/lookup-unit-of-measure/index','module_id'=>8],'visible'=>User::checkMenu('99')],

                                                ]
                                            ],

                                            ['label' => '',
                                                'options'=>['class'=>'nav-item'],
                                                'template' => '<a href="javascript:;" class="nav-link nav-toggle"><span class="title">Delivery</span><span class="arrow"></span></a>',
                                                'items' => [

                                                    ['label' => '<span class="title">Malaysia</span>', 'url' => ['/lookup-delivery/index','module_id'=>1],'visible'=>User::checkMenu('38')],
                                                    ['label' => '<span class="title">Thailand</span>', 'url' => ['/lookup-delivery/index','module_id'=>3],'visible'=>User::checkMenu('39')],
                                                    ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/lookup-delivery/index','module_id'=>8],'visible'=>User::checkMenu('100')],
                                                ]
                                            ],

                                            ['label' => '',
                                                'options'=>['class'=>'nav-item'],
                                                'template' => '<a href="javascript:;" class="nav-link nav-toggle"><span class="title">Validity</span><span class="arrow"></span></a>',
                                                'items' => [

                                                    ['label' => '<span class="title">Malaysia</span>', 'url' => ['/lookup-validity/index','module_id'=>1],'visible'=>User::checkMenu('40')],
                                                    ['label' => '<span class="title">Thailand</span>', 'url' => ['/lookup-validity/index','module_id'=>3],'visible'=>User::checkMenu('41')],
                                                    ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/lookup-validity/index','module_id'=>8],'visible'=>User::checkMenu('101')],
                                                ]
                                            ],

                                            ['label' => '',
                                                'options'=>['class'=>'nav-item'],
                                                'template' => '<a href="javascript:;" class="nav-link nav-toggle"><span class="title">Currency</span><span class="arrow"></span></a>',
                                                'items' => [

                                                    ['label' => '<span class="title">Malaysia</span>', 'url' => ['/lookup-currency/index','module_id'=>1],'visible'=>User::checkMenu('42')],
                                                    ['label' => '<span class="title">Thailand</span>', 'url' => ['/lookup-currency/index','module_id'=>3],'visible'=>User::checkMenu('43')],
                                                    ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/lookup-currency/index','module_id'=>8],'visible'=>User::checkMenu('102')],
                                                ]
                                            ],

                                            ['label' => '',
                                                'options'=>['class'=>'nav-item'],
                                                'template' => '<a href="javascript:;" class="nav-link nav-toggle"><span class="title">Term</span><span class="arrow"></span></a>',
                                                'items' => [

                                                    ['label' => '<span class="title">Malaysia</span>', 'url' => ['/lookup-term/index','module_id'=>1],'visible'=>User::checkMenu('44')],
                                                    ['label' => '<span class="title">Thailand</span>', 'url' => ['/lookup-term/index','module_id'=>3],'visible'=>User::checkMenu('45')],
                                                    ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/lookup-term/index','module_id'=>8],'visible'=>User::checkMenu('103')],
                                                ]
                                            ],

                                            ['label' => '',
                                                'options'=>['class'=>'nav-item'],
                                                'template' => '<a href="javascript:;" class="nav-link nav-toggle"><span class="title">Stax</span><span class="arrow"></span></a>',
                                                'items' => [

                                                    ['label' => '<span class="title">Malaysia</span>', 'url' => ['/lookup-stax/index','module_id'=>1],'visible'=>User::checkMenu('46')],
                                                    ['label' => '<span class="title">Thailand</span>', 'url' => ['/lookup-stax/index','module_id'=>3],'visible'=>User::checkMenu('47')],
                                                    ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/lookup-stax/index','module_id'=>8],'visible'=>User::checkMenu('104')],
                                                ]
                                            ],






                                            ['label' => '',
                                                'options'=>['class'=>'nav-item'],
                                                'template' => '<a href="javascript:;" class="nav-link nav-toggle"><span class="title">Product / Program</span><span class="arrow"></span></a>',
                                                'items' => [

                                                    ['label' => '<span class="title">Malaysia</span>', 'url' => ['/lookup-program-product/index','module_id'=>1]],
                                                    ['label' => '<span class="title">Thailand</span>', 'url' => ['lookup-program-product/index','module_id'=>3],'visible'=>User::checkMenu('66')],
                                                    ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/lookup-program-product/index','module_id'=>8],'visible'=>User::checkMenu('95')],

                                                ]
                                            ],

                                            ['label' => '<span class="title">Phone Country Code</span>','url'=>['/lookup-phone-country-code/index']],
                                            ['label' => '',
                                                'options'=>['class'=>'nav-item'],
                                                'template' => '<a href="javascript:;" class="nav-link nav-toggle"><span class="title">Agent</span><span class="arrow"></span></a>',
                                                'items' => [

                                                    ['label' => '<span class="title">Malaysia</span>', 'url' => ['/lookup-agent/index','module_id'=>1]],
                                                    ['label' => '<span class="title">Thailand</span>', 'url' => ['/lookup-agent/index','module_id'=>3],'visible'=>User::checkMenu('54')],
                                                    ['label' => '<span class="title">Bangladesh</span>', 'url' => ['/lookup-agent/index','module_id'=>8],'visible'=>User::checkMenu('105')],

                                                ]
                                            ],
                                            ['label' => '',
                                                'options'=>['class'=>'nav-item'],
                                                'template' => '<a href="javascript:;" class="nav-link nav-toggle"><span class="title">Area Code</span><span class="arrow"></span></a>',
                                                'items' => [
                                                    ['label' => '<span class="title">Malaysia</span>', 'url' => ['lookup-area/index','module_id'=>1]],
                                                    ['label' => '<span class="title">Thailand</span>', 'url' => ['lookup-area/index','module_id'=>3],'visible'=>User::checkMenu('60')],
                                                    ['label' => '<span class="title">Bangladesh</span>', 'url' => ['lookup-area/index','module_id'=>8],'visible'=>User::checkMenu('106')],

                                                ]
                                            ],
                                                                                        ['label' => '',
                                                'options'=>['class'=>'nav-item'],
                                                'template' => '<a href="javascript:;" class="nav-link nav-toggle"><span class="title">Delivery Type</span><span class="arrow"></span></a>',
                                                'items' => [
                                                    ['label' => '<span class="title">Malaysia</span>', 'url' => ['lookup-delivery-mode/index','module_id'=>1]],

                                                ]
                                            ],


                                    ]
                                ],








                            ],
                            'activateParents'=>true,
                            'encodeLabels' => false,
                            'options' => [
                                            'id' => 'menu',
                                            'class' => 'page-sidebar-menu page-header-fixed page-sidebar-menu-accordion-submenu',
                                            'data-keep-expanded' => 'false',
                                            'data-auto-scroll' => 'true',
                                            'data-slide-speed' => '200',

                                        ],
                            'itemOptions'=> ['class' => 'nav-item'],
                            'submenuTemplate' => "\n<ul class='sub-menu' >\n{items}\n</ul>\n",
                            //array('id'=>'item_id', 'class'=>'item_class', 'style'=>''),


                            //'submenuTemplate' => "\n<ul class='dropdown-menu pull-right' role='menu'>\n{items}\n</ul>\n",
                        ]);
                        ?>

                </div>
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->

                <!--<div class="page-bar">
                    <?php /*Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => ['class'=>'page-breadcrumb'],
                        'homeLink' => [
                            'label' => 'Dashboard ',
                            'url' => Yii::$app->request->baseUrl,
                            'encode' => false,

                        ],
                    ]); */?>
                </div>-->


                <?= Alert::widget() ?>



                     <?= $content ?>



                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <!--<a href="javascript:;" class="page-quick-sidebar-toggler">
                <i class="icon-login"></i>
            </a>
            <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
                <div class="page-quick-sidebar">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> Users
                                <span class="badge badge-danger">2</span>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                            <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
                                <h3 class="list-heading">Staff</h3>
                                <ul class="media-list list-items">
                                    <li class="media">
                                        <div class="media-status">
                                            <span class="badge badge-success">8</span>
                                        </div>
                                        <img class="media-object" src="../assets/layouts/layout/img/avatar3.jpg" alt="...">
                                        <div class="media-body">
                                            <h4 class="media-heading">Bob Nilson</h4>
                                            <div class="media-heading-sub"> Project Manager </div>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                            <div class="page-quick-sidebar-item">
                                <div class="page-quick-sidebar-chat-user">
                                    <div class="page-quick-sidebar-nav">
                                        <a href="javascript:;" class="page-quick-sidebar-back-to-list">
                                            <i class="icon-arrow-left"></i>Back</a>
                                    </div>
                                    <div class="page-quick-sidebar-chat-user-messages">
                                        <div class="post out">
                                            <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar3.jpg" />
                                            <div class="message">
                                                <span class="arrow"></span>
                                                <a href="javascript:;" class="name">Bob Nilson</a>
                                                <span class="datetime">20:15</span>
                                                <span class="body"> When could you send me the report ? </span>
                                            </div>
                                        </div>
                                        <div class="post in">
                                            <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar2.jpg" />
                                            <div class="message">
                                                <span class="arrow"></span>
                                                <a href="javascript:;" class="name">Ella Wong</a>
                                                <span class="datetime">20:15</span>
                                                <span class="body"> Its almost done. I will be sending it shortly </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="page-quick-sidebar-chat-user-form">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Type a message here...">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn green">
                                                    <i class="icon-paper-clip"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>










                    </div>
                </div>
            </div>-->
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->

        <div class="page-footer">
            <div class="page-footer-inner"> 2016 &copy; LESO Supplier Chain Management System

                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
        </div>


<?php $this->endBody() ?>
</body>
<div class="modal fade" id="full" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body xxx">  </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</html>
<?php
Modal::begin([
    'header' =>'LSCM',
    'id' => 'modal',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => false, 'keyboard' => TRUE],
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ],

]);

echo "<div id='modalContent'></div>";
Modal::end();

Modal::begin([
    'header' =>'LSCM',
    'id' => 'modalsm',
    'size' => 'modal-sm',
    'clientOptions' => ['backdrop' => false, 'keyboard' => TRUE],
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ],

]);

echo "<div id='modalContentsm'></div>";
Modal::end();

$this->endPage() ?>
