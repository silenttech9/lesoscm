<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\EventManager */

$this->title = 'Update Event Manager: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Event Managers', 'url' => ['index']];
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
            	<div class="event-manager-create">

				    <?= $this->render('_edit', [
				        'model' => $model,
				        'model2'=>$model2,
				    ]) ?>

				</div>
            </div>
		</div>
	</div>
</div>