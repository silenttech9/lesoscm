<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Stock;
use common\models\LookupUnitOfMeasure;
use marqu3s\summernote\Summernote;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\malaysia\models\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$uom = ArrayHelper::map(LookupUnitOfMeasure::find()->asArray()->all(), 'id', 'unit_of_measure');
$stock = ArrayHelper::map(Stock::find()->where(['id'=>$model2->stock_id])->asArray()->all(),'id','ITEM_NO');

$this->title = 'Quotation No : ' .$model->quotation_no.''.$model->revise;
$this->params['breadcrumbs'][] = ['label' => 'Quotations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php if ($model->status == "Confirm") { ?>

<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="actions">

                    <b><?= Html::a('<i class="fa fa-clipboard"></i>', ['quotation', 'id' => $model->id,'country_id'=> 3], ['class' => 'btn blue-chambray','title' => 'View Quotation']) ?></b>

                    <b><?= Html::a('Revise', ['revise', 'id' => $model->id,'country_id'=> 3], ['class' => 'btn blue-steel','title' => 'Revise']) ?></b>

                </div>
            </div>
            <div class="portlet-body flip-scroll">

<?php
 $amount = 0;
 $discount = $model->discount;
    if (!empty($detail->getModels())) {
        foreach ($detail->getModels() as $key => $val) {
            $total = $val->quantity * $val->price;
            $amount += $total;
        }

    }
?>

<?= GridView::widget([
        'dataProvider' => $detail,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ITEM NO',
                'value' => function ($model) {

                        return $model->stock_id ? $model->stock->ITEM_NO : null;
                },

            ],
            'extra_description:html',
            [
                'label' => 'INFORMATION',
                'format' => 'raw',
                'value' => function ($data)
                {
                    $show = '<b>Quantity : </b> '. $data->quantity. '
                    <br><b>Unit of Measure : </b> '.$data->uom->unit_of_measure.'
                    <br><b>Price : </b> '. number_format((float)$data->price,2,'.',',').'
                    <br><b>Total Price : </b> '.number_format((float)$data->quantity * $data->price,2,'.',',').'

                    ';
                    return $show;
                }
            ],

        ],
        'tableOptions' =>[
            'class' => 'table table-bordered table-striped table-condensed flip-content',

        ],

                /*'tableOptions' =>[
            'class' => 'table table-striped table-hover',
            'data-toggle'=> 'table',
            'data-height'=>'300',
        ],*/




    ]); ?>
    <?php if ($model->discount == "" || $model->discount == 0) {
       echo "<b>Sub Total </b>: ".number_format((float)$amount,2,'.',',');
       echo "<br>";
       echo "<br>";

    } else {

        echo "<b>Total </b>: ".number_format((float)$amount,2,'.',',');

       echo "<br>";
       echo "<b>Discount </b>: ".number_format((float)$model->discount,2,'.',',');
       echo "<br>";
       echo "<br>";
       $subTotal = $amount - $discount;
       echo "<b>After Discount </b>: ".number_format((float)$subTotal,2,'.',',');
       echo "<br>";
       echo "<br>";


    } ?>

            </div>
        </div>
    </div>
</div>




