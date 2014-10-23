<style>
h2{text-align:center; color:#469663;  font-size:27px;}
 .vmkoffice_mainone_accounts{padding-left:214px;}
   #invoices_left .vmkoffice_labels_account{ width:214px;}
   .vmkoffice_labels_account{ width:151px; float:left; margin-top:16px;}
   .vmkoffice_labels_account label,.vmkoffice_divs_account input{ line-height:30px;}
   #printable{ width:980px; margin:auto;}
  
</style>
<div id="vmkoffice_content">
<div id="printable">
<h2><?php echo $bill_data[0]['bill_title']; ?> BILL</h2>

<div class="vmkoffice_mainone_accounts" id="invoices_left">
<div>
        <div class="vmkoffice_labels_account"><label><b>S.NO</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['sno']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Bill ID</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['bill_id']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>BILL TITLE</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['bill_title']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>INVOICE NO</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['invoice_no']; ?></label>
        </div>
        </div>

<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>BILL TYPE</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['bill_type']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>BILL GENERATE DATE</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['bill_date']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>TOTAL AMOUNT</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['total_amount'].' '.$bill_data[0]['amount_type']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>BILL DESCREPTION</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['bill_desc']; ?></label>
        </div>
        </div>

</div>
</div>
<div style="clear:both; text-align:center; padding:20px;"><input type="button" id="print" class="row" value="Print Bill" /></div>
  </div>
  </div>