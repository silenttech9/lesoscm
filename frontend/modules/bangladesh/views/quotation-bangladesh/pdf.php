<table>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:30px;"><b><?= $company->company_name; ?></b></span>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><?= $company->address; ?></span>,
        </td>
    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><b>TEL</b> : <?= $company->telephone_no1; ?> / <?= $company->telephone_no2; ?>   <b>FAX</b> : <?= $company->fax_no; ?>   <b>EMAIL</b> : <?= $company->email; ?> </span>
        </td>
    </tr>
</table>
<br>
<table  style="width:100%;" border="0">
<?php foreach ($model_quotation as $key => $value) { ?>
    <tr >
        <td style="text-align: left;vertical-align: top; width: 65%;">
                <span style="font-size:20px;"><b><?php echo strtoupper($value['company']); ?></b></span>
        </td>
        <td style="text-align: right;">
            <span style="font-size:20px;"><b>Quotation</b></span>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><?php echo $value['addr']; ?> ,<?php echo $value['postcode']; ?> ,<?php echo $value['city']; ?> ,<?php echo strtoupper($value['state']); ?></span>
        </td>
        <td style="text-align: right;">
            <span style="font-size:14px;"><b>No .</b> : <?php echo $value['quotation_no']; ?><?php echo $value['revise']; ?></span>
        </td>

    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;">&nbsp;</span>
        </td>
        <td style="text-align: right;">
            <span style="font-size:14px;"><b>Term</b> : <?php echo $value['term']; ?></span>
        </td>

    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><b>Telephone No :</b> <?php echo $value['country_code_phone']; ?><?php echo $value['area_code_phone']; ?><?php echo $value['telephone_no']; ?> / <b>Fax No. :</b> <?php echo $value['country_code_fax']; ?><?php echo $value['area_code_fax']; ?><?php echo $value['fax_no']; ?></span>
        </td>

        <?php if (!empty($value['revise'])) { ?>
            <td style="text-align: right;">
                <span style="font-size:14px;"><b>Date</b> : <?php echo $value['date_revise']; ?></span>
            </td>
        <?php } else { ?>
            <td style="text-align: right;">
                <span style="font-size:14px;"><b>Date</b> : <?php echo $value['date']; ?></span>
            </td>
        <?php } ?>

    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><b>Email :</b> <?php echo $value['email']; ?></span>
        </td>

        <?php if (!empty($value['revise'])) { ?>
            <td style="text-align: right;">
                <span style="font-size:14px;"><b>Quoted By</b> : <?php echo strtoupper($value['reviseQuotation']); ?></span>
            </td>
        <?php } else { ?>
            <td style="text-align: right;">
                <span style="font-size:14px;"><b>Quoted By</b> : <?php echo strtoupper($value['quoted']); ?></span>
            </td>
        <?php } ?>


    </tr>
    <tr>
        <td></td>
        <td style="text-align: right;">
            <span style="font-size:14px;"><b>Sales Agent</b> : <?php echo $value['agent_quotation']; ?> - <?php echo $value['agent_phone']; ?></span>
        </td>

    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><b>Attn To</b> : <?php echo $value['attention']; ?> <b>Mobile No:</b> <?php echo $value['att_country_code_mobile']; ?><?php echo $value['att_area_code_mobile']; ?><?php echo $value['att_mobile_no']; ?></span>
        </td>
        <td style="text-align: right;">
            <span style="font-size:14px;"><?php echo $value['area']; ?></span>
        </td>

    </tr>
    <tr>
        <td style="text-align: left;vertical-align: top;">
            <span style="font-size:14px;"><b>Email :</b> <?php echo $value['att_email']; ?> </span>
        </td>
    </tr>
    <tr><td></td></tr>

    <?php if ($value['cc_customer'] == "") { ?>

    <?php } else { ?>
        <tr>
            <td style="text-align: left;vertical-align: top;">
                <span style="font-size:14px;"><b>Cc To</b> : <?php echo $value['cc_customer']; ?> <b>Mobile No:</b> <?php echo $value['cc_country_code_mobile']; ?><?php echo $value['cc_area_code_mobile']; ?><?php echo $value['cc_mobile_no']; ?></span>
            </td>
        </tr>
        <tr>
            <td style="text-align: left;vertical-align: top;">
                <span style="font-size:14px;"><b>Email :</b> <?php echo $value['cc_email']; ?></span>
            </td>
        </tr>
    <?php } ?>

    <?php $tax = $value['tax']; ?>
    <?php $currency = $value['currency'];?>

<?php }?>
</table>
<br>




    <table style="width: 100%;" >
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
        <?php $total = 0; $i =0; foreach ($model_stock as $key => $value) { $i++;?>

        <tr>

            <td style="text-align: left;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;"><?php echo $i; ?></span>
            </td>

            <td style="text-align: left;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;"><?php  echo $value['ITEM_NO']; ?></span>
            </td>
            <td style="text-align: left;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;"><?php echo $value['DESCRIPTION']; ?></span>
            </td>
            <td style="text-align: left;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;"><?php echo $value['quantity']; ?> <?php echo $value['unit_of_measure']; ?></span>
            </td>
            <td style="text-align: left;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;"><?php echo number_format((float)$value['price'],2,'.',','); ?></span>
            </td>
            <td style="text-align: left;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;"><?php $sum = $value['quantity'] * $value['price']; echo number_format((float)$sum,2,'.',','); $total += $sum; ?></span>
            </td>
        </tr>
        <?php } ?>
        <tr><td></td></tr>

        <?php foreach ($model_quotation as $key => $value) { ?>
            <?php if ($value['discount'] == "" || $value['discount'] == 0) { ?>


            <?php } else { ?>
            <tr>
                <td colspan="4"></td>
                <td>Discount <?php $dis = $value['discount']; ?></td>
                <td style="text-align: left;vertical-align: top;padding: 5px;">
                    <span style="font-size:14px;">(<b style="color: green;">
                    <?php $afterDis = $total - $dis; echo number_format((float)$value['discount'],2,'.',',');?></b> )</span>
                </td>
            </tr>

            


            <?php } ?>

        <?php }?>

    </table>

