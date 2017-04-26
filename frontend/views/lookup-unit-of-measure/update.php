<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LookupUnitOfMeasure */

$this->title = 'Update : ' . $model->unit_of_measure;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Unit Of Measures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lookup-unit-of-measure-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
