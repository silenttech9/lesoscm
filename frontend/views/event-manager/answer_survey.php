<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\EventManager;
use yii\helpers\Url;

?>
<div class="row">
	<div class="col-xs-12 col-md-12 col-lg-12">
		<div class="portlet light">
			<div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue-dark bold uppercase">Survey Answer by - <?= $model2->name_participant ?></span>
                </div>
            </div>
            <div class="portlet-body">
            	<table class="table table-striped table-hover">
            		<?php 
            			$fullmark = 0;
            			foreach ($model as $mark) {
            				$fullmark = $fullmark + $mark['mark'];
            			}
            		?>
            		<thead>
            			<tr>
	            			<th>Question</th>
	            			<th>Answer</th>
	            			<th>Marks</th>
	            		</tr>
            		</thead>
            		<tfoot>
            			<tr>
            				<td></td>
            				<td>Fullmark</td>
            				<td><?= $fullmark; ?>/25</td>
            			</tr>
            		</tfoot>
            		<tbody>
            			<?php foreach ($model as $key => $value) { ?>
	            		<tr>
	            			<td><?= $value->question->question ?></td>
	            			<td><?= $value->answer ?></td>
	            			<td><?= $value->mark ?></td>

	            		</tr>
	            		<?php }?>
            		</tbody>
            		
            		
            	</table>

            	<h4>Total Percentage : <strong><?= ($fullmark / 25) * 100 ?>%</strong></h4>
            	
            </div>
		</div>
	</div>
</div>