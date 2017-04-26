<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
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
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true,'value'=>Yii::$app->user->identity->username,'readOnly'=>'readOnly']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>


        </div>