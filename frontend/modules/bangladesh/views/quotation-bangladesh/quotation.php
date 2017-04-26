<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\all\Quotation */

$this->title = 'Generate Quotation No : ' .$model->quotation_no.''.$model->revise;
$this->params['breadcrumbs'][] = ['label' => 'Quotations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="portlet-body">
    <div class="full-height-content-body">
   

        <div class="invoice-content-2 ">
            <div class="row invoice-head">
                <div class="col-md-9 col-xs-6">
                   
                    <h2><b><?= $company->company_name; ?></b></h2>

                        
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
            <div class="row invoice-body">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="invoice-title uppercase">No</th>
                                <th class="invoice-title uppercase">Item</th>
                                <th class="invoice-title uppercase">Description</th>
                                <th class="invoice-title uppercase">Quantity</th>
                                <th class="invoice-title uppercase">Unit Price (BDT)</th>
                                <th class="invoice-title uppercase">Amount (BDT)</th>
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
                            <h2 class="invoice-title uppercase">Discount</h2>
                            <p class="invoice-desc"><?php echo number_format((float)$value['discount'],2,'.',','); ?></p>
                        </div>

                        <div class="col-xs-2">
                            <h2 class="invoice-title uppercase">After Discount</h2>
                            <p class="invoice-desc"><?php $afterDis = $total - $value['discount']; echo number_format((float)$afterDis,2,'.',','); ?></p>
                        </div>
                        <div class="col-xs-2">
                            <h2 class="invoice-title uppercase">Total</h2>
                            <p class="invoice-desc grand-total"><?php echo $currency; ?> <?php echo number_format((float)$afterDis,2,'.',','); ?></p>
                        </div>



                    <?php } ?>
                    
                 <?php } ?>


            </div>

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

        <span><strong>Warranty : </strong>Standard one (01) year against manufacturing defect unless otherwise stated below.</span><br>
        <span><strong>Payment : </strong>100% by bank draft or A/C payee cheque in favor of the Company.</span>
        <div class="row">
                <div class="col-md-12">

                <?php foreach ($model_quotation as $key => $value) { ?>
                    <?php echo $value['remark']; ?>

                <?php }?>
                <br>
                <!-- <span>Please don't hesitate to call us if any further query.<br>We are expecting your work order and your best co-operation<br><br>Thanks and best regards.</span> -->
                </div>

        </div>
        <br>
            <div class="row">
                <div class="col-xs-12">

                <?php if ($model->status == "Progress") { ?>
                    <?= Html::a('Add Item', ['quotation-bangladesh/stock','id'=>$id],['class'=>'btn btn-lg blue-chambray hidden-print uppercase']) ?>
                <?php } else { ?>
                    <?= Html::a('Edit Item',['quotation-bangladesh/revise','id'=>$id,'country_id'=>8],['class'=>'btn btn-lg blue-chambray hidden-print uppercase']) ?>
                <?php } ?>
                <?= Html::a('Edit Customer Info', ['quotation-bangladesh/update','id'=>$id],['class'=>'btn btn-lg blue-chambray hidden-print uppercase']) ?>

                <?= Html::a('History', ['quotation-bangladesh/info','id'=>$id],['class'=>'btn btn-lg blue-chambray hidden-print uppercase']) ?>

                <?php if ($model->status == "Progress") { ?>
                    <?= Html::a('Generate Quotation', ['quotation-bangladesh/generate','id'=>$id],['class'=>'btn btn-lg green-haze hidden-print uppercase print-btn']) ?>
                <?php } else { ?>
                    <?= Html::a('PRINT PDF', ['quotation-bangladesh/pdf','id'=>$id,'country_id'=>8],['target' => '_blank','class'=>'btn btn-lg green-haze hidden-print uppercase print-btn']) ?>
                <?php } ?>



              
                
                </div>
            </div>
        </div>


    </div>
</div>