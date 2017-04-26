<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\thailand\models\ThailandStock */

$this->title = 'Create Thailand Stock';
$this->params['breadcrumbs'][] = ['label' => 'Thailand Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thailand-stock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
