<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\thailand\models\ThailandStock */

$this->title = 'Update Bangladesh Stock: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bangladesh Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bangladesh-stock-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
