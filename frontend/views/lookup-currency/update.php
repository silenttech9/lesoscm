<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LookupCurrency */

$this->title = 'Update : ' . $model->currency_code;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lookup-currency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
