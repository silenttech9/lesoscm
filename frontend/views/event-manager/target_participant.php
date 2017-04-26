<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EventManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Manager';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="actions">
                    <!-- <?= Html::a('Create Event', ['create'], ['class' => 'btn blue-steel']) ?> -->
                </div>
            </div>
            <div class="row">
                <div class='col-xs-12 table-responsive'>
                    <div class="portlet-body">
                        <?php echo $this->render('_searchtarget', ['model' => $searchModel]); ?>
                        <br><br><br>
                        <div class="event-manager-index">

                        <?php Pjax::begin(); ?>    <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                // 'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    
                                    'title',
                                    'date_event',
                                    // 'time_event_start',
                                    // 'time_event_end',
                                    // 'venue_event',
                                    // 'objective_event:ntext',
                                    // 'max_participant_perevent',
                                    // 'max_participant_percompany',

                                    [
                                            'header' => 'Action',
                                            'class' => 'yii\grid\ActionColumn',
                                            'template'=>'{listtarget_participant}',
                                            'buttons' => [
                                                'listtarget_participant' => function ($url, $model) {
                                                    return Html::a('Target Participant', 
                                                        $url,['title'=> Yii::t('app','Target Participant'),'class'=>'btn blue-chambray']);

                                                },
                                                

                                            ],
                                            'urlCreator' => function ($action, $model, $key, $index) {
                                                if ($action === 'listtarget_participant') {
                                                    $url = ['event-manager/listtarget_participant','id'=>$model->id];
                                                    return $url;
                                                }
                                            }
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

