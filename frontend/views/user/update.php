<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = 'Update User: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="portlet light">

                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark"><?= Html::encode($this->title) ?></span>
                        </div>
                        <div class="actions">
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                        </div>
                    </div>

<?php if(Yii::$app->session->hasFlash('update')) { ?>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert"></button>
                             <?php echo  Yii::$app->session->getFlash('update'); ?>
                        </div>
                        <?php } ?>



                    <div class="portlet-body">

    <?= $this->render('_form', [
        'model' => $model,


    ]) ?>

                    </div>
                </div>
            </div>


        </div>