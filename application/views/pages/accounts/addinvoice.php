<script>
$(document).ready(function() {
 $(function() 
 {
  $( "#autocomplete" ).autocomplete({
   source: function(request, response) {
    $.ajax({ url: "<?php echo site_url('accounts/search_project_id'); ?>",
    data: { term: $("#autocomplete").val()},
    dataType: "json",
    type: "POST",
    success: function(data){
     response(data);
    }
   });
  },
  minLength: 1 
  });
 });
 $(function() 
 {
  $( "#autocomplete2" ).autocomplete({
   source: function(request, response) {
    $.ajax({ url: "<?php echo site_url('vmk/search_domain_name'); ?>",
    data: { term: $("#autocomplete2").val()},
    dataType: "json",
    type: "POST",
    success: function(data){
     response(data);
    }
   });
  },
  minLength: 1 
  });
 });
});
</script>
<div id="vmkoffice_content">

<h2 style=" margin-left:67px;">ADD INVOICES</h2>
 	<form id="validation" method="post" action="<?php echo base_url(); ?>index.php/accounts/add_invoice">
    <div class="vmkoffice_mainone_accounts">
             
					
            <div>
            <div class="vmkoffice_labels_account"><label>Invoice Title:</label></div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="invoice_title" class="required" /></div>
            </div>
            <div>
            <div class="vmkoffice_labels_account"><label>Invoice No:</label></div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="invoice_no"  class="required" /></div>
            </div>
      
        <div>
            <div class="vmkoffice_labels_account"><label>Domain Name:</label></div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="domain" class="required" id="autocomplete2" /></div>
            </div>
            
            <div>
            <div class="vmkoffice_labels_account"><label>projet ID:</label></div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="project_id" class="required" id="autocomplete"  /></div>
        

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
          
<input type="reset" value="CANCEL"  class="row" />
</div>
</div>
		</form>
   </div><!-- vmk content end-->
</div><!-- end above-->
