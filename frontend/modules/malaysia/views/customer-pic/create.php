<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\CustomerPic */

$this->title = 'Customer PIC';
$this->params['breadcrumbs'][] = ['label' => 'Customer Pics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-pic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
