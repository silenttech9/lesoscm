<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LookupStax */

$this->title = 'Update : ' . $model->CODE;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Staxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lookup-stax-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
