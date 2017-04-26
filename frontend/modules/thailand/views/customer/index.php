
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer List';
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
                      <b><?= Html::a('Create', ['create','module_id'=>$module_id], ['class' => 'btn blue-steel']) ?></b>

                </div>
                <br><br>
                 <?php echo $this->render('_search', ['model' => $searchModel,'module_id'=>$module_id]); ?>

            </div>

            <div class="portlet-body flip-scroll">

                <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                                //'cust_code',
                                'company_name',
                                'telephone_no',
                                'state.state',
                                //'fax_no',
                                //'email:email',

                            [
                                'header' => 'Action',
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{view}{edit}{delete}',
                                    'buttons' => [
                                        'view' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-file-o"></i>',$url, [
                                                        'title' => 'View',
                                                        'class' => 'btn btn-circle btn-icon-only blue-chambray'

                                            ]);

                                        },

                                        'edit' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-edit"></i>',$url, [
                                                        'title' => 'Update',
                                                        'class' => 'btn btn-circle btn-icon-only blue-chambray'
                                            ]);
                                        },

                                        'delete' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-trash-o"></i>',$url, [
                                                        'title' => 'Delete',
                                                        'data-confirm'=>"Are You Sure Want To Delete This Item ?",
                                                        'data-method' => 'post',
                                                        'class' => 'btn btn-circle btn-icon-only blue-chambray'
                                            ]);

                                        },

                                    ],
                                    'urlCreator' => function ($action, $model, $key, $index) {
                                        if ($action === 'view') {
                                            $url = ['customer/view','id'=>$model->id];
                                            return $url;
                                        }
                                        if ($action === 'edit') {
                                            $url = ['customer/update','id'=>$model->id,'module_id'=>$model->module_id];
                                            return $url;
                                        }
                                        if ($action === 'delete') {
                                            $url = ['customer/delete','id'=>$model->id,'module_id'=>$model->module_id];
                                            return $url;
                                        }
                                    }
                                ],




                        ],
                        'tableOptions' =>[
                            'class' => 'table table-bordered table-striped table-condensed flip-content',
                        ],



                    ]); ?>

            </div>
        </div>
    </div>
</div>
