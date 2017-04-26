<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LookupDelivery */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Lookup Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-delivery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
