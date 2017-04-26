<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>

        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="portlet light">

                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark"><?= Html::encode($this->title) ?></span>
   
                        </div>
                        <div class="actions">
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                        </div>
                    </div>

                    <div class="portlet-body">

                        <?php if(Yii::$app->session->hasFlash('success')) { ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert"></button>
                             <?php echo  Yii::$app->session->getFlash('success'); ?>
                        </div>
                        <?php } ?>
                    
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>


        </div>
