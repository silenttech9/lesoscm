<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LookupUnitOfMeasure */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Lookup Unit Of Measures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-unit-of-measure-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
