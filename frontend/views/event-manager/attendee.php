<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\EventManager;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EventRegParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$titleevent = EventManager::find()
        ->where(['id'=>$id])
        ->one();

$this->title = 'Attendance List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="note note-warning">
            <h4>Event Title : <?= $titleevent->title ?></h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
            </div>
            <div class="row">
                <div class='col-xs-12 table-responsive'>
                    <div class="portlet-body">
                        <div class="event-manager-index">

                        <?php echo $this->render('_searchattendee', ['model' => $searchModel_confirm,'id'=>$id]); ?>
                        <br><br><br>
                        <?php Pjax::begin(); ?>    <?= GridView::widget([
                                'dataProvider' => $dataProvider_confirm,
                                // 'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    
                                    'name_participant',
                                    'regname.company_name',
                                    'email',
                                    'mobile_phone',

                                    [
                                        'label'=>'Status',
                                        'format' => 'raw',
                                        'value'=>function ($data) {
                                            return Html::a('<span class="btn btn-sm green-meadow">'.$data->status.'</span>');
                                        },
                                    ],
                                ],
                            ]); ?>
                        <?php Pjax::end(); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>