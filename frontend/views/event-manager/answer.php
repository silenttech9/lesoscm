
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\EventManager;
use frontend\models\EventSurveyAnswer;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EventRegParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$titleevent = EventManager::find()
        ->where(['id'=>$id])
        ->one();

$this->title = 'Attendant Survey';
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
                        <?php echo $this->render('_searchattendant_survey', ['model' => $searchModel,'id'=>$id]); ?>
                        <br><br><br>
                        <div class="event-manager-index">

                        <?php Pjax::begin(); ?>    <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                // 'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    
                                    'name_participant',
                                    'regname.company_name',
                                    'email',
                                    'mobile_phone',

                                    // [
                                    //     'label'=>'Status',
                                    //     'format' => 'raw',
                                    //     'value'=>function ($data) {
                                    //         return Html::a('<span class="btn btn-sm green-meadow">Answer</span>');
                                    //     },
                                    // ],
                                    [
                                        'label'=>'Marks Percentage',
                                        'format'=>'raw',
                                        'value'=>function($data){
                                            return EventSurveyAnswer::calculate($data->id,$data->event_id);
                                        },
                                    ],
                                    [
                                        'header' => 'Action',
                                        'class' => 'yii\grid\ActionColumn',
                                        'template'=>'{answer_survey}',
                                        'buttons' => [
                                            'answer_survey' => function ($url, $model) {
                                                return Html::a('View',FALSE, $url);
                                            },
                                        ],
                                        'urlCreator' => function ($action, $model, $key, $index) {
                                            if ($action === 'answer_survey') {
                                                $url = ['value'=>Url::to(['/event-manager/answer_survey','id'=>$model->id,'eventid'=>$model->event_id]),'class'=>'btn btn-sm blue-chambray update','title'=>'Survey'];
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

