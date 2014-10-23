<script>
$(document).ready(function() {
 $(function() 
 {
  $( "#autocomplete" ).autocomplete({
   source: function(request, response) {
    $.ajax({ url: "<?php echo site_url('accounts/search_employee_name'); ?>",
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
    $.ajax({ url: "<?php echo site_url('employees/search_employee_id'); ?>",
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

<h2 style="margin-left:67px;">Wages</h2>
 	<form method="post" action="<?php echo base_url(); ?>index.php/accounts/wages_submit" id="validation">
    <div class="vmkoffice_mainone_accounts">
             <div>
            <div class="vmkoffice_labels_account"><label>Employee Name:</label></div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="name"  class="required" id="autocomplete" /></div>
            </div>
           
            <div>
            <div class="vmkoffice_labels_account"><label>Employee ID:</label></div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="id" class="required"  id="autocomplete2" /></div>
            
            </div>
        <div>
            <div class="vmkoffice_labels_account"><label>Salary Amount</label></div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="sal_amount"  class="required" /></div>
            </div>
        
     <div>
            <div class="vmkoffice_labels_account"><label>Starting Date</label></div>
            <div class="vmkoffice_inputs_account">
            <input type="text"  size="25" style="width:205px;" readonly="readonly"  />
<input type="text" id="datepicker" name="start" class="required" /></div>
            </div>
        <div>
            <div class="vmkoffice_labels_account"><label>Ending Date</label></div>
            <div class="vmkoffice_inputs_account"><input type="text"  size="25" style="width:205px;" readonly="readonly"  />
<input type="text" id="datepicker1" name="end" class="required" /></div>
            </div>
       
     
     
        <div style="clear:both;">
        <div class="vmkoffice_labels_account">  <label>Description:</label></div>
        <div class="vmkoffice_inputs_account"> <textarea cols="29" rows="4" name="desc" id="editor1" class="required" ></textarea></div>
        </div>
     
			<div class="vmkoffice_accounts_button">
          <input type="submit" value="ADD"  class="row">
          
<a href="<?php echo base_url(); ?>index.php/accounts/view/addbill"><input type="button" value="CANCEL"  class="row" /></a>
</div>
</div>
		</form>
   </div><!-- vmk content end-->
</div><!-- end above-->
