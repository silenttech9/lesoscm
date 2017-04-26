<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\TelemarketingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Telemarketing';
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
                      <b><?= Html::a('Create',FALSE, ['value'=>Url::to(['telemarketing/create','state_id'=>$state_id]),'class' => 'btn blue-steel create','id'=>'create']) ?></b>
                </div>
                <br><br>
                 <?php echo $this->render('_search', ['model' => $searchModel,'state_id'=>$state_id]); ?>

            </div>

            <div class="portlet-body flip-scroll">
               
                <?php Pjax::begin(); ?>    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'datetime',
                             [
                                'label' => 'Program / Product',
                                'attribute' => 'product',
                                'value' => 'product.program_product'
                             ],
                             [
                                'label' => 'Telemarketers',
                                'attribute' => 'telemarket',
                                'value' => 'telemarket.username'
                             ],


                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{process}  {edit}  {delete}',
                                'buttons' => [
                                    'process' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-headphones"></i>',$url, [
                                                    'title' => 'Add Telemarketing',
                                                    'class' => 'btn btn-circle btn-icon-only blue-chambray'

                                        ]);

                                    },
                                    'edit' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-edit"></i>',FALSE, $url);
                                    },

                                    'delete' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                                                    'data-confirm'=>"Are You Sure Want To Delete This Item ?",
                                                    'data-method' => 'post',
                                                    'title' => 'Delete',
                                                    'class' => 'btn btn-circle btn-icon-only blue-chambray'
                                        ]);

                                    },

                                ],
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'process') {
                                        $url = ['telemarketing/process','id'=>$model->id];
                                        return $url;
                                    }
                                    if ($action === 'edit') {
                                        $url = ['value'=>Url::to(['telemarketing/update','id'=>$model->id]),'class'=>'btn btn-circle btn-icon-only blue-chambray update','title'=>'Edit'];
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url = ['telemarketing/delete','id'=>$model->id,'state_id'=>$model->state_id];
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

