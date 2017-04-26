<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Warranty */

$this->title = 'Edit Warranty: ' . $model->serial_number;
$this->params['breadcrumbs'][] = ['label' => 'Warranties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="warranty-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_edit', [
        'model' => $model,
        'state_id' => $state_id,

    ]) ?>

</div>
