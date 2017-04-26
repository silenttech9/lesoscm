<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LookupValidity */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Lookup Validities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-validity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
