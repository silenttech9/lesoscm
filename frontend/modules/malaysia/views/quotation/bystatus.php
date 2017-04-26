<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;
use frontend\modules\malaysia\models\Quotation;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quotations';
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
$(document).ready(function(){
    $('#advancedsearch').click(function() {
        $('.basicsearch').hide();
        $('#advancedsearch').hide();
        $('.btnbasic').show();
        $('.formadvanced').show();
    });

});
JS;
$this->registerJs($script);

?>
<!-- <div class="row">
    <div class="col-md-12">
        <div class=" ">
            <div class="">
                
            </div>
        </div>
    </div>
</div>
<br> -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="pull-right">
                <?php if(Yii::$app->request->get('reset')){ ?>
                    <?= Html::a('Basic Search',['index','state_id'=>$state_id],['class'=>'btn btn-sm btn-outline dark']) ?>
                <?php } else{ ?>
                <a href="#" id="advancedsearch" class="btn btn-sm btn-outline dark">Filter</a>
                <?= Html::a('Basic Search',['index','state_id'=>$state_id],['class'=>'btn btn-sm btn-outline dark btnbasic','style'=>'display:none']) ?>
                <?php } ?>
            </div>
            <br>
            <div class="basicsearch">
                <div class="search-page search-content-4">
                    <div class="search-bar" >
                        <div class="row">
                            <?php if(!Yii::$app->request->get('reset')){ ?>
                                <?php echo $this->render('_searchbystatus_page', ['model' => $searchModel,'state_id'=>$state_id,'status'=>Yii::$app->request->get('status'),'agent'=>Yii::$app->user->identity->id]); ?>
                            <?php }else{} ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="formadvanced" <?php if(Yii::$app->request->get('reset')){}else{ ?> style="display: none; <?php }?>">
                <?php echo $this->render('_searchadv', ['model' => $searchModel,'state_id'=>$state_id]); ?>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">

        <div class="portlet light ">
        <div class="portlet-title">

            <div class="caption">
                <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
            </div>
            <div class="actions">
                  <b><?= Html::a('Create', ['create','state_id'=>$state_id], ['class' => 'btn blue-steel']) ?></b>
             
            </div>
<!--             <br><br>
                <div class="basicsearch">
                    <?php echo $this->render('_search', ['model' => $searchModel,'state_id'=>$state_id]); ?>
                </div>
                <div class="formadvanced" style="display: none;">
                    <?php echo $this->render('_searchadv', ['model' => $searchModel,'state_id'=>$state_id]); ?>
                </div>
             <br>
             <br> -->
             
             
        </div>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/malaysia/quotation/index?state_id=<?php echo Yii::$app->request->get('state_id') ?>" class="icon-btn">
                    
                    <i class="fa fa-dollar"></i>
                    <div> All </div>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/malaysia/quotation/bystatus?state_id=<?php echo Yii::$app->request->get('state_id') ?>&status=Pending&agent=<?php echo Yii::$app->user->identity->id ?>" class="icon-btn">
                    <i class="fa fa-hourglass-2"></i>
                    <div> Pending </div>
                    <?php $count = Quotation::pending(Yii::$app->request->get('state_id')); ?>
                    <span class="<?php echo ($count != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count != 0 ? $count : ''); ?>  </span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/malaysia/quotation/bystatus?state_id=<?php echo Yii::$app->request->get('state_id') ?>&status=Win&agent=<?php echo Yii::$app->user->identity->id ?>" class="icon-btn">
                    <i class="fa fa-money"></i>
                    <?php $count1 = Quotation::win(Yii::$app->request->get('state_id')); ?>
                    <div> Win </div>
                    <span class="<?php echo ($count1 != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count1 != 0 ? $count1 : ''); ?>  </span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/malaysia/quotation/bystatus?state_id=<?php echo Yii::$app->request->get('state_id') ?>&status=Lost&agent=<?php echo Yii::$app->user->identity->id ?>" class="icon-btn">
                    <i class="fa fa-caret-square-o-down"></i>
                    <div> Lost </div>
                    <?php $count2 = Quotation::lost(Yii::$app->request->get('state_id')); ?>
                    <span class="<?php echo ($count2 != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count2 != 0 ? $count2 : ''); ?>  </span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/malaysia/quotation/bystatus?state_id=<?php echo Yii::$app->request->get('state_id') ?>&status=Active&agent=<?php echo Yii::$app->user->identity->id ?>" class="icon-btn">
                    <i class="fa fa-briefcase"></i>
                    <div> Active </div>
                    <?php $count3 = Quotation::active(Yii::$app->request->get('state_id')); ?>
                    <span class="<?php echo ($count3 != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count3 != 0 ? $count3 : ''); ?>  </span>
                </a>
                <a href="<?php echo Yii::$app->request->baseUrl ?>/malaysia/quotation/bystatus?state_id=<?php echo Yii::$app->request->get('state_id') ?>&status=Requote&agent=<?php echo Yii::$app->user->identity->id ?>" class="icon-btn">
                    <i class="fa fa-history"></i>
                    <div> Requote </div>
                    <?php $count4 = Quotation::requote(Yii::$app->request->get('state_id')); ?>
                    <span class="<?php echo ($count4 != 0 ? 'badge badge-danger' : ''); ?>"><?php echo ($count4 != 0 ? $count4 : ''); ?>  </span>
                </a>
                <br>
                <br>
        <div class="portlet-body flip-scroll">
                    <?php Pjax::begin(); ?>    
                    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            // 'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'datetime',
                                 [
                                    'label' => 'CUSTOMER',
                                    'attribute' => 'customer',
                                    'value' => 'customer.company_name'
                                 ],
                                 [
                                    'label' => 'QUOTATION NO',
                                    'attribute' => 'quotation_no',
                                    'value' => function ($data){
                                            return $data->quotation_no.$data->revise;

                                    },
                                 ],

                                /*[
                                    'label' => 'TENDER',
                                    'attribute'=>'tender',
                                    'format' => 'raw',
                                    'filter'=>array("Yes"=>"Yes","No"=>"No"),
                                    'value' => function ($model) {
                                                $var = ($model->tender == "Yes") ? "Yes" : "No";
                                                return $var;
                                      
                                           // return '<div>'.$model->id.' and other html-code</div>';
                                    },
                                ], */
                                 [
                                    'label' => 'QUOTED BY',
                                    'attribute' => 'quoted',
                                    'value' => 'quoted.username'
                                 ],
                                 'agent.agent',
                                 [
                                    'attribute'=>'amount',
                                    'value'=>function($data){
                                        return number_format((float)$data->amount,2,'.',',');
                                    },
                                    
                                 ],
                                 /* salesman */
                                 [
                                    'label' => 'Status Quotation',
                                    'attribute' => 'status_quote',
                                    'format'=>'raw',
                                    'visible'=>User::checkMenu('85'),
                                    'value'=>function ($data) {
                                            if ($data->status_quote == '') {
                                                return '';
                                            }
                                            else{
                                                if ($data->status_quote == 'Win') {
                                                    return Html::a('<span style="">'.$data->status_quote.'</span>',['status_quote','id'=>$data->id,'state_id'=>$data->state_id],['class'=>'btn btn-sm green-meadow']);
                                                }
                                                elseif($data->status_quote == 'Lost'){
                                                    return Html::a('<span style="">'.$data->status_quote.'</span>',['status_quote','id'=>$data->id,'state_id'=>$data->state_id],['class'=>'btn btn-sm btn-danger']);
                                                }
                                                elseif($data->status_quote == 'Active'){
                                                    return Html::a('<span style="">'.$data->status_quote.'</span>',['status_quote','id'=>$data->id,'state_id'=>$data->state_id],['class'=>'btn btn-sm blue-chambray']);
                                                }
                                                elseif($data->status_quote == 'Requote'){
                                                    return Html::a('<span style="">'.$data->status_quote.'</span>',['status_quote','id'=>$data->id,'state_id'=>$data->state_id],['class'=>'btn btn-sm purple']);
                                                }
                                                else{
                                                    return Html::a('<span style="color:black !important;">'.$data->status_quote.'</span>',['status_quote','id'=>$data->id,'state_id'=>$data->state_id],['class'=>'btn btn-sm btn-warning']);
                                                }
                                                
                                            }
                                            
                                        },
                                 ],
                                 /* indoor */
                                 [
                                    'label' => 'Status Quotation',
                                    'attribute' => 'status_quote',
                                    'format'=>'raw',
                                    'visible'=>User::checkMenu('87'),
                                    'value'=>function ($data) {
                                            if ($data->status_quote == '') {
                                                return '';
                                            }
                                            else{
                                                if ($data->status_quote == 'Win') {
                                                    return '<span class="btn btn-sm green-meadow">'.$data->status_quote.'</span>';
                                                }
                                                elseif($data->status_quote == 'Lost'){
                                                    return '<span class="btn btn-sm btn-danger">'.$data->status_quote.'</span>';
                                                }
                                                elseif($data->status_quote == 'Active'){
                                                    return '<span class="btn btn-sm blue-chambray">'.$data->status_quote.'</span>';
                                                }
                                                else{
                                                    return '<span class="btn btn-sm btn-warning">'.$data->status_quote.'</span>';
                                                }
                                            }
                                            
                                        },
                                 ],
                                 /* Indoor */
                                 [
                                    'label' => 'Sale Review',
                                    'attribute' => 'sales_review_datetime',
                                    'format'=>'raw',
                                    'visible'=>User::checkMenu('86'),
                                    'value'=>function ($data) {
                                            if ($data->status_quote == '') {
                                                return '';
                                            }
                                            else{
                                                return '<span>'.$data->sales_review_datetime.'<br>'.$data->sales_review.'</span>';
                                                
                                                
                                            }
                                            
                                        },
                                 ],
                                 /* Salesman */
                                 [
                                    'label' => 'Sale Review',
                                    'attribute' => 'sales_review_datetime',
                                    'format'=>'raw',
                                    'visible'=>User::checkMenu('88'),
                                    'value'=>function ($data) {
                                            if ($data->status_quote == '') {
                                                return '';
                                            }
                                            else{
                                                return '<span>'.$data->sales_review_datetime.'<br>'.$data->sales_review.'</span>';
                                                
                                                
                                            }
                                            
                                        },
                                 ],
             /*[
                'label' => 'REVISE BY',
                'attribute' => 'quoted',
                'value' => 'reviseby.username'
             ],

                                [
                                    'label' => 'STATUS',
                                    'format' => 'raw',
                                    'value' => function ($model) {

                                            if ($model->status == "Progress") {

                                                return "<span class='btn btn-xs yellow'>In Progress</span>";
                                                
                                            } else {

                                                return "<span class='btn btn-xs green-jungle'>Solve</span>";

                                            }
                                      
                                            
                                    },

                                ], */


                                [
                                    'header' => 'Action',
                                    'class' => 'yii\grid\ActionColumn',
                                    'template'=>'{quotation}',
                                        'buttons' => [
                                            /*'stock' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-random"></i>',$url, [
                                                            'title' => 'Add Stock',
                                                            'class' => 'btn btn-circle btn-icon-only blue-chambray'

                                                ]);

                                            },

                                            'edit' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-edit"></i>',$url, [
                                                            'title' => 'Update',
                                                            'class' => 'btn btn-circle btn-icon-only blue-chambray'
                                                ]);
                                            },

                                            'info' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-file-text-o"></i>',$url, [
                                                            'title' => 'Quotation Info',
                                                            'class' => 'btn btn-circle btn-icon-only blue-chambray'
                                                ]);
                                            },*/
                                            'quotation' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-file-pdf-o"></i>',$url, [
                                                            'title' => 'View Quotation',
                                                            'class' => 'btn btn-circle btn-icon-only blue-chambray',

                                                ]);
                                            },


                                        ],
                                        'urlCreator' => function ($action, $model, $key, $index) {
                                           /* if ($action === 'stock') {
                                                $url = ['quotation/stock','id'=>$model->id];
                                                return $url;
                                            }
                                            if ($action === 'edit') {
                                                $url = ['quotation/update','id'=>$model->id];
                                                return $url;
                                            }
                                            if ($action === 'info') {
                                                $url = ['quotation/info','id'=>$model->id];
                                                return $url;
                                            }*/
                                            if ($action === 'quotation') {
                                                $url = ['quotation/quotation','id'=>$model->id,'state_id'=>$model->state_id];
                                                return $url;
                                            }

                                            /*if ($action === 'delete') {
                                                $url = ['quotation/delete','id'=>$model->id];
                                                return $url;
                                            }*/
                                        }
                                    ],




                            ],
                        'tableOptions' =>[
                            'class' => 'table table-bordered table-striped table-condensed flip-content',
                        ],


                        ]); ?>
                    <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>