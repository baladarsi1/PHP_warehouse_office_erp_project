
 <div id="vmkoffice_content">
 
<h2>INVESTMENT</h2>
<form id="validation" method="post" action="<?php echo base_url();?>index.php/accounts/new_investment"  enctype="multipart/form-data">

    <div class="vmkoffice_mainone_accounts">
<div >  
    <input type="hidden" name="invester" value="<?php echo $username; ?>" />
  
   
            <div class="vmkoffice_labels_account"><label>Total Amount:</label></div>
            <div class="vmkoffice_inputs_account" id="select_boxes_invoice"> <input type="text" name="amount" class="required number" />
            <select name="amount_type" class="required">
            <option value="">--Type--</option>
             <option value="$">Dallors</option>
            <option value="Rs">Rupees</option>
            </select>
            </div>
            </div>
  <div>
    <div class="vmkoffice_labels_account">   <label>Receipt image:</label></div>
     <div class="vmkoffice_inputs_account" id="error_repair" >  <input type="file" name="userfile" size="25" class="required" />    </div>
        </div>

      
	
       <div style="clear:both;">
      
        <div class="vmkoffice_labels_account">  <label>Description:</label></div>
        <div class="vmkoffice_inputs_account"> <textarea cols="29" rows="4" name="desc" id="editor1" class="required"></textarea></div>
     </div>      
     
			<div class="vmkoffice_accounts_button">
          <input type="submit" value="SAVE"  class="row">
<input type="reset" value="CANCEL"  class="row" />
</div>
</div>
</form>

</div><!-- vmk content end-->
</div><!-- end above-->

