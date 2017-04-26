<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\Telemarketing */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Telemarketings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telemarketing-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'datetime',
            'program_product_id',
            'telemarketers_id',
            'state_id',
            'date_create',
            'date_update',
            'enter_by',
            'update_by',
        ],
    ]) ?>

</div>
