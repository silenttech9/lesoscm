	<div style="padding: 20px;">

		<p style="text-align: center;font-size: 20px;font-weight: bold">
			Service Note
		</p>
		<div style="text-align:right;">
			Date :<span style=''><?= strtok($model->date_joborder," "); ?></span>
		</div>
		<br>
		<div class="row">
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				Customer : <?= $model->custname->company_name ?>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				Service Note: <?= $model->job_order_no ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
				User Name : <?= isset($model->personname->name) ? $model->personname->name : '' ?>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				Tel : <?= isset($model->personname->telephone_no) ? $model->personname->country_code_phone.$model->personname->area_code_phone.$model->personname->telephone_no : '' ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				Salesman : <?= $model->pic->salesman ?>
			</div>
		</div>
		<br>
		<table class="table main" >
			<thead>
				<tr>
					<th>Description</th>
					<th>Brand</th>
					<th>Model</th>
					<th>S/N</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?= $model->description ?></td>
					<td><?= $model->brand ?></td>
					<td><?= $model->model ?></td>
					<td><?= $model->serial_no ?></td>
				</tr>
			</tbody>
		</table>
		<br>
		<?php if ($model->received_by == 'Others') { ?>
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					Received By : <?= $model->other_received_by ?>
				</div>
			</div>
		<?php }else{ ?>
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					Received By : <?= $model->received_by ?>
				</div>
			</div>
		<?php } ?>
		<br>
		<div class="row">
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				Received By : <?= $model->receiver_name ?>
			</div>
		</div>
		
		<br>
		<table width="100%" height='800' cellpadding="10" style="table-layout: fixed;border: 0.5px solid black;">
			<tr>
				<td align="right" valign="top" width="20%">Remark :</td>
				<td width="80%"><?= $model->remark ?> </td>
			</tr>
		</table>
		<br>
		<div class="row">
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				Received by,<br><br>
				_________________________
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				Send out, <br><br>
				_________________________
			</div>
		</div>
	</div>


