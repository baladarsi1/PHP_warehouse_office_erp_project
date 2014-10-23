	
 
<div id="vmkoffice_content">

<h2 style="margin-left:55PX;">Travelling Form</h2>

<form action="<?php echo base_url();?>index.php/user_controller/marketing2/marketing_travelling"  method="post" id="validation" name="drop_list" onLoad="fillcountry();" accept-charset="utf-8" enctype="multipart/form-data" > 
<div class="vmkoffice_mainone_accounts">
<div>
            <div class="vmkoffice_labels_account"><label>Appointment No. &nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 

<input type="text" name="appno" value="<?php echo $id; ?>" class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>User Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 

<input type="text"  name="uname" value="<?php echo $user_name; ?>" class="required" />
</div>
</div>
             <div>
            <div class="vmkoffice_labels_account"><label>Starting Date&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25" style="width:205px;" readonly="readonly"  />
<input type="text" id="datepicker" name="sdate" class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Ending Date&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25" style="width:205px;" readonly="readonly"  />
<input type="text" id="datepicker1" name="edate" class="required" />
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
            <div class="vmkoffice_labels_account"><label style="font-size:13px;">Contact person number&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="pcontact" size="25" class="required number" /></div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label style="font-size:13.1px;">Starting place &nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="start" size="25" class="required" /></div>
</div>

<div>
            <div class="vmkoffice_labels_account"><label style="font-size:13.1px;">Destination&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="des" size="25" class="required" /></div>
</div>

<div>
            <div class="vmkoffice_labels_account"><label>Mode of transport (bus,auto,taxi,bike,train)&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="mode" size="25" class="required" /></div>
</div>


<div>
            <div class="vmkoffice_labels_account"><label>Expenses&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<input type="text" name="expen" size="25" class="required" /></div>
            </div>




<div class="vmkoffice_accounts_button" style="padding-bottom:40px;">
<input type="submit" value="SAVE"  class="row">
<input type="reset" value="CANCEL"  class="row"  />
</div>
</div>
</form>
</div>
