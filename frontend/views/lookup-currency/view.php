<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LookupCurrency */

$this->title = $model->currency_code;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-currency-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'currency_code',
        ],
    ]) ?>

</div>
