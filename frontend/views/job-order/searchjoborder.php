<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel common\models\LookupAreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Searching Job Order';
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
                            <form method="POST" action="<?= Yii::$app->request->baseUrl ?>/job-order/searchjoborder">
                                <input type="hidden" name="_csrf-frontend" value="bEJxWFJHTmgUASqeqOPsd.QWPOSweqDEPawq==">
                                <div class="input-group">
                                    <input type="text" id="" class="form-control" name="searchJoborder" placeholder="Eg. SN-KL-0000 or 01/01/2017">
                                    <span class="input-group-btn">
                                        <button type="submit" id="goQuotation" class="btn blue-hoki uppercase bold">Search</button>

                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
            <br>
                <table class="table table-striped table-condensed ">
                    
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Job Order No</th>
                        <th>Enter By</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($result as $key => $value) {?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?=  $value['date_joborder']?></td>
                            <td><?= $value['status'] ?></td>
                            <td><?= $value['job_order_no']?></td>
                            <td><?= $value['username']?></td>
                            <td>
                                <?= Html::a('View', ['view','id'=>$value['job_order_id']], ['class' => 'btn blue-chambray']) ?>
                                
                            </td>
                        </tr>
                    <?php }?>
                    
                </table>
            </div>
        </div>
    </div>
</div>