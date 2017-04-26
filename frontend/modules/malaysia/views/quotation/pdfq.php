<?php /*echo $model2->state_id;*/ ?>
<table>
<?php foreach ($company as $key => $value_company) { ?>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:30px;"><b><?php echo $value_company['company_name']; ?></b></span>
            <span style="font-size:12px;"><?php echo $value_company['registeration_no']; ?></span>,
            <span style="font-size:12px;">GST Registeration No. : <?php echo $value_company['gst_no']; ?></span>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><?php echo $value_company['address']; ?></span>,
        </td>
    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><b>TEL</b> : <?php echo $value_company['telephone_no1']; ?> / <?php echo $value_company['telephone_no2']; ?>   <b>FAX</b> : <?php echo $value_company['fax_no']; ?>   <b>EMAIL</b> : <?php echo $value_company['email']; ?> </span>
        </td>
    </tr>
<?php }?>
</table>
<br>
<table  style="width:100%;" border="0">
<?php foreach ($info as $key => $value_info) { ?>
    <tr >
        <td style="text-align: left;vertical-align: top; width: 65%;">
                <span style="font-size:20px;"><b><?php echo strtoupper($value_info['company']); ?></b></span>
        </td>
        <td style="text-align: right;">
            <span style="font-size:20px;"><b>Quotation</b></span>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><?php echo $value_info['addr']; ?> ,<?php echo $value_info['postcode']; ?> ,<?php echo $value_info['city']; ?> ,<?php echo strtoupper($value_info['state']); ?></span>
        </td>
        <td style="text-align: right;">
            <span style="font-size:14px;"><b>No .</b> : <?php echo $value_info['quotation_no']; ?><?php echo $value_info['revise']; ?></span>
        </td>

    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;">&nbsp;</span>
        </td>
        <td style="text-align: right;">
            <span style="font-size:14px;"><b>Term</b> : <?php echo $value_info['term']; ?></span>
        </td>

    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><b>Telephone No :</b> <?php echo $value_info['country_code_phone']; ?><?php echo $value_info['area_code_phone']; ?><?php echo $value_info['telephone_no']; ?> / <b>Fax No. :</b> <?php echo $value_info['country_code_fax']; ?><?php echo $value_info['area_code_fax']; ?><?php echo $value_info['fax_no']; ?></span>
        </td>

        <?php if (!empty($value_info['revise'])) { ?>
            <td style="text-align: right;">
                <span style="font-size:14px;"><b>Date</b> : <?php echo $value_info['date_revise']; ?></span>
            </td>
        <?php } else { ?>
            <td style="text-align: right;">
                <span style="font-size:14px;"><b>Date</b> : <?php echo $value_info['date']; ?></span>
            </td>
        <?php } ?>


        

    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><b>Email :</b> <?php echo $value_info['email']; ?></span>
        </td>
        <?php if (!empty($value_info['revise'])) { ?>
            <td style="text-align: right;">
                <span style="font-size:14px;"><b>Quoted By</b> : <?php echo strtoupper($value_info['reviseQuotation']); ?></span>
            </td>
        <?php } else { ?>
            <td style="text-align: right;">
                <span style="font-size:14px;"><b>Quoted By</b> : <?php echo strtoupper($value_info['quoted']); ?></span>
            </td>
        <?php } ?>

    </tr>
        <tr>
        <td></td>
        <td style="text-align: right;">
            <span style="font-size:14px;"><b>Sales Agent</b> : <?php echo $value_info['agent_quotation']; ?> - <?php echo $value_info['agent_phone']; ?></span>
        </td>

    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><b>Attn To</b> : <?php echo $value_info['attention']; ?> <b>Mobile No:</b> <?php echo $value_info['att_country_code_mobile']; ?><?php echo $value_info['att_area_code_mobile']; ?><?php echo $value_info['att_mobile_no']; ?></span>
        </td>
        <td style="text-align: right;">
            <span style="font-size:14px;"><?php echo $value_info['area']; ?></span>
        </td>

    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><b>Email :</b> <?php echo $value_info['att_email']; ?> </span>
        </td>
    </tr>
    <tr><td></td></tr>

    <?php if ($value_info['cc_customer'] == "") { ?>

    <?php } else { ?>
        <tr>
            <td style="text-align: left;vertical-align: top;">
                <span style="font-size:14px;"><b>Cc To</b> : <?php echo $value_info['cc_customer']; ?> <b>Mobile No:</b> <?php echo $value_info['cc_country_code_mobile']; ?><?php echo $value_info['cc_area_code_mobile']; ?><?php echo $value_info['cc_mobile_no']; ?></span>
            </td>
        </tr>
        <tr>
            <td style="text-align: left;vertical-align: top;">
                <span style="font-size:14px;"><b>Email :</b> <?php echo $value_info['cc_email']; ?></span>
            </td>
        </tr>
    <?php } ?>

    <?php $tax = $value_info['tax']; ?> 
    <?php $currency = $value_info['currency'];?>                             
                                
<?php }?>
</table>
<br>
<?php if ($tax == "ZRE") { ?>
<table style="width: 100%;">
    <tr bgcolor="#D4D4D4">
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">No</span></th>
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">Item</span></th>
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">Description</span></th>
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">Qty</span></th>
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">Unit Price</span></th>
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">Amount</span></th>
    </tr>
        <tr>
        <td></td>
        <td colspan="5">
            <span style="font-size:16px;"><b>Trade Portal For Test & Measurement Industry</b></span>
        </td>
    </tr>
    <tr><td></td></tr>
    <?php $total = 0; $i =0; foreach ($detail as $key => $value_detail) { $i++;?>

    <tr>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php echo $i; ?></span>
        </td>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php echo $value_detail['ITEM_NO'];?></span>
        </td>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php echo $value_detail['DESCRIPTION']; ?></span>
        </td>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php echo $value_detail['quantity']; ?> <?php echo $value_detail['unit_of_measure']; ?></span>
        </td>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php echo number_format((float)$value_detail['price'],2,'.',','); ?>
            </span>
        </td>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php $sum = $value_detail['quantity'] * $value_detail['price']; echo number_format((float)$sum,2,'.',','); $total += $sum; ?></span>
        </td>
    </tr>
    <?php } ?>

        <?php foreach ($info as $key => $value_info) { ?>
            <?php if ($value_info['discount'] == "" || $value_info['discount'] == 0) { ?>

            <?php } else { ?>
            <tr>
                <td colspan="4"></td>
                <td>Discount <?php $dis =  $value_info['discount']; ?></td>
                <td style="text-align: left;vertical-align: top;padding: 5px;">
                    <span style="font-size:14px;">(<b style="color: green;">
                    <?php $afterDis = $total - $dis; echo number_format((float)$value_info['discount'],2,'.',',');?></b> )</span>
                </td>
            </tr>

            <?php } ?>

        <?php }?>

    

</table>
<hr>
<table  style="width: 100%;">
<?php foreach ($info as $key => $value_info) { ?>
        <tr>
            <td style="text-align: left;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;">Leadtime : <?php echo $value_info['delivery']; ?></span>
            </td>
             <td style="text-align: left;vertical-align: top;padding: 5px;"></td>
             <td style="text-align: left;vertical-align: top;padding: 5px;"></td>
             
             <td style="text-align: right;vertical-align: top;padding: 5px;" bgcolor="#D4D4D4">
                <span style="font-size:14px;"><b>Total</b></span>
            </td>
            <td style="text-align: right;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;"><?php echo $currency; ?></span>
            </td>
             <td style="text-align: right;vertical-align: top;padding: 5px;">
             <?php if ($value_info['discount'] == "" || $value_info['discount'] == 0) { ?>
             <span style="font-size:14px;"><?php echo number_format((float)$total,2,'.',','); ?></span>
             <?php } else { ?>
             <span style="font-size:14px;"><?php echo number_format((float)$afterDis,2,'.',','); ?></span>
            <?php }?>
            </td>

        </tr>
        <tr>
            <td style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:14px;">Validity : <?php echo $value_info['validity']; ?></span></td>
        </tr>
        <?php if ($value_info['tender_visible'] == "Yes") { ?>
        <tr>
            <td style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:14px;">Tender : <?php echo $value_info['tender']; ?></span>
            </td>
        </tr>
        <?php } ?>

        
    <?php }?>
</table>

<br>
<?php if ($model2->state_id == 20 ) { ?>
    <span><strong>Price : EX - LESO WAREHOUSE, EXCLUDE TRAINING, INSTALLATION & COMMISIONING.</strong></span><br><br>
<?php } ?>

<span>Note : No cancellation is allowed once confimation has received . Min 30% restocking charges will be imposed for any change of order</span>

<?php } else { ?>

<table style="width: 100%;">
    <tr bgcolor="#D4D4D4">
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">No</span></th>
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">Item</span></th>
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">Description</span></th>
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">Qty</span></th>
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">Unit Price</span></th>
        <th style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:15px;">Amount</span></th>
    </tr>
        <tr>
        <td></td>
        <td colspan="5">
            <span style="font-size:16px;"><b>Trade Portal For Test & Measurement Industry</b></span>
        </td>
    </tr>
    <tr><td></td></tr>
    <?php $total = 0; $i =0; foreach ($detail as $key => $value_detail) { $i++;?>

    <tr>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php echo $i; ?></span>
        </td>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php echo $value_detail['ITEM_NO'];?></span>
        </td>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php echo $value_detail['DESCRIPTION']; ?></span>
        </td>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php echo $value_detail['quantity']; ?> <?php echo $value_detail['unit_of_measure']; ?></span>
        </td>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php echo number_format((float)$value_detail['price'],2,'.',','); ?>
            </span>
        </td>
        <td style="text-align: left;vertical-align: top;padding: 5px;">
            <span style="font-size:14px;"><?php $sum = $value_detail['quantity'] * $value_detail['price']; echo number_format((float)$sum,2,'.',','); $total += $sum; ?></span>
        </td>
    </tr>
    <?php } ?>
    <tr><td></td></tr>
        <?php foreach ($info as $key => $value_info) { ?>
            <?php if ($value_info['discount'] == "" || $value_info['discount'] == 0) { ?>


        <tr>
            <td colspan="4"></td>
            <td>GST @ 6 %</td>
            <td style="text-align: left;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;"><b style="color: red;"><?php echo number_format((float)$total * 0.06,2,'.',','); ?></b></span>
            </td>
        </tr>

            <?php } else { ?>
            <tr>
                <td colspan="4"></td>
                <td>Discount <?php $dis =  $value_info['discount']; ?></td>
                <td style="text-align: left;vertical-align: top;padding: 5px;">
                    <span style="font-size:14px;">(<b style="color: green;">
                    <?php $afterDis = $total - $dis; echo number_format((float)$value_info['discount'],2,'.',',');?></b> )</span>
                </td>
            </tr>

            <tr>
                <td colspan="4"></td>
                <td>GST @ 6 %</td>
                <td style="text-align: left;vertical-align: top;padding: 5px;">
                    <span style="font-size:14px;">( <b style="color: red;"><?php  echo $totgst = number_format((float)$afterDis * 0.06,2,'.',','); ?></b> )</span>
                </td>
            </tr>


            <?php } ?>

        <?php }?>
</table>
<hr>
<table  style="width: 100%;">
<?php foreach ($info as $key => $value_info) { ?>
        <tr>
            <td style="text-align: left;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;">Leadtime : <?php echo $value_info['delivery']; ?></span>
            </td>
             <td style="text-align: left;vertical-align: top;padding: 5px;"></td>
             <td style="text-align: left;vertical-align: top;padding: 5px;"></td>
             
             <td style="text-align: right;vertical-align: top;padding: 5px;" bgcolor="#D4D4D4">
                <span style="font-size:14px;"><b>Total</b></span>
            </td>
            <td style="text-align: right;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;">RM</span>
            </td>
             <td style="text-align: right;vertical-align: top;padding: 5px;">
             <?php if ($value_info['discount'] == "" || $value_info['discount'] == 0) { ?>
             <span style="font-size:14px;"><?php $totgst = $total * 0.06; echo number_format((float)$totgst+$total,2,'.',','); ?></span>
             <?php } else { ?>
             <span style="font-size:14px;"><?php $afterDisC = $total - $value_info['discount']; $afterGst =  $afterDisC * 0.06; 
                    echo number_format((float)$afterDisC+$afterGst,2,'.',','); ?></span>
            <?php }?>
            </td>

        </tr>
        <tr>
            <td style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:14px;">Validity : <?php echo $value_info['validity']; ?></span></td>
        </tr>
        <?php if ($value_info['tender_visible'] == "Yes") { ?>
        <tr>
            <td style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:14px;">Tender : <?php echo $value_info['tender']; ?></span>
            </td>
        </tr>
        <?php } ?>


    <?php }?>
</table>

<br>
<?php if ($model2->state_id == 20) { ?>
    <span><strong>Price : EX - LESO WAREHOUSE, EXCLUDE TRAINING, INSTALLATION & COMMISSIONING.</strong></span><br><br>
<?php } ?>
<span>Our Bank Details : OCBC Bank acc no : 1071029115 or Maybank acc no : 512567101068 </span>
<br>
<span>Note : No cancellation is allowed once confimation has received . Min 30% restocking charges will be imposed for any change of order</span>
<?php } ?>




<br><br>

<?php foreach ($info as $key => $value_info) { ?>
    <?php if (empty($value_info['remark'])) { ?>
        
    <?php } else { ?>
        <span style="font-size:14px;">Remark : <?php echo $value_info['remark']; ?></span>
    <?php } ?>
    
<?php }?>

<br><br>

<span>This is computer generated quotation , no signature is required</span>