<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\thailand\models\QuotationDetailsThailand */

$this->title = 'Create Quotation Details Thailand';
$this->params['breadcrumbs'][] = ['label' => 'Quotation Details Thailands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-details-thailand-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
