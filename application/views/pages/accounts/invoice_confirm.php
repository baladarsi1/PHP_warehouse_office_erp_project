<div id="vmkoffice_content">

<form method="post" action="<?php echo base_url(); ?>index.php/accounts/confirm_invoice" id="formtable">

<div class="vmkoffice_mainone_accounts">
             
		<div>
        <div class="vmkoffice_labels_account"><label><b>SNO:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="sno" value="<?php echo $invoice_data[0]['sno']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>INVOICE ID:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="invoice_id" value="<?php echo $invoice_data[0]['invoice_id']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>INVOICE TITLE:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="invoice_title" value="<?php echo $invoice_data[0]['invoice_title']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>INVOICE DESCRIPTION:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="invoice_desc" value="<?php echo $invoice_data[0]['invoice_desc']; ?>" />
</div>
        </div>

<div>
        <div class="vmkoffice_labels_account"><label><b>INVOICE DATE:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="invoice_date" value="<?php echo $invoice_data[0]['invoice_date']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>AMOUNT TYPE:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="amount_type" value="<?php echo $invoice_data[0]['amount_type']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>TOTAL AMOUNT:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="total_amount" value="<?php echo $invoice_data[0]['total_amount']; ?>" />
</div>
        </div>
<div>
        <div class="vmkoffice_labels_account"><label><b>PAID AMOUNT:</b></label> </div>
        <div class="vmkoffice_inputs_account"><input type="text" name="paid_amount"  />
        </div>
        </div>
<div class="vmkoffice_accounts_button">
          <input type="submit" value="Submit"  class="row"  />

</div>
</div>
</form>
</div>
</div>
