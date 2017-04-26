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

$this->title = 'List of participants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="note note-warning">
            <h4>Event Title : <?= $titleevent->title ?></h4>
        </div>
    </div>
</div>
<?php if(Yii::$app->session->hasFlash('addparticipant')):?>
    <div class="alert alert-success alert-dismissable" id="flash">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
         <?php echo  Yii::$app->session->getFlash('addparticipant'); ?>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="actions">
                    <?= Html::a('Attendant', ['attendee','id'=>$id], ['class' => 'btn dark btn-outline btn-sm']) ?>
                    <?= Html::a('Add Participant', ['addparticipant'], ['class' => 'btn btn-sm blue-chambray']) ?>
                </div>
            </div>
            <div class="row">
                <div class='col-xs-12 table-responsive'>
                    <div class="portlet-body">
                        <div class="event-manager-index">

                        <?php echo $this->render('_searchattendance', ['model' => $searchModel,'id'=>$id]); ?>
                        <br><br><br>
                        <?php Pjax::begin(); ?>    <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                // 'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    
                                    'name_participant',
                                    'regname.company_name',
                                    'mobile_phone',
                                    'email:email',
                                    [
                                            'header' => 'Action',
                                            'class' => 'yii\grid\ActionColumn',
                                            'template'=>'{changeattend}',
                                            'buttons' => [
                                                'changeattend' => function ($url, $model) {
                                                    return Html::a('Attend', 
                                                        $url,['title'=> Yii::t('app','Attend'),'class'=>'btn btn-sm blue-chambray']);

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


