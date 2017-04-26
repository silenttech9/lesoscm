<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EventRegParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Reg Participants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-reg-participant-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event Reg Participant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_participant',
            'email:email',
            'designation',
            'mobile_phone',
            // 'event_id',
            // 'created_at',
            // 'eventreg_id',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
