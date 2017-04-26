<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LookupProgramProduct */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Program Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-program-product-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'program_product',
        ],
    ]) ?>

</div>
