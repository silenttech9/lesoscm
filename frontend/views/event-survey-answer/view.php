<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\EventSurveyAnswer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Survey Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-survey-answer-view">

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
            'id_question',
            'answer:ntext',
            'id_attendee',
            'created_at',
            'event_id',
        ],
    ]) ?>

</div>
