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
<h2>INCOME</h2>

<div class="vmkoffice_mainone_accounts" id="invoices_left">
<div>
        <div class="vmkoffice_labels_account"><label><b>S.NO</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $income_data[0]['sno']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>REF ID:</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $income_data[0]['ref_id']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>INCOME TYPE</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $income_data[0]['income_type']; ?></label>
        </div>
        </div>
        <div style="clear:both;"> 	 	
        <div class="vmkoffice_labels_account"><label><b>DATE</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $income_data[0]['date']; ?></label>
        </div>
        </div>

<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>AMOUNT</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $income_data[0]['total_amount'].$income_data[0]['amount_type']; ?></label>
        </div>
        </div>

</div>
</div>
<div style="clear:both; text-align:center; padding:20px;"><input type="button" id="print" class="row" value="Print income" /></div>
  </div>
  </div>