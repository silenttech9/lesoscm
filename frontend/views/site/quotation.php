<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel common\models\LookupAreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Searching Quotation';
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

             
            </div>
            <br><br>
            <div class="search-page search-content-2">
                <div class="search-bar ">
                    <div class="col-md-11">
                        <div class="input-group">

                            <input type="text" id="quotation-searching" class="form-control searchQt" placeholder="Search for...">
                            <input type="hidden" id="moduleQ" value="<?php echo $module_id; ?>">
                            <span class="input-group-btn">
                                <button type="submit" id="goQuotation" class="btn blue-hoki uppercase bold">Search</button>

                            </span>
                        </div>
                    </div>
                </div>
            </div>


        </div>

            <div class="portlet-body ">
                <div class="portlet light bordered" id="itemDiv" style="display:none;">

                    <div class="scroller" id="item-show" style="height: 100%;max-height:339px;" data-always-visible="1" data-rail-visible="0">
                    </div>
          
                </div>

                <div class="qtyshow">
                    
                </div>


            </div>





        </div>
    </div>
</div>