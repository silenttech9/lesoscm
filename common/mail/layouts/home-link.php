<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
<!-- <p><strong>Exclusive Invitation to Lesoshoppe “<?= $model->title?>” events - <?= Yii::$app->formatter->asDate($model->date_event,'long')?> (<?= $model->time_event_start ?> - <?= $model->time_event_end?> @ <?= $model->venue_event?>)</strong></p>
<p> -->
<p>
	<strong><?= $model->title?></strong>
</p>
<p>You are receiving this invitation because your company has been registered in the Test & Measurement Business Network.</p>
<p>Lesoshoppe's Application Technology Centre (ATC) is a CSR initiative to connects local societies to the global champions in applications and technologies, in search for the best equipments and technology solutions to improve the productivity, business and economy of our organisation and country. Over the years, hundreds of trainings have been conducted in universities as well as manufacturing and research organisations in Malaysia.  </p>
<p>
	As such, Lesoshoppe is pleased to invite you and your colleagues team to join our events on the <?= Yii::$app->formatter->asDate($model->date_event,'long') ?> <strong>(<?= $model->time_event_start ?> - <?= $model->time_event_end ?> @ <?= $model->venue_event ?>)</strong>
</p>
<p>
<!-- 	Benefit of attending the above session includes: -->
	<span style="margin-left: 15px;"><?= $model->objective_event ?></span>
</p>
<p>
	<strong>As seats are limited, please register soonest possible via the link below (Register before <?= Yii::$app->formatter->asDate($model->reg_due_date,'long') ?>):</strong><br>
	<a href="http://lesoscm.com/eventmanager/web/site/index?id=<?= $model->id ?>"><strong>http://lesoscm.com/eventmanager/web/site/index?id=<?= $model->id ?></strong></a>
</p>

<table width="100%" cellpadding="10">
	<tr>
		<td width="10%" valign="top">Date :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= Yii::$app->formatter->asDate($model->date_event,'long')?></strong></td>
	</tr>
	<tr>
		<td width="10%" valign="top">Time :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= $model->time_event_start.' - '.$model->time_event_end ?></strong></td>
	</tr>
	<tr>
		<td width="10%" valign="top">Name :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= $model->title ?></strong></td>
	</tr>
	<tr>
		<td width="10%" valign="top">Venue :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= $model->venue_event ?></strong></td>
	</tr>
	<tr>
		<td width="10%" valign="top">Address :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= $model->address_event ?></strong></td>
	</tr>
</table>

<?php if ($model->fee_event != '') { ?>
<p>
	<span style="font-size: 16px;">Fee : <?= $model->fee_event ?></span><br>
	<?php if ($model->incentive_company != ''): ?>
		(Every participating company will receive a RM<?= $model->incentive_company ?> Discount Coupon)
	<?php endif ?>
	
</p>
<?php }?>
<p>
	<?php if ($model->organizer_email != ''): ?>
		Should you require further information, please reach out to <?= $model->organizer_name ?> (<?= $model->phone_organizer ?>) or email us at (<?= $model->organizer_email ?>)
	<?php endif ?> 
</p>


<p>We look forward to receiving your registration as well as meeting you.
</p>
<p>Thank You & Best Regards,</p>
<p>
	<?php if($model->organizer_name != '') {?>
		<?= $model->organizer_name ?>
	<?php }?>
	<br>
	Lesoshoppe Event Management<br>
	Lesoshoppe Sdn Bhd<br>
	<?php if($model->organizer_email != ''){ ?>
	Email : <?= $model->organizer_email ?>
	<?php }?>
</p>
<img src="http://lesoscm.com/lscm/frontend/web/uploads/event/<?= $model->img_brochure ?>">