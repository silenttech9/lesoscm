<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LookupArea */

$this->title = $model->area;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-area-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'area',
            'desc',

        ],
    ]) ?>

</div>
