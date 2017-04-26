<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\all\SalesActivity */

?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light ">
			<div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase">History Job Order</span>
                </div>
            </div>
            <div class="portlet-body">
            	<table class="table table-striped">
            		<tr>
            			<th>Date</th>
                        <th>Company Name</th>
                        <th>Status</th>
                        <th>Job Order No</th>
                        <th>Enter By</th>
            		</tr>
            		<?php foreach ($model as $key => $value) { ?>
                    <tr>
                        <td><?= $value['date_joborder']?></td>
                        <td><?= $value['company_name']?></td>
                        <td><?= $value['status']?></td>
                        <td><?= $value['job_order_no']?></td>
                        <td><?= $value['username']?></td>
                    </tr>
                    <?php } ?>
            	</table>
            </div>
		</div>
	</div>
</div>