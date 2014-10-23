
<div id="vmkoffice_content">

<h2 style="margin-left:55PX;">Job Roles</h2>

<form action="<?php echo base_url();?>index.php/user_controller/roles_submit"  method="post" id="validation"> 
<div class="vmkoffice_mainone_accounts">
             


<div>
            <div class="vmkoffice_labels_account"><label>Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 

<input type="text" name="name" class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Position&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 

<input type="text" name="position" class="required"  />
</div>
</div>
  <div>
<div class="vmkoffice_labels_account"><label>Date Of Joining&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25" style="width:205px;" readonly="readonly" />
<input type="text"  id="datepicker" name="date" class="required"  />
</div>
</div>

<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Work Assigned&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<textarea cols="29" rows="4" name="work_assigned" id="editor1" class="required" ></textarea>
</div>
</div>
<div class="vmkoffice_accounts_button">
<input type="submit" value="SAVE"  class="row">
<a href="<?php echo base_url(); ?>index.php/new_event"><input type="button" value="CANCEL"  class="row"  /></a>
</div>
</div>
</form>
</div>
</div>
