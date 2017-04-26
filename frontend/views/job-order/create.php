<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\JobOrder */

$this->title = 'Create Job Order';
$this->params['breadcrumbs'][] = ['label' => 'Job Order List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
            </div>
            <div class="portlet-body">
            	<div class="job-order-create">

				    <?= $this->render('_form', [
				        'model' => $model,
                        'render_state_id'=>$render_state_id,
				    ]) ?>

				</div>
            </div>
        </div>
    </div>
</div>

