<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\thailand\models\TelemarketingHistory */

$this->title = 'Create Telemarketing History';
$this->params['breadcrumbs'][] = ['label' => 'Telemarketing Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telemarketing-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
