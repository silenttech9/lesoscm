<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\thailand\models\ThailandStock */

$this->title = 'Update Thailand Stock: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Thailand Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="thailand-stock-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
