<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\SalesActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="portlet light ">

            <div class="portlet-title">

                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="actions">
                      <b><?= Html::a('Create',FALSE, ['value'=>Url::to(['sales-activity/create','module_id'=>$module_id]),'class' => 'btn blue-steel create','id'=>'create']) ?></b>
                </div>
                <br><br>
                 <?php echo $this->render('_search', ['model' => $searchModel,'module_id'=>$module_id]); ?>

            </div>

            <div class="portlet-body flip-scroll">
               
                <?php Pjax::begin(); ?>    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'datetime',
                             [
                                'label' => 'Customer',
                                'attribute' => 'customer',
                                'value' => 'customer.company_name'
                             ],

                             [
                                'label' => 'Enter By',
                                'value' => 'enterby.username'
                             ],


                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{process}  {edit}',
                                'buttons' => [
                                    'process' => function ($url, $model) {
                                        return Html::a('View',$url, [
                                                    'title' => 'Add Sales Activities',
                                                    'class' => 'btn btn-sm blue-chambray'

                                        ]);

                                    },
                                    'edit' => function ($url, $model) {
                                        return Html::a('Edit',FALSE, $url);
                                    },

                                ],
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'process') {
                                        $url = ['sales-activity/process','id'=>$model->id];
                                        return $url;
                                    }
                                    if ($action === 'edit') {
                                        $url = ['value'=>Url::to(['sales-activity/update','id'=>$model->id,'module_id'=>$model->module_id]),'class'=>'btn btn-sm blue-chambray update','title'=>'Edit'];
                                        return $url;
                                    }

                                }
                            ],
                        ],
                        'tableOptions' =>['class' => 'table table-bordered table-hover table-condensed flip-content'],
                    ]); ?>
                <?php Pjax::end(); ?>
                
            </div>
        </div>
    </div>
</div>
