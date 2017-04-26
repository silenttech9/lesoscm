<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
<p><?= $model2->company_name ?>,</p>
<p><?= $model->name_participant ?>,</p>

<p><ins style="text-transform: uppercase;"><strong>Confirmation of participation in “<?= $model3->title ?>”</strong></ins></p>
<p>Dear Sir/Madam,</p>
<p>
We would like to confirm your company's and its representative(s) participation for the above event, as stated in the 'Registration Form' received. Event detail as follow:</p>

<table width="100%" cellpadding="10">
	<tr>
		<td width="10%" valign="top">Name :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= $model3->title ?></strong></td>
	</tr>
	<tr>
		<td width="10%" valign="top">Date :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= Yii::$app->formatter->asDate($model3->date_event,'long')?></strong></td>
	</tr>
	<tr>
		<td width="10%" valign="top">Venue :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= $model3->venue_event ?></strong></td>
	</tr>
	<tr>
		<td width="10%" valign="top">Address :</td>
		<td valign="top"><strong style="text-transform: uppercase;"><?= $model3->address_event ?></strong></td>
	</tr>
</table>
<br>

<?php if ($model3->fee_event != '') { ?>
<p>
	<span style="font-size: 16px;">Fee : <?= $model3->fee_event ?></span><br>
	<?php if ($model3->incentive_company != ''): ?>
		(Every participating company will receive a RM<?= $model3->incentive_company ?> Discount Coupon)
	<?php endif ?>
	
</p>
<?php }?>
<p>
	<?php if ($model3->organizer_email != ''): ?>
		Should you require further information, please reach out to <?= $model3->organizer_name ?> (<?= $model3->phone_organizer ?>) or email us at (<?= $model3->organizer_email ?>)
	<?php endif ?> 
</p>
<p>Thank You,</p>
<p>Event Management</p>
<p>Lesoshoppe Sdn Bhd</p>
<img src="http://lesoscm.com/lscm/frontend/web/uploads/event/<?= $model3->img_brochure ?>">