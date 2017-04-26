<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LookupArea */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Lookup Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-area-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
