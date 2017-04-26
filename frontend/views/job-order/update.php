<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\JobOrder */

$this->title = 'Update Job Order: ' . $model->job_order_no;
$this->params['breadcrumbs'][] = ['label' => 'Job Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
            	<div class="job-order-update">

				    <?= $this->render('_edit', [
				        'model' => $model,
				        'render_state_id'=>$render_state_id,
				    ]) ?>

				</div>
            </div>
		</div>
	</div>
</div>

