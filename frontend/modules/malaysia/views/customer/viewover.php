<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\Customer */

$this->title = $model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-5 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="actions">
                    <b><?= Html::a('Edit', ['updateover', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></b>
                </div>
            </div>
            <div class="portlet-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
                            'company_name',
                            'address:ntext',
                            [
                                'attribute' => 'Telephone No',
                                //'value' => 'customer.NAME',
                                'value'=>$model->country_code_phone.$model->area_code_phone.$model->telephone_no,
                   
                            ],
                            [
                                'attribute' => 'Fax No',
                                //'value' => 'customer.NAME',
                                'value'=>$model->country_code_fax.$model->area_code_fax.$model->fax_no,
                   
                            ],
                            'crlimit',
                            'term.term',
                            'area.area',
                            [
                                'attribute' => 'Sales Agent',
                                'value'=>$model->agent_id ? $model->sales->agent : null,
                                //'valeu' => $model->sales->username,
                            ],
                            //'salesAgent.username',
                            'stax.CODE',
                            'postcode',
                            'state.state',
                            'country.country',
                            'email:email',

        ],

    ]) ?>

            </div>

        </div>
    </div>


    <div class="col-lg-7 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase">Customer Person In Charge</span>
                </div>

            </div>
            <div class="portlet-body">
<?php Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'name',
                            [
                                'attribute' => 'Telephone No',
                                //'value' => 'customer.NAME',
                                'value' => function($model) {
                                    return $model->country_code_phone.$model->area_code_phone.$model->telephone_no;
                                }
                                
                   
                            ],
                            'extension',
                            [
                                'attribute' => 'Mobile No',
                                //'value' => 'customer.NAME',
                                'value' => function($model) {
                                    return $model->country_code_mobile.$model->area_code_mobile.$model->mobile_no;
                                }
                            ],
                            'email',
                        ],
                        'tableOptions' =>['class' => 'table table-striped table-hover'],
                    ]); ?>
<?php Pjax::end(); ?>


            </div>
        </div>
    </div>


    
</div>
