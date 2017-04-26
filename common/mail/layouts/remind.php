<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
<p>Dear Sir/Madam,</p>
<p>This is a kind reminder to attend our <?= $model2->title ?>. </p>

<p>Here are the details: </p>
<table width="100%" cellpadding="10">
	<tr>
		<td width="10%" valign="top">Name :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= $model2->title ?></strong></td>
	</tr>
	<tr>
		<td width="10%" valign="top">Date :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= Yii::$app->formatter->asDate($model2->date_event,'long')?></strong></td>
	</tr>
	<tr>
		<td width="10%" valign="top">Venue :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= $model2->venue_event ?></strong></td>
	</tr>
	<tr>
		<td width="10%" valign="top">Address Event :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= $model2->address_event ?></strong></td>
	</tr>
</table>
<br>
<?php if ($model2->fee_event != '') { ?>
<p>
	<span style="font-size: 16px;">Fee : <?= $model2->fee_event ?></span><br>
	<?php if ($model2->incentive_company != ''): ?>
		(Every participating company will receive a RM<?= $model2->incentive_company ?> Discount Coupon)
	<?php endif ?>
	
</p>
<?php }?>

<p>
	<?php if ($model2->organizer_email != ''): ?>
		Should you require further information, please reach out to <?= $model2->organizer_name ?> (<?= $model2->phone_organizer ?>) or email us at (<?= $model2->organizer_email ?>)
	<?php endif ?> 
</p>
<p>Thank You,</p>
<p>Event Management</p>
<p>Lesoshoppe Sdn Bhd</p>
<img src="http://lesoscm.com/lscm/frontend/web/uploads/event/<?= $model2->img_brochure ?>">