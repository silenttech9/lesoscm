<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel common\models\LookupProgramProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Searching';
$this->params['breadcrumbs'][] = $this->title;
?>


        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="portlet light">

                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark"><?= Html::encode($this->title) ?></span>
                        </div>
          
                    </div>


                    <div class="portlet-body">
                   

                        <div class="row">
                            <div class="col-md-6">
                                <label>Serial Number</label>
                                <input type="text" class="form-control input-lg serial" id="serial"> 
                            </div>
                            <div class="col-md-6">
                                <label>Invoice No</label>
                                <input type="text" class="form-control input-lg invoice" id="invoice"> 
                            </div>
                            <input type="hidden" id="state" value="<?php echo $state_id; ?>">


                        </div>
                        <br>

                        <button type="submit" id="goInvoice" class="btn blue-steel">Submit</button>

                    </div>

                    <br>

                    <div class="showinfo">
                        



                    </div>
                </div>
            </div>


        </div>


