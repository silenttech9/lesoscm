<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LookupAgent */

$this->title = $model->agent;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-agent-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'agent',
            'handphone_no',

        ],
    ]) ?>

</div>