<hr>
<table  style="width: 100%;">
<?php foreach ($model_quotation as $key => $value) { ?>
        <tr>
            <td style="text-align: left;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;">Leadtime : <?php echo $value['delivery']; ?></span>
            </td>
             <td style="text-align: left;vertical-align: top;padding: 5px;"></td>
             <td style="text-align: left;vertical-align: top;padding: 5px;"></td>

             <td style="text-align: right;vertical-align: top;padding: 5px;" bgcolor="#D4D4D4">
                <span style="font-size:14px;"><b>Total</b></span>
            </td>
            <td style="text-align: right;vertical-align: top;padding: 5px;">
                <span style="font-size:14px;">BDT</span>
            </td>
            <td style="text-align: right;vertical-align: top;padding: 5px;">

                 <?php if ($value['discount'] == "" || $value['discount'] == 0) { ?>
                    <span style="font-size:14px;"><?php echo number_format((float)$total,2,'.',','); ?></span>
                 <?php } else { ?>
                 <span style="font-size:14px;"><?php $afterDisC = $total - $value['discount'];
                    echo number_format((float)$afterDisC,2,'.',','); ?></span>
                <?php }?>

            </td>

        </tr>
        <tr>
            <td style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:14px;">Validity : <?php echo $value['validity']; ?></span>
            </td>
        </tr>
        <?php if ($value['tender_visible'] == "Yes") { ?>
        <tr>
            <td style="text-align: left;vertical-align: top;padding: 5px;"><span style="font-size:14px;">Tender : <?php echo $value['tender']; ?></span>
            </td>
        </tr>
        <?php } ?>
    <?php }?>
</table>

<br>

<span><strong>Warranty : </strong>Standard one (01) year against manufacturing defect unless otherwise stated below.</span><br>
<span><strong>Payment : </strong>100% by bank draft or A/C payee cheque in favor of the Company.</span>
<br><br>
<?php foreach ($model_quotation as $key => $value) { ?>
    <?php if (empty($value['remark'])) { ?>

    <?php } else { ?>
        <span style="font-size:14px;">Remark : <?php echo $value['remark']; ?></span>
    <?php } ?>

<?php }?>
<br>
<span>Please don't hesitate to call us if any further query.<br><br>We are expecting your work order and your best co-operation<br><br>Thanks and best regards.</span>
<br><br>

<span><i>This is computer generated quotation , no signature is required</i></span>


<?php  ['{PAGENO}']?>
