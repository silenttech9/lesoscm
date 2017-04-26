<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\all\Quotation */

$this->title = 'Status Quotation No : ' .$model->quotation_no.''.$model->revise;
$this->params['breadcrumbs'][] = ['label' => 'Quotations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
$(document).ready(function(){
    $('#checkbox6').click(function() {
        if($(this).is(":checked")) {
            $("#winquote").prop('disabled', false);   
            $("#lostquote").prop('disabled', false);
            $("#activequote").prop('disabled', false);
            $("#sales_review").prop('disabled', false);
            $("#requote").prop('disabled', false);
            $(".submitsalesreview").prop('disabled', false);

            $("#lostquote").attr('checked', false);
            $("#winquote").attr('checked', false);  
        }
        else{
            $("#winquote").prop('disabled', true);
            $("#lostquote").prop('disabled', true);
            $("#activequote").prop('disabled', true);
            $("#sales_review").prop('disabled', true);
            $(".submitsalesreview").prop('disabled', true);
            $("#requote").prop('disabled', true);

            $("#lostquote").prop('checked', false); 
            $("#winquote").prop('checked', false);  
            $("#activequote").prop('checked', false); 
            $("#requote").prop('checked', false); 
            
        }
   });
});
JS;
$this->registerJs($script);
?>
<div class="row">
    <div class="col-xs-12">
        <div class="note note-warning">
            <h4>Current Status Quotation : <strong><?= $model->status_quote ?></strong></h4><br>
            <a href="#changestatus" class="btn btn-sm green-meadow uppercase">Change Status</a>
        </div>
    </div>
</div>
<div class="portlet-body">
    <div class="full-height-content-body">
   

                    <div class="invoice-content-2 ">
                        <div class="row invoice-head">
                            <div class="col-md-9 col-xs-6">
                               
                                <h2><b><?= $company->company_name; ?></b></h2>
                                <h5><?= $company->registeration_no; ?></h5>
                                <h5>GST Registeration No : <?= $company->gst_no; ?></h5>
                                    
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="company-address">
                                    <br/> <?= $company->address; ?>
                                    <br/>
                                    <span class="bold">TEL :</span> <?= $company->telephone_no1; ?> / <?= $company->telephone_no2; ?>
                                    <br/>
                                    <span class="bold">FAX :</span> <?= $company->fax_no; ?>
                                    <br/>
                                    <span class="bold">EMAIL :</span> <?= $company->email; ?> 
                                </div>
                            </div>
                        </div>


                        <div class="row invoice-head">
                            <div class="col-md-7 col-xs-6">
                            <?php

                            foreach ($model_quotation as $key => $value) { ?>
                                <h4><?php echo strtoupper($value['company']); ?></h4>
                                <h5><?php echo $value['addr']; ?> ,<?php echo $value['postcode']; ?> ,<?php echo $value['city']; ?> ,<?php echo strtoupper($value['state']); ?></h5>
                                <br/>
                                <h5><b>Telephone No :</b> <?php echo $value['country_code_phone']; ?><?php echo $value['area_code_phone']; ?><?php echo $value['telephone_no']; ?> / <b>Fax No. :</b> <?php echo $value['country_code_fax']; ?><?php echo $value['area_code_fax']; ?><?php echo $value['fax_no']; ?></h5>
                                <h5><b>Email :</b> <?php echo $value['email']; ?></h5>
                                <br>
                                <h5><b>Attn To :</b> <?php echo $value['attention']; ?> <b>Mobile No:</b> <?php echo $value['att_country_code_mobile']; ?><?php echo $value['att_area_code_mobile']; ?><?php echo $value['att_mobile_no']; ?></h5>
                                <h5><b>Email :</b> <?php echo $value['att_email']; ?></h5>
                                <br>
                                <?php if ($value['cc_customer'] == "") { ?>
             
                                <?php } else { ?>
                                    <h5><b>Cc To :</b> <?php echo $value['cc_customer']; ?> <b>Mobile No:</b> <?php echo $value['cc_country_code_mobile']; ?><?php echo $value['cc_area_code_mobile']; ?><?php echo $value['cc_mobile_no']; ?></h5>
                                    <h5><b>Email :</b> <?php echo $value['cc_email']; ?></h5>
                                <?php } ?>
                            <?php }?>
                            </div>
                            <div class="col-md-5 col-xs-6">
                                <div class="company-address">
                                    <h2><b>Quotation</b></h2>
                                    <?php foreach ($model_quotation as $key => $value) { ?>
                                        <h5>No . : <b><?php echo $value['quotation_no']; ?><?php echo $value['revise']; ?></b></h5>
                                        <h5>Term : <?php echo $value['term']; ?></h5>
                                        
                                        <?php if (!empty($value['revise'])) { ?>
                                            <h5>Date : <?php echo $value['date_revise']; ?></h5>
                                            <h5>Quoted By : <?php echo strtoupper($value['reviseQuotation']); ?></h5>
                                        <?php } else { ?>
                                            <h5>Date : <?php echo $value['date']; ?></h5>
                                            <h5>Quoted By : <?php echo strtoupper($value['quoted']); ?></h5>
                                        <?php } ?>
                                        
                                        <h5>Sales Agent : <?php echo $value['agent_quotation']; ?> - <?php echo $value['agent_phone']; ?></h5>
                                        <h5><?php echo $value['area']; ?></h5>
                                        <?php $tax = $value['tax'];?>
                                        <?php $currency = $value['currency'];?>
                                    <?php }?>


                                </div>
                            </div>

                        </div>

                        <?php if ($tax == "ZRE") { ?>

                        <div class="row invoice-body">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="invoice-title uppercase">No</th>
                                            <th class="invoice-title uppercase">Item</th>
                                            <th class="invoice-title uppercase">Description</th>
                                            <th class="invoice-title uppercase">Quantity</th>
                                            <th class="invoice-title uppercase">Unit Price (<?php echo $currency; ?>)</th>
                                            <th class="invoice-title uppercase">Amount (<?php echo $currency; ?>)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total = 0; $i =0; foreach ($model_stock as $key => $value) { $i++;?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <?php echo $value['ITEM_NO']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DESCRIPTION']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['quantity']; ?> <?php echo $value['unit_of_measure']; ?>
                                            </td>
                                            <td>
                                                <?php  echo number_format((float)$value['price'],2,'.',',');  ?>
                                      
                                            </td>
                                            <td>
                                                <?php $sum = $value['quantity'] * $value['price']; echo number_format((float)$sum,2,'.',','); $total += $sum; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5"><b>Total</b></th>
                                            <th><b><?php echo number_format((float)$total,2,'.',','); ?></b></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    <div class="row invoice-subtotal">
                        <div class="col-xs-4">
                            <h2 class="invoice-title uppercase">Subtotal</h2>
                            <p class="invoice-desc"><?php echo $currency; ?> <?php echo number_format((float)$total,2,'.',','); ?></p>
                        </div>
                         <?php foreach ($model_quotation as $key => $value) { ?>
                            <?php if ($value['discount'] == "" || $value['discount'] == 0) { ?>

                            <div class="col-xs-6">
                                <h2 class="invoice-title uppercase">Total</h2>
                                <p class="invoice-desc grand-total"><?php echo $currency; ?> <?php echo number_format((float)$total,2,'.',','); ?></p>
                            </div>
                            <?php } else { ?>

                                <div class="col-xs-2">
                                    <h2 class="invoice-title uppercase">Discount </h2>
                                    <p class="invoice-desc"><?php echo number_format((float)$value['discount'],2,'.',','); ?></p>
                                </div>

                                <div class="col-xs-2">
                                    <h2 class="invoice-title uppercase">After Discount</h2>
                                    <p class="invoice-desc"><?php $afterDis = $total - $value['discount']; echo number_format((float)$afterDis,2,'.',','); ?></p>
                                </div>

                            <div class="col-xs-2">
                                <h2 class="invoice-title uppercase">Total</h2>
                                <p class="invoice-desc grand-total"><?php echo $currency; ?> <?php echo number_format((float)$total = $afterDis,2,'.',','); ?></p>
                            </div>

                            <?php } ?>
                            
                         <?php } ?>

                    </div>


                        <?php } else { ?>
                        <div class="row invoice-body">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="invoice-title uppercase">No</th>
                                            <th class="invoice-title uppercase">Item</th>
                                            <th class="invoice-title uppercase">Description</th>
                                            <th class="invoice-title uppercase">Quantity</th>
                                            <th class="invoice-title uppercase">Unit Price (<?php echo $currency; ?>)</th>
                                            <th class="invoice-title uppercase">Amount (<?php echo $currency; ?>)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total = 0; $i =0; foreach ($model_stock as $key => $value) { $i++;?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <?php echo $value['ITEM_NO']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['DESCRIPTION']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['quantity']; ?> <?php echo $value['unit_of_measure']; ?>
                                            </td>
                                            <td>
                                                <?php  echo number_format((float)$value['price'],2,'.',',');  ?>
                                            </td>
                                            <td>
                                                <?php $sum = $value['quantity'] * $value['price']; echo number_format((float)$sum,2,'.',','); $total += $sum; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5"><b>Total</b></th>
                                            <th><b><?php echo number_format((float)$total,2,'.',','); ?></b></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    <div class="row invoice-subtotal">
                        <div class="col-xs-2">
                            <h2 class="invoice-title uppercase">Subtotal</h2>
                            <p class="invoice-desc"><?php echo $currency; ?> <?php echo $total; ?></p>
                        </div>
                         <?php foreach ($model_quotation as $key => $value) { ?>
                            <?php if ($value['discount'] == "" || $value['discount'] == 0) { ?>


                            <div class="col-xs-2">
                                <h2 class="invoice-title uppercase">GST (6%)</h2>
                                <p class="invoice-desc">6 %</p>
                            </div>
                            <div class="col-xs-2">
                                <h2 class="invoice-title uppercase">Total</h2>
                                <p class="invoice-desc grand-total"><?php echo $currency; ?> <?php $totgst = $total * 0.06; echo number_format((float)$totgst+$total,2,'.',','); ?></p>
                            </div>

                            <?php } else { ?>
                                <div class="col-xs-2">
                                    <h2 class="invoice-title uppercase">Discount</h2>
                                    <p class="invoice-desc"><?php echo number_format((float)$value['discount'],2,'.',','); ?></p>
                                </div>

                                <div class="col-xs-2">
                                    <h2 class="invoice-title uppercase">After Discount</h2>
                                    <p class="invoice-desc"><?php $afterDis = $total - $value['discount']; echo number_format((float)$afterDis,2,'.',','); ?></p>
                                </div>


                                <div class="col-xs-2">
                                    <h2 class="invoice-title uppercase">GST (6%)</h2>
                                    <p class="invoice-desc">6 %</p>
                                </div>
                                <div class="col-xs-2">
                                    <h2 class="invoice-title uppercase">Total</h2>
                                    <p class="invoice-desc grand-total"><?php echo $currency; ?> <?php $totgst = $afterDis * 0.06; echo number_format((float)$totgst+$afterDis,2,'.',','); ?></p>
                                </div>



                            <?php } ?>
                            
                         <?php } ?>


                    </div>

                        <?php } ?>
      
                    <div class=row>
                        <div class="col-md-8">
                            <?php foreach ($model_quotation as $key => $value) { ?>
                                <h5>Leadtime : <?php echo $value['delivery']; ?></h5>
                                <h5>Validity : <?php echo $value['validity']; ?></h5>
                                <?php if ($value['tender_visible'] == "Yes") { ?>
                                <h5>Tender : <?php echo $value['tender']; ?></h5>
                                <?php } ?>
                            <?php }?>

                            </div>
                    </div>
                    <br>


                    <div class="row">
                            <div class="col-md-8">

                            <?php if ($tax == "ZRE") { ?>
                                <span>No cancellation is allowed once confimation has received . Min 30% restocking charges will be imposed for any change of order</span>
                                <?php } else { ?>
                                <span>Our Bank Details : OCBC Bank acc no : 1071029115 or Maybank acc no : 512567101068 Note : No cancellation is allowed once confimation has received . Min 30% restocking charges will be imposed for any change of order</span>
                            <?php } ?>



                                <br><br>
                            <?php foreach ($model_quotation as $key => $value) { ?>
                                <?php echo $value['remark']; ?>

                            <?php }?>
                            </div>

                    </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group form-md-checkboxes">
                        
                                    <div class="md-checkbox-inline">
                                        <div class="md-checkbox">
                                            <input type="checkbox" id="checkbox6" class="md-check" value="confirm">
                                            <label for="checkbox6">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Update Status Quotation ? </label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="changestatus">
                            <div class="col-xs-12">
                                <div class="">
                                    <?php $form = ActiveForm::begin([
                                        'action' => ['update_status_quote','id'=>$model->id],
                                        'method' => 'get',
                                    ]); ?>
                                    <div class="form-group">
                                        <input type="hidden" name="change" value="">
                                        <div id="joborder-problem">
                                            <label class="mt-radio">
                                                <input id="winquote" type="radio" name="tukarstatus" value="Win" tabindex="8" disabled="" required="">Win<span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input id="lostquote" type="radio" name="tukarstatus" value="Lost" tabindex="8" disabled="">Lost<span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input id="activequote" type="radio" name="tukarstatus" value="Active" tabindex="8" disabled="">Active<span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input id="requote" type="radio" name="tukarstatus" value="Requote" tabindex="8" disabled="">Requote<span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Sales Review</label>
                                        <?= $form->field($model, 'sales_review')->textarea(['rows' => 6,'disabled'=>'','id'=>'sales_review'])->label(false) ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary submitsalesreview" disabled>Save</button>
                                    <?php ActiveForm::end(); ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>


</div>
</div>