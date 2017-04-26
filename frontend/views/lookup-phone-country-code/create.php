<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LookupPhoneCountryCode */

$this->title = 'Create Lookup Phone Country Code';
$this->params['breadcrumbs'][] = ['label' => 'Lookup Phone Country Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-phone-country-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
