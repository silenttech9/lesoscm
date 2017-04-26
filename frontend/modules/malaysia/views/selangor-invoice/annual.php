<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\StockReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Annual Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="portlet light ">


        <div class="portlet-title">

            <div class="caption">
                <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
            </div>

            <br><br>
             <?php echo $this->render('_carian', ['model' => $searchModel,'state_id'=>$state_id]); ?>

        </div>

        <div class="portlet-body flip-scroll">


                <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'ref_no',
                            'company_name',
                            [
                                'header' => 'Action',
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{view}',
                                    'buttons' => [
                                        'view' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-file-o"></i>',$url, [
                                                        'title' => 'View',
                                                        'class' => 'btn btn-circle btn-icon-only blue-chambray'

                                            ]);

                                        },

                                    ],
                                    'urlCreator' => function ($action, $model, $key, $index) {
                                        if ($action === 'view') {
                                            $url = ['/warranty/view','id'=>$model->id];
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
