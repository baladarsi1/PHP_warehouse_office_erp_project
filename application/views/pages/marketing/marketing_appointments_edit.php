<div id="vmkoffice_content">
<h2 style="margin-left:55PX;">Appointments Form</h2>

<form action="<?php echo base_url();?>index.php/user_controller/marketing_appointments_update/<?php echo $sno; ?>"  method="post" id="validation" > 
<div class="vmkoffice_mainone_accounts">
             <div>
            <div class="vmkoffice_labels_account"><label>Person name &nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account">
        
 <input type="text" name="pname" size="25" value="<?php echo $edit[0]['person_name']; ?>" class="required" />
</div>
</div>  	
<div>
            <div class="vmkoffice_labels_account"><label>Organization name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account">
            
 <input type="text"  value="<?php echo $edit[0]['organization_name']; ?>"	 name="oname" size="25" class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Date&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25" style="width:205px;" readonly="readonly"  />
<input type="text" id="datepicker" value="<?php echo $edit[0]['date']; ?>" name="date" class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Time&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
             <input type="text" name="time" value="<?php echo $edit[0]['time']; ?>" class="required" size="24"  /> 
    

</div>
</div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label style="font-size:13.1px;">Result of appointment&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="rapp" value="<?php echo $edit[0]['result_of_appointment']; ?>" size="25" class="required" /></div>
</div>
<div class="vmkoffice_accounts_button" style="padding-bottom:40px;">
<input type="submit" value="SAVE"  class="row">
<input type="reset" value="CANCEL"  class="row"  />
</div>
</div>
</form>
</div>
