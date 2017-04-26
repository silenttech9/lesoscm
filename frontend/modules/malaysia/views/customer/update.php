<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\Customer */

$this->title = 'Update Customer: ' . $model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
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

                    <?= $this->render('_form', [
                'model' => $model,
                'dataProvider' => $dataProvider,
                    ]) ?>

            </div>

        </div>
    </div>
</div>