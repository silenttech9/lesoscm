<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EventManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Survey - List of Events';
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
                   
                </div>
            </div>
            <div class="row">
                <div class='col-xs-12 table-responsive'>
                    <div class="portlet-body">
                        <div class="event-manager-index">

                        <?php echo $this->render('_search_surveyevent', ['model' => $searchModel]); ?>
                        <br><br><br>
                        <?php Pjax::begin(); ?>    <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                // 'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    
                                    [
                                        'attribute' => 'title',
                                        'headerOptions' => ['style' => 'width:50%'],
                                    ],
                                    'venue_event',
                                    // 'date_event',
                                    [
                                        'label'=>'Date Event',
                                        'format'=>'raw',
                                        'value'=>function($data){
                                            return Yii::$app->formatter->asDate($data->date_event,'long');
                                        },
                                    ],

                                    [
                                            'header' => 'Action',
                                            'class' => 'yii\grid\ActionColumn',
                                            'template'=>'{answer_}',
                                            'buttons' => [
                                                'answer_' => function ($url, $model) {
                                                    return Html::a('View', 
                                                        $url,['title'=> Yii::t('app','View'),'class'=>'btn blue-chambray']);

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

