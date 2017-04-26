<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\EventInvitation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Event Invitations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-invitation-view">

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
            'name',
            'company_name',
            'address_1',
            'address_2',
            'address_3',
            'state',
            'email:email',
            'event_id',
            'created_at',
            'enter_by',
        ],
    ]) ?>

</div>
