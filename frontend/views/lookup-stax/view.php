<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LookupStax */

$this->title = $model->CODE;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Staxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-stax-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CODE',
            'DESC2',
            'DESC',
        ],
    ]) ?>

</div>
