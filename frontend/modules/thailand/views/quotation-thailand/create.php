<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\Quotation */

$this->title = 'Create Quotation';
$this->params['breadcrumbs'][] = ['label' => 'Quotations', 'url' => ['index']];
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

				    <?= $this->render('_form', [
				        'model' => $model,
				    ]) ?>

            </div>

        </div>
    </div>
</div>
