<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\thailand\models\ThailandStockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thailand Stocks';
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
                    <span>Latest Data By : </span><?= $model->tarikh ?>
                      <b><?= Html::a('<i class="fa fa-upload"></i>',FALSE, ['value'=>Url::to(['thailand-stock/upload','country_id'=>3]),'class' => 'uploadExcel btn btn-circle btn-icon-only blue-chambray','id'=>'uploadExcel','title' => 'Upload',]) ?></b>
                </div>

                <br><br>
                 <?php echo $this->render('_search', ['model' => $searchModel,'country_id'=>$country_id]); ?>

            </div>

            <div class="portlet-body flip-scroll">

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ITEM_NO',
            'DESCRIPTION',
            'BAL',

        ],
    ]); ?>
<?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>
