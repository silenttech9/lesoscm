<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LookupDelivery */

$this->title = $model->delivery;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-delivery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'delivery',
        ],
    ]) ?>

</div>
