<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Stock */

$this->title = 'Stock';
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="portlet-body">
        <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
				    <h1><?= Html::encode($this->title) ?></h1>
				        <div class="full-height-content-body">

								    <?= $this->render('_form', [
								        'model' => $model,
								    ]) ?>


						</div>
    			</div>

		</div>
	</div>