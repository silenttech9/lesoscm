<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\all\TelemarketingHistory */


$this->params['breadcrumbs'][] = ['label' => 'Telemarketing Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telemarketing-history-view">

<table class="table">
    
<thead>
    <tr>
        <th>Date Created</th>
        <th>Date Update</th>
        <th>Log History</th>
        <th>Enter By</th>
        <th>Update By</th>
    </tr>
</thead>
<tbody>
         <?php foreach ($model_history as $key => $value) {
            $history = unserialize($value['history']); ?>
    <tr>
        <td><?php echo $value['date_create']; ?></td>
        <td><?php echo $value['date_update']; ?></td>
        <td>

            <?php 
           foreach ($history as $key => $value_history) {
                echo "<ul>";
                echo "<li> <b>Company : </b>".$value_history['company']."</li>";
                echo "<li> <b>Customer PIC : </b>".$value_history['pic']."</li>";
                echo "<li> <b>Activity : </b>".$value_history['activity']."</li>";


                
                echo "</ul>";

            } ?>
        
        </td>
        <td><?php echo $value['enterBy']; ?></td>
        <td><?php echo $value['updateBy']; ?></td>
    </tr>
    <?php } ?>
</tbody>

</table>

</div>
