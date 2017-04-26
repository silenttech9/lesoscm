<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Warranty */

$this->title = 'Warranty';
$this->params['breadcrumbs'][] = ['label' => 'Warranties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
    'state_id' => $state_id,
]) ?>
