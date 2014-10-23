	

<div id="vmkoffice_content">

<h2 style="margin-left:55PX;">Appointments Form</h2>

<form action="<?php echo base_url();?>index.php/user_controller/marketing2/marketing_appointments"  method="post" id="validation" > 
<div class="vmkoffice_mainone_accounts">
             <div>
            <div class="vmkoffice_labels_account"><label>Person name &nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account">
        
 <input type="text" name="pname" size="25" class="required" />
</div>
</div>

<div>
            <div class="vmkoffice_labels_account"><label>Organization name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account">
            
 <input type="text" name="oname" size="25" class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Date&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25" style="width:205px;" readonly="readonly"  />
<input type="text" id="datepicker" name="date" class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label style="font-size:13.1px;">Result of appointment&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account" style="margin-top:20px;"> 
<textarea cols="29" rows="3" type="text" name="rapp" size="25" class="required" style="height:80px;"></textarea></div>
</div>
<div  style="clear:both; position:relative; top:-48px;">
            <div class="vmkoffice_labels_account"><label>Time&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
             <input type="text" name="time" class="required" size="24" style="width:125px;" /> 
 <select name="time_in" style="width:100px;" class="required">
<option value=""></option>
<option value="A.M">A.M</option>
<option value="P.M">P.M</option>
</select>
            

</div>
</div>

<div class="vmkoffice_accounts_button" style="padding-bottom:40px; padding-top:0;">
<input type="submit" value="SAVE"  class="row">
<input type="reset" value="CANCEL"  class="row"  />
</div>
</div>
</form>
</div>
