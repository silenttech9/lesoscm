<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\LookupDeliveryModeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Delivery Type';
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
                 <b><?= Html::a('Create',FALSE, ['value'=>Url::to(['lookup-delivery-mode/create','module_id'=>$module_id]),'class' => 'btn blue-steel create','id'=>'create']) ?></b>
             
            </div>
            <br><br>
             <?php echo $this->render('_search', ['model' => $searchModel,'module_id'=>$module_id]); ?>

        </div>

        <div class="portlet-body flip-scroll">
            <?php Pjax::begin(); ?>   
            <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'delivery_type',
                        [
                            'header' => 'ACTION',
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{view}   {edit}   {delete}',
                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-file-o"></i>',FALSE, $url);

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
                                    if ($action === 'view') {
                                        $url = ['value'=>Url::to(['lookup-delivery-mode/view','id'=>$model->id]),'class'=>'btn btn-circle btn-icon-only blue-chambray view','title'=>'View'];
                                        return $url;
                                    }
                                    if ($action === 'edit') {
                                        $url = ['value'=>Url::to(['lookup-delivery-mode/update','id'=>$model->id]),'class'=>'btn btn-circle btn-icon-only blue-chambray update','title'=>'Edit'];
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url = ['lookup-delivery-mode/delete','id'=>$model->id,'module_id'=>$model->module_id];
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