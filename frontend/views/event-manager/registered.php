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

$this->title = 'Registered Participants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="note note-warning">
            <h4>Event Title : <?= $titleevent->title ?></h4>
        </div>
    </div>
</div>
<?php if(Yii::$app->session->hasFlash('emailinvalid')):?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert"></button>
         <?php echo  Yii::$app->session->getFlash('emailinvalid'); ?>
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
                    <a class="btn blue-steel" href="#approved">Approved</a>
                </div>
            </div>
            <div class="row">
                <div class='col-xs-12 table-responsive'>
                    <div class="portlet-body">
                        <?php echo $this->render('_searchregistered', ['model' => $searchModel,'id'=>$id]); ?>
                        <br><br><br>
                        <div class="event-reg-participant-index">

                            <?php Pjax::begin(); ?>    <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    // 'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                            'name_participant',
                                            'regname.company_name',
                                            'email:email',
                                            [
                                                'attribute' => 'mobile_phone',
                                               'format' => ['raw'],
                                                'value' => 'mobile_phone',
                                            ],
                                            // 'mobile_phone',
                                            // 'event_id',
                                            // 'created_at',
                                            // 'eventreg_id',
                                            // 'status',
                                            [
                                            'header' => 'Action',
                                            'class' => 'yii\grid\ActionColumn',
                                            'template'=>'{approve} {delete_participant}',
                                            'buttons' => [
                                                'approve' => function ($url, $model) {
                                                    return Html::a('Approve', 
                                                        $url,['title'=> Yii::t('app','Approve'),'class'=>'btn blue-chambray']);

                                                },
                                                'delete_participant' => function ($url, $model) {
                                                    return Html::a('Delete', 
                                                        $url,['title'=> Yii::t('app','Delete'),'class'=>'btn blue-chambray','data-confirm'=>'Are sure want to delete this participant ?','data-method'=>'post']);

                                                },

                                            ],
                                        ],
                                            // ['class' => 'yii\grid\ActionColumn'],
                                    ],
                                ]); ?>
                            <?php Pjax::end(); ?>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="approved">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase">Approved Participants</span>
                </div>
                <div class="actions">
                    <!-- <?= Html::a('Create Event', ['create'], ['class' => 'btn blue-steel']) ?> -->
                </div>
            </div>
            <div class="row">
                <div class='col-xs-12 table-responsive'>
                    <div class="portlet-body">
                        <div class="event-reg-participant-index">

                            <?php Pjax::begin(); ?>    <?= GridView::widget([
                                    'dataProvider' => $dataProvider_confirm,
                                    // 'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                            'name_participant',
                                            'regname.company_name',
                                            'email:email',
                                            [
                                                'attribute' => 'mobile_phone',
                                               'format' => ['raw'],
                                                'value' => 'mobile_phone',
                                            ],
                                            
                                            [
                                                'label'=>'Action',
                                                'format' => 'raw',
                                                'value'=>function ($data) {
                                                    if ($data->reminder == '') {
                                                        return Html::a('Reminder',['remind','id'=>$data->id],['class'=>'btn btn-sm blue-chambray']);
                                                    }
                                                    elseif ($data->reminder == 'first') {
                                                        return Html::a('Remind Again',['remind','id'=>$data->id],['class'=>'btn btn-sm btn-warning']);
                                                    }
                                                    else{
                                                        return Html::a('<span class="btn btn-sm green-meadow">'.$data->status.'</span>');
                                                    }
                                                },
                                            ],
                                    ],
                                ]); ?>
                            <?php Pjax::end(); ?>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

