<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\EventManager */

$this->title = 'Event Details';
$this->params['breadcrumbs'][] = ['label' => 'Event Managers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if(Yii::$app->session->hasFlash('uploadsuccess')):?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert"></button>
                     <?php echo  Yii::$app->session->getFlash('uploadsuccess'); ?>
                </div>
            <?php endif; ?>
<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= $this->title ?></span>
                </div>
                <div class="actions">
                    
                    <?= Html::a('Upload Invitation',FALSE, ['value'=>Url::to(['upload_invite','id'=>$model->id]),'class' => 'uploadExcel btn blue-chambray','id'=>'','title' => 'Upload',]) ?>
                </div>
            </div>
            
            <br>
            <div class="portlet-body">
                <div class="panel panel-default">
                    <div class = "panel-heading">Event Information</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <div class="event-manager-view ">

                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            // 'id',
                                            'title',
                                            'organizer_email',
                                            'phone_organizer',
                                            [
                                                'label' => 'Objective Event',
                                               'format' => ['raw'],
                                                'value' => $model->objective_event,
                                            ],
                                            [
                                                'label' => 'Date Event',
                                               'format' => ['raw'],
                                                'value' => date('d-m-Y',strtotime($model->date_event)),
                                            ],
                                            [
                                                'label' => 'Time Event',
                                               'format' => ['raw'],
                                                'value' => $model->time_event_start.' - '.$model->time_event_end,
                                            ],
                                            'venue_event',
                                            [
                                                'label' => 'Address Event',
                                               'format' => ['raw'],
                                                'value' => $model->address_event,
                                            ],
                                            
                                            // 'objective_event:ntext',
                                            
                                            'max_participant_perevent',
                                            'max_participant_percompany',
                                            [
                                                'attribute'=>'img_brochure',
                                                'value'=>Yii::$app->request->baseUrl.'/uploads/event/'.$model->img_brochure,
                                                'format' => ['image',['width'=>'300','height'=>'300','class'=>'']],
                                                // 'value'=>Html::img(Yii::$app->request->baseUrl.'/uploads/event/'.$model->img_brochure,['width'=>'100','height'=>'100', 'class'=>'img-responsive']),
                                                // 'format'=>'raw'

                                            ],
                                        ],
                                    ]) ?>

                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class = "panel-heading">Event Session</div>
                    <div class="panel-body">
                        <div class="event-manager-view">
                            <table class="table">
                                <tr>
                                    <th>Time</th>
                                    <th>Activity</th>
                                </tr>
                                <?php foreach ($model2 as $key => $value) { ?>
                                    <tr>
                                        <td width="100"><?= $value->time ?></td>
                                        <td><?= $value->activity ?></td>
                                    </tr>
                                <?php }?>
                                
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

