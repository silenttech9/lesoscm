<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LookupDeliveryMode */

$this->title = 'Create Lookup Delivery Mode';
$this->params['breadcrumbs'][] = ['label' => 'Lookup Delivery Modes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-delivery-mode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
