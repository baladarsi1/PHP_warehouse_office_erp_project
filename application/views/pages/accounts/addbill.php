
<div id="vmkoffice_content">

<h2 style="margin-left:67px;">ADD BILL</h2>
 	<form method="post" action="<?php echo base_url(); ?>index.php/accounts/add_bill" id="validation">
    <div class="vmkoffice_mainone_accounts">
             <div>
            <div class="vmkoffice_labels_account"><label>Bill Title:</label></div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="bill_title"  class="required" /></div>
            </div>
           
            <div>
            <div class="vmkoffice_labels_account"><label>Bill Type:</label></div>
            <div class="vmkoffice_inputs_account" style="width:264px !important; min-height:55px;"> <input type="text" name="bill_type" class="required"  /></div>
            <div class="accounts_examples"><label>EX: </label><label>Current Bill,Phone Bill,Water Bill... etc</label><br />
            </div>
            
            </div>
        <div>
            <div class="vmkoffice_labels_account"><label>Invoice No:</label></div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="invoice_no"  class="required" /></div>
            </div>
        
             <div>
            <div class="vmkoffice_labels_account"><label>Total Amount:</label></div>
            <div class="vmkoffice_inputs_account" id="select_boxes_invoice"> <input type="text" name="total_amount" class="required number" />
            <select name="amount_type" class="required">
            <option value="">--Type--</option>
             <option value="$">Dallors</option>
            <option value="Rs">Rupees</option>
            </select>
            </div>
            </div>
   
     
        <div style="clear:both;">
        <div class="vmkoffice_labels_account">  <label>Description:</label></div>
        <div class="vmkoffice_inputs_account"> <textarea cols="29" rows="4" name="desc" id="editor1" class="required" ></textarea></div>
        </div>
     
			<div class="vmkoffice_accounts_button">
          <input type="submit" value="ADD"  class="row">
          
<input type="reset" value="CANCEL"  class="row" /></a>
</div>
</div>
		</form>
   </div><!-- vmk content end-->
</div><!-- end above-->