<?php } else { ?>

<div class="row">
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>


                <div class="actions">

                    <b><?= Html::a('<i class="fa fa-cubes"></i>', FALSE, ['value'=>Url::to(['/stock/add','id'=>$model->id,'module_id'=>3]),'class' => 'btn blue-steel create','id'=>'create','title' => 'New Item']) ?></b>

                </div>


            </div>
            <div class="portlet-body">

    <label>SEARCH STOCK (<span class="font-red-soft font-sm">Press Enter Button Or Button Go To Search Stock</span>)</label>


    <div class="input-group ">

        <input type="text" name="globalSearch" id="searchGlobal" class="form-control searchGlobal">
        <span class="input-group-btn">
            <button class="btn grey" id="goStock" type="button">Go</button>
        </span>

    </div>


    <br>

    <!-- BEGIN PORTLET-->
    <div class="portlet light bordered" id="stockDiv" style="display:none;">

            <div class="scroller" id="stock-show" style="height: 100%;max-height:339px;" data-always-visible="1" data-rail-visible="0">
            </div>

    </div>

    <div class="stock-state"></div>



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model2, 'stock_id')->dropDownList($stock,
    [
        'id'=> 'stock-id-get',
        'class'=>'form-control'


    ]) ?>

    <?= $form->field($model2, 'extra_description')->widget(Summernote::className(), [
        'options' => ['rows' => 6,'id'=>'extra-desc'],

    ]) ?>

    <?= $form->field($model2, 'quantity')->textInput(['value'=>1,'class'=>'form-control']) ?>

    <?= $form->field($model2, 'unit')->dropDownList($uom,[
        'class'=>'form-control'
    ]) ?>

    <?= $form->field($model2, 'price')->textInput(['maxlength' => true,'class'=>'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton($model2->isNewRecord ? 'Save' : 'Update', ['class' => $model2->isNewRecord ? 'btn blue-steel' : 'btn blue-steel']) ?>
    </div>

    <?php ActiveForm::end(); ?>




            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">

                <div class="actions">

                    <b><?= Html::a('<i class="fa fa-sort-amount-asc"></i>', FALSE, ['value'=>Url::to(['quotation-thailand/discount','id'=>$model->id]),'class' => 'btn blue-chambray discount showDiscount','id'=>'discount','title' => 'Discount']) ?></b>

                    <b><?= Html::a('<i class="fa fa-clipboard"></i>', ['quotation', 'id' => $model->id,'country_id'=> 3], ['class' => 'btn blue-chambray','title' => 'View Quotation']) ?></b>

                    <b><?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn blue-steel','title' => 'Edit']) ?></b>

                </div>
            </div>
            <div class="portlet-body">

<?php
 $amount = 0;
 $discount = $model->discount;
    if (!empty($detail->getModels())) {
        foreach ($detail->getModels() as $key => $val) {
            $total = $val->quantity * $val->price;
            $amount += $total;
        }

    }
?>

<?= GridView::widget([
        'dataProvider' => $detail,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ITEM NO',
                'value' => function ($model) {

                        return $model->stock_id ? $model->stock->ITEM_NO : null;
                },

            ],
            [
                'label' => 'DESCRIPTION',
                'format' => 'raw',
                'value' => function ($data)
                {

                    $show = Html::a($data->extra_description,FALSE, ['value'=>Url::to(['quotation-details-thailand/description','id'=>$data->id]),'class' => 'showBg','id'=>'showBg']);

                    return $show;
                }
            ],



            [
                'label' => 'INFORMATION',
                'format' => 'raw',
                'value' => function ($data)
                {
                    $show = '<b>Quantity : </b> '. Html::a($data->quantity,FALSE, ['value'=>Url::to(['quotation-details-thailand/edit','id'=>$data->id,'item'=>'quantity']),'class' => 'show','id'=>'show']). '
                    <br><b>Unit of Measure : </b> '.Html::a($data->uom->unit_of_measure,FALSE, ['value'=>Url::to(['quotation-details-thailand/edit','id'=>$data->id,'item'=>'unit']),'class' => 'show','id'=>'show']).'
                    <br><b>Price : </b> '.Html::a(number_format((float)$data->price,2,'.',','),FALSE, ['value'=>Url::to(['quotation-details-thailand/edit','id'=>$data->id,'item'=>'price']),'class' => 'show','id'=>'show']).'
                    <br><b>Total Price : </b> '.number_format((float)$data->quantity * $data->price,2,'.',',').'

                    ';
                    return $show;
                }
            ],


            [
                'header' => 'ACTION',
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}',
                    'buttons' => [
                        /*'edit' => function ($url, $model) {
                            return Html::a('<i class="fa fa-edit"></i>',$url, [
                                        'title' => 'Update',
                                        'class' => 'btn btn-circle btn-icon-only blue-chambray'
                            ]);
                        }, */

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
                       /* if ($action === 'edit') {
                            $url = ['quotation-details/update','id'=>$model->id];
                            return $url;

                        }*/
                        if ($action === 'delete') {
                            $url = ['quotation-details-thailand/delete','id'=>$model->id,'quotation_id'=>$model->quotation_id];
                            return $url;
                        }
                    }
                ],
        ],
        'tableOptions' =>[
            'class' => 'table table-bordered table-striped table-condensed flip-content',

        ],

                /*'tableOptions' =>[
            'class' => 'table table-striped table-hover',
            'data-toggle'=> 'table',
            'data-height'=>'300',
        ],*/




    ]); ?>
    <?php if ($model->discount == "" || $model->discount == 0) {
       echo "<b>Sub Total </b>: ".number_format((float)$amount,2,'.',',');
       echo "<br>";
       echo "<br>";

    } else {

        echo "<b>Total </b>: ".number_format((float)$amount,2,'.',',');

       echo "<br>";
       echo "<b>Discount </b>: ".number_format((float)$model->discount,2,'.',',');
       echo "<br>";
       echo "<br>";
       $subTotal = $amount - $discount;
       echo "<b>After Discount </b>: ".number_format((float)$subTotal,2,'.',',');
       echo "<br>";
       echo "<br>";


    } ?>



            </div>
        </div>
    </div>
</div>





<?php } ?>
