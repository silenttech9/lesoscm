<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\TelemarketingCustomer */

$this->title = 'Create Telemarketing Customer';
$this->params['breadcrumbs'][] = ['label' => 'Telemarketing Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telemarketing-customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
