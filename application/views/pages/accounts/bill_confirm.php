<div id="vmkoffice_content">

<form method="post" action="<?php echo base_url(); ?>index.php/accounts/confirm_bill" id="formtable">

<div class="vmkoffice_mainone_accounts">
             
		<div>
        <div class="vmkoffice_labels_account"><label><b>SNO:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="sno" value="<?php echo $bill_data[0]['sno']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>BILL ID:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="bill_id" value="<?php echo $bill_data[0]['bill_id']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>BILL TITLE:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="bill_title" value="<?php echo $bill_data[0]['bill_title']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>BILL DESCRIPTION:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="bill_desc" value="<?php echo $bill_data[0]['bill_desc']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>BILL TYPE:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="bill_type" value="<?php echo $bill_data[0]['bill_type']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>BILL DATE:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="bill_date" value="<?php echo $bill_data[0]['bill_date']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>AMOUNT TYPE:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="amount_type" value="<?php echo $bill_data[0]['amount_type']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>TOTAL AMOUNT:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="total_amount" value="<?php echo $bill_data[0]['total_amount']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>PAID AMOUNT:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="paid_amount" />
        </div>
        </div>
<div class="vmkoffice_accounts_button">
          <input type="submit" value="Submit"  class="row"  />

</div>
</div>
</form>
</div>
</div>
