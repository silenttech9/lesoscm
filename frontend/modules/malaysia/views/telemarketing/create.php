<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\malaysia\models\Telemarketing */

$this->title = 'Telemarketing';
$this->params['breadcrumbs'][] = ['label' => 'Telemarketings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telemarketing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    	'state_id' => $state_id,
        'model' => $model,
    ]) ?>

</div>
