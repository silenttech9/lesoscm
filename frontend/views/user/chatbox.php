<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\all\User */

$this->title = "List User";
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="inbox">
        <div class="row">
            <div class="col-md-3">
                <div class="inbox-sidebar">

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab"> MALAYSIA </a>
                        </li>
                        <li>
                            <a href="#tab_1_2" data-toggle="tab"> THAILAND </a>
                        </li>
                        <li>
                            <a href="#tab_1_3" data-toggle="tab"> BANGLADESH </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_1_1">
                                <ul class="inbox-contacts">
                                    <?php foreach ($malaysia as $key => $value) { ?>
                                        <li>
                                            <?= Html::a('<img class="contact-pic" src="../theme/assets/layouts/layout2/img/avatar.png"><span class="contact-name">'.$value['username'].'</span>', ['user/chatbox','id'=>$value['id']]) ?>

                                        </li>
                                    <?php } ?>
                                </ul>

                        </div>
                        <div class="tab-pane fade" id="tab_1_2">
                                <ul class="inbox-contacts">
                                    <?php foreach ($thailand as $key => $value2) { ?>
                                        <li>
                                         <?= Html::a('<img class="contact-pic" src="../theme/assets/layouts/layout2/img/avatar.png"><span class="contact-name">'.$value2['username'].'</span>', ['user/chatbox','id'=>$value2['id']]) ?>
                            
                                        </li>
                                    <?php } ?>
                                </ul>
                        </div>
                        <div class="tab-pane fade" id="tab_1_3">
                                <ul class="inbox-contacts">
                                    <?php foreach ($bangladesh as $key => $value2) { ?>
                                        <li>
                                         <?= Html::a('<img class="contact-pic" src="../theme/assets/layouts/layout2/img/avatar.png"><span class="contact-name">'.$value2['username'].'</span>', ['user/chatbox','id'=>$value2['id']]) ?>
                            
                                        </li>
                                    <?php } ?>
                                </ul>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-md-9">
                <div class="inbox-body">
                    <div class="inbox-header">
                        <h1 class="pull-left"><?= $username; ?></h1>

                    </div>
                    <div class="inbox-content" >

                    <?php foreach ($data as $key => $value) { ?>
                                    <div class="page-quick-sidebar-chat-user-messages">
                                        <div class="post out">
                                            <img class="avatar" alt="" src="../theme/assets/layouts/layout2/img/avatar.png" />
                                            <div class="message">
                                                <span class="arrow"></span>
                                                <a href="javascript:;" class="name"><?php echo $value['username'] ?></a>
                                                <span class="datetime"><?php echo $value['chattime'] ?></span>
                                                <span class="body"><?php echo $value['message'] ?></span>
                                            </div>
                                        </div>


                                    </div>
                      <?php } ?>

                     </div>
                    <div class="page-quick-sidebar-chat-user-form">
                        <div class="input-group">
                            <input type="hidden" id="penerima" value="<?php echo $id; ?>">
                            <input type="text" id="msgtxt" class="form-control msgtxt" placeholder="Type a message here...">
                            <div class="input-group-btn">
                                <button type="button" id="btnchat" class="btn blue-steel">
                                    Send
                                </button>
                            </div>
                        </div>
                    </div>


                     
                </div>
            </div>

        </div>
    </div>