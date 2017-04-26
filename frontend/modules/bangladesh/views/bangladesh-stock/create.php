<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\thailand\models\ThailandStock */

$this->title = 'Create Bangladesh Stock';
$this->params['breadcrumbs'][] = ['label' => 'Bangladesh Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bangladesh-stock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
