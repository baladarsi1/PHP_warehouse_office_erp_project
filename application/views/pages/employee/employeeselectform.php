<script>
$(document).ready(function() {
 $(function() 
 {
  $( "#autocomplete" ).autocomplete({
   source: function(request, response) {
    $.ajax({ url: "<?php echo site_url('employees/search_employee_id'); ?>",
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

});
</script>

<div id="form1">
<div id="submenu">

<?php echo $submenu1; ?>

</div><!--end submenu-->

<div style="width:448px; padding:10px; margin:auto;">
       <h2 style="margin-top:5px;">Employee Details</h2>
       <div style="text-align:center; color:red; padding-bottom:10px;"><?php echo $message; ?></div>
<form action="<?php echo base_url(); ?>index.php/employees/employee_details" method="post" id="validation" >


      <div>
     <div class="vmkoffice_labels_account" style="width:116px;"><label>Employee ID:</label>
     </div>
     <div class="vmkoffice_inputs_account" style="width:172px; margin-top:17px;">
<input type="text" name="id"  size="29" id="autocomplete" class="required" />

</div>
</div>
 
 <div class="vmkoffice_accounts_button" style="padding-bottom:20px; text-align:center;">
          <input type="submit" value="Submit"  class="row"></div>
</div>
</form>


</div>