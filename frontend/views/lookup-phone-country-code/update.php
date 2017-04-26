<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LookupPhoneCountryCode */

$this->title = 'Update Lookup Phone Country Code: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lookup Phone Country Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lookup-phone-country-code-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
