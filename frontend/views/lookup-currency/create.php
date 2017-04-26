<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LookupCurrency */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Lookup Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-currency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
