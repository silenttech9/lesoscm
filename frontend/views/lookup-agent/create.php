<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LookupAgent */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Lookup Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-agent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
