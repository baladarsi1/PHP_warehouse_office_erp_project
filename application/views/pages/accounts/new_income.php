
  
   
   
<div id="vmkoffice_content">
<h2>ADD INCOME</h2>
	<form id="validation" method="post" action="<?php echo base_url(); ?>index.php/accounts/new_income">
    <div class="vmkoffice_mainone_accounts">
        	
        <div>
        <div class="vmkoffice_labels_account"> <label><b>INCOME TYPE:</b></label></div>
         <div class="vmkoffice_inputs_account"><input type="text" name="type" class="required" /></div>
         </div>
            
            <div>
            <div class="vmkoffice_labels_account"><label><b>CREATE:</b></label></div>
            <div class="vmkoffice_inputs_account"> <input type="text" readonly="readonly" class="vmkoffice_divsa1" />
              <input id="datepicker" name="created_date" class="vmkoffice_datepicker" class="required" />
            </div>
            </div>
            
     
        <div>
            <div class="vmkoffice_labels_account"><label><b>CLEAR:</b></label></div>
            <div class="vmkoffice_inputs_account"> <input type="text" readonly="readonly" class="vmkoffice_divsa1" />
           
              <input id="datepicker1" name="clear_date" class="vmkoffice_datepicker" class="required" />
            </div>
        </div>
                  
     <div>  
     <div class="vmkoffice_labels_account">   <label><b>Amount:</b></label></div>
     
      <div class="vmkoffice_inputs_account"> <input type="text" name="amount" class="required"/>
      </div>
      </div>
      <div>
       <div class="vmkoffice_labels_account">   <label><b>Amount Type:</b></label></div>
     <div class="vmkoffice_inputs_account">
     <input type="radio" name="type_currency" value="Dollers" /><label>Dollers</label>
       <input type="radio" name="type_currency" value="Rs."/><label>Indian Rupees</label>
     </div>
     </div>
            
			<div class="vmkoffice_accounts_button">
          <input type="submit" value="SAVE"  class="row">
<a href="#"><input type="button" value="CANCEL"  class="row" /></a>
</div>
</div>
		</form>
   </div><!-- vmk content end-->
</div><!-- end above-->
<script type="text/javascript">
       $(function() {
               $("#datepickera4").datepicker({ dateFormat: "yy-mm-dd" }).val()
			 
       });
   </script>
