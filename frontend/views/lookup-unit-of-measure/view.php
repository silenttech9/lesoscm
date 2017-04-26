<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LookupUnitOfMeasure */

$this->title = $model->unit_of_measure;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Unit Of Measures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-unit-of-measure-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'unit_of_measure',
        ],
    ]) ?>

</div>
