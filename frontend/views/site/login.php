<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'LESO - Supply Chain Management System';
$this->params['breadcrumbs'][] = $this->title;
?>
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 bs-reset">
<div class="login-bg" style="background-image:url(<?php echo Yii::$app->request->baseUrl; ?>/uploads/image/1.png)">
                     
</div>
                </div>
                <div class="col-md-6 login-container bs-reset">
                    <div class="login-content">

                        <h1><?= Html::encode($this->title) ?></h1>

                        <?php $form = ActiveForm::begin(['id' => 'login-form','options' => ['class' => 'login-form']]); ?>
                            <?= $form->errorSummary($model,['class'=>'alert alert-danger','header'=>'']); ?>
                      
                            <div class="row">
                                <div class="col-xs-6">
                                   <?= Html::activeTextInput($model,'username',['class'=>'form-control form-control-solid placeholder-no-fix form-group','placeholder'=>'Username']); ?>                            
                                   
                                </div>
                                <div class="col-xs-6">
                                    <?= Html::activePasswordInput($model,'password',['class'=>'form-control form-control-solid placeholder-no-fix form-group','placeholder'=>'Password']); ?>
                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-8 text-right">
     
                                    <?= Html::submitButton('Sign In', ['class' => 'btn blue', 'name' => 'login-button']) ?>

                                    
                                </div>
                            </div>

                        <?php ActiveForm::end(); ?>


                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-5 bs-reset">
                                <ul class="login-social">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-dribbble"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-7 bs-reset">
                                <div class="login-copyright text-right">
                                    <p>Copyright &copy; LESO Supply Chain Management System. <?= date('Y') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
