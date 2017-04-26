<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\all\SalesActivity */

$this->title = 'View Sales Activity : '.$model->customer->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Sales Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="actions">

                    <b><?= Html::a('<i class="fa fa-tasks"></i>',FALSE, ['value'=>'#','class' => 'activityCreate btn blue-chambray','id'=>'activityCreate','title' => 'Add Customer']) ?></b>

                    <b><?= Html::a('Edit',FALSE, ['value'=>Url::to(['sales-activity/update','id'=>$model->id,'module_id'=>$model->module_id]),'class' => 'btn blue-steel update','id'=>'update','title' => 'Edit']) ?></b>
                 
                </div>

            </div>
            <div class="portlet-body">

                <div class="panel panel-primary" style="display:none;" id="show-activity">
                    <div class="panel-heading">
                        <h3 class="panel-title">Activity</h3>

                    </div>
                    <div class="panel-body"> <?= $this->render('activity', [
                    'model2'=> $model2,
                    'module_id'=>$model->module_id,
                    'mdl' => $mdl,

                    ] ); ?> </div>
                </div>


		    <?= DetailView::widget([
		        'model' => $model,
		        'attributes' => [
		            'datetime',
		            [
		                'attribute' => 'Customer',
		                //'value' => 'customer.NAME',
		                'value'=>$model->customer_id ? $model->customer->company_name : null,
		   
		            ],


		        ],
		    ]) ?>


            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12 col-sm-12">
	    <div class="portlet light ">
	        <div class="portlet-title">

	            <div class="caption">
	                <span class="caption-subject font-blue-dark bold uppercase">Sales Activity</span>
	            </div>
	        </div>
	        <div class="portlet-body">

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'activity:ntext',
             [
                'label' => 'Customer PIC',
                'value' => 'pic.name'
             ],

             [
                'label' => 'Agent',
                'value' => 'enter.username'
             ],
             'date_create',

            // 'id_sales_activity',
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}  {edit}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="fa fa-file-o"></i>',FALSE, $url);

                        },
                        'edit' => function ($url, $model) {
                            return Html::a('<i class="fa fa-edit"></i>',FALSE, $url);
                        },


                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {

                        if ($action === 'view') {
                            $url = ['value'=>Url::to(['sales-activity-log/view','id'=>$model->id]),'class'=>'btn btn-circle btn-icon-only blue-chambray activityView','title'=>'View'];
                            return $url;
                        }
                        if ($action === 'edit') {
                            $url = ['value'=>Url::to(['sales-activity-log/update','id'=>$model->id]),'class'=>'btn btn-circle btn-icon-only blue-chambray activityUpdate','title'=>'Edit'];
                            return $url;
                        }


                    }
                ],
        ],
    ]); ?>



	        </div>
	    </div>
	</div>
</div>