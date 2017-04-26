<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EventManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Target Participant';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= $this->title ?></span>
                </div>
                <div class="actions">
                    <?= Html::a('Send email', ['send_email','id'=>$id], ['class' => 'btn blue-steel']) ?>
                </div>
            </div>
            <div class="row">
                <div class='col-xs-12 table-responsive'>
                    <div class="portlet-body">
                        <div class="event-manager-index">
                            <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            // 'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                    'name',
                                    'company_name',
                                    'address_1',
                                    'address_2',
                                    'email',
                                    [
                                        'attribute'=>'status_email',
                                        'contentOptions' =>['class' => 'btn btn-sm btn-primary'],
                                        'content'=>function($data){
                                            return $data->status_email;
                                        }
                                    ],
                                    // 'address_3',
                                    // 'state',
                                    // 'email:email',
                                    // 'event_id',
                                    // 'created_at',
                                    // 'enter_by',

                                    // ['class' => 'yii\grid\ActionColumn'],
                            ],
                            'tableOptions' =>['class' => 'table table-striped'],
                        ]); ?>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

