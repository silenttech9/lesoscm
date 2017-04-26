
<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
<h3><?= $model2->title ?></h3>
<p style="color:#00BFFF;font-size: 18px;">Thank You !</p>
<hr style="color:#00BFFF">
<p>Dear Sir/Madam,</p>
<p>Welcome to <?= $model2->title ?></p>

<p>Thank you for your valuable time to attend this event. Please check out our upcoming events and visit our main events page at <a href="http://lesoscm.com/eventmanager/web/site/home">http://lesoscm.com/eventmanager/web/site/home</a></p>

<p>
	We would love to know how your experience with Lesoshoppe events is going. Please take a few minutes to offer your feedback. Your answers will be kept entirely confidental.
</p>
<p style="color:#FF0000;">
	To help us improve, please <a href="http://lesoscm.com/eventmanager/web/site/survey?id=<?= $model->id ?>&eventid=<?= $model->event_id ?>">click here</a> to complete this survey.
</p>
<p>All the best for the future.</p>
<p>Kind Regards,</p>
<p>Event Management.</p>
<p>Lesoshoppe Sdn Bhd</p>