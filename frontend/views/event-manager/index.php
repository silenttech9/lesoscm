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
                    <?= Html::a('Create Event', ['create'], ['class' => 'btn blue-steel']) ?>
                </div>
            </div>
            <div class="row">
                <div class='col-xs-12 table-responsive'>
                    <div class="portlet-body">
                        <div class="event-manager-index">

                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                        <br><br><br>
                        <?php Pjax::begin(); ?>    <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                // 'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    
                                    // 'title',
                                    [
                                        'attribute'=>'title',
                                        'format'=>'raw',
                                        'headerOptions' => ['style' => 'width:50%'],
                                        'value'=>function($data){
                                            return '<a href="http://lesoscm.com/eventmanager/web/site/index?id='.$data->id.'" target="_BLANK">'.$data->title.'</a>';
                                        },
                                    ],
                                    'date_event',
                                    
                                    [
                                        'label'=>'Status',
                                        'format' => 'raw',
                                        'value'=>function ($data) {
                                            if ($data->status_event == 'Closed') {
                                                
                                                return Html::a('<span class="btn btn-sm btn-danger">'.$data->status_event.'</span>',[''],['visible' => false]);
                                            }
                                            else{
                                                return Html::a($data->status_event,['changestatus','id'=>$data->id],['data-confirm'=>"Are you sure want to change this status ? If YES, this event will closed.",'class'=>'btn btn-sm green-meadow']);
                                            }
                                        },
                                    ],
                                    // 'time_event_start',
                                    // 'time_event_end',
                                    // 'venue_event',
                                    // 'objective_event:ntext',
                                    // 'max_participant_perevent',
                                    // 'max_participant_percompany',

                                    [
                                            'header' => 'Action',
                                            'class' => 'yii\grid\ActionColumn',
                                            'template'=>'{view} {update} {delete}',
                                            'buttons' => [
                                                'view' => function ($url, $model) {
                                                    return Html::a('View', 
                                                        $url,['title'=> Yii::t('app','View'),'class'=>'btn btn-sm blue-chambray']);

                                                },
                                                'update' => function ($url, $model) {
                                                    return Html::a('Update',
                                                    $url,['title'=> Yii::t('app','Update'),'class'=>'btn btn-sm blue-chambray']);
                                                    
                                                },
                                                'delete' => function ($url, $model) {
                                                    return Html::a('Delete', 
                                                        $url,['title'=> Yii::t('app','Delete'),'class'=>'btn btn-sm blue-chambray','data-confirm'=>"Are You Sure Want To Delete This Item ?",'data-method' => 'post']);

                                                },

                                            ],
                                            // 'urlCreator' => function ($action, $model, $key, $index) {
                                                
                                            // }
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

