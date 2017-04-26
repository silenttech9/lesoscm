<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EventInvitationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Invitations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-invitation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event Invitation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'company_name',
            'address_1',
            'address_2',
            // 'address_3',
            // 'state',
            // 'email:email',
            // 'event_id',
            // 'created_at',
            // 'enter_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
