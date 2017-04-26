<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\SelangorStockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listing Stock All Branch ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">

        <div class="portlet light ">

            <div class="portlet-title">

                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>


                   <?php  echo $this->render('_search', ['model' => $searchModel_selangor,'model_johor'=>$searchModel_johor,'model_penang'=>$searchModel_penang]); ?>

            </div>
            <span><h2><b>Selangor</b> - Latest Data By : <?= $model_s->tarikh ?></h2></span>
            <div class="portlet-body flip-scroll">
               	
				<?php Pjax::begin(); ?>    <?= GridView::widget([
				        'dataProvider' => $dataProvider_selangor,
				        //'filterModel' => $searchModel_selangor,
				        'tableOptions' => [
				            'class' => 'table table-striped table-bordered table-hover',
				        ],
				        'columns' => [
				            ['class' => 'yii\grid\SerialColumn'],
				            'ITEM_NO',
				            'DESCRIPTION',
				            //'LOCATION',
				            'BAL',
				            //'UNIT_COST',
				            //'TOTAL_COST',

				            //['class' => 'yii\grid\ActionColumn'],
				        ],
				    ]); ?>
				<?php Pjax::end(); ?>
                
            </div>
            <span><h2><b>Pulau Pinang</b> - Latest Data By : <?= $model_p->tarikh ?></h2></span>
            <div class="portlet-body flip-scroll">
               	
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider_penang,
        //'filterModel' => $searchModel_penang,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ITEM_NO',
            'DESCRIPTION',
            //'LOCATION',
            'BAL',
            //'UNIT_COST',
            //'TOTAL_COST',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
                
            </div>
            <span><h2><b>Johor Bahru</b> - Latest Data By : <?= $model_j->tarikh ?></h2></span>
            <div class="portlet-body flip-scroll">
               	
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider_johor,
        //'filterModel' => $searchModel_johor,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ITEM_NO',
            'DESCRIPTION',
            //'LOCATION',
            'BAL',
            //'UNIT_COST',
            //'TOTAL_COST',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
                
            </div>

        </div>
    </div>
</div>
