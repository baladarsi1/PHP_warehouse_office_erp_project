<script>
$(document).ready(function() {
    $('#fname').blur(function() {
 
  var form_data = {
   fname: $(this).val()
  };
  //alert('heello');
  
  $.ajax({
  url: "<?php echo site_url('employees/username_check'); ?>",
  type: 'POST',
  dataType: 'text',
  data: form_data,
  success: function(msg) {
   if(msg=='FALSE')
   {
    	$("#fname_show").html('');
   }
   else
   {
    	$("#fname_show").html('* This Name Already Used');
   }
  }
 });
});
});
</script>

<div id="content">
<div id="title">
<div id="submenu">
<?php echo $submenu1; ?>
</div><!--end submenu-->
<h2>NEW EMPLOYEE DETAILS FORM</h2>
</div><!--end title-->
<div id="form">
<form action="<?php echo base_url(""); ?>index.php/employees/newemp_form" method="post" id="validation"   accept-charset="utf-8" enctype="multipart/form-data" name="drop_list" onLoad="fillcountry();" />
<div class="vmkoffice_mainone_accounts">
<div style="clear:both;"><h2>Profile</h2></div>
<div>
            <div class="vmkoffice_labels_account"><label>First Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="fname" id="fname" value="<?php echo set_value('fname'); ?>"   size="25"  /><span id="fname_show" style=" color:red; font-size:12px; margin-left:67px;"></span>
 </div>
 </div>

<div>
            <div class="vmkoffice_labels_account"><label>Last Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="lname" size="25"/>
 </div>
 </div>
 
<div  style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Address Line1&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="address1" size="25" class="required" />

 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Address Line2&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" name="address2" size="25" class="required" />

 </div>
 </div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Suburban&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<input type="text" name="sub" size="25" class="required" /></div>
            </div>

<div>
            <div class="vmkoffice_labels_account"><label>Country&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
            <select name="country" class="required" onChange="Selectstate();">
<option selected="selected" value="">--select--</option>
<option value="India">India</option>
<option value="Australia">Australia</option>
</select>
</div>
            </div>

<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>State&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<select id="state" name="state" class="required">
<option selected="selected" value="">--select--</option>
</select>
</div>
            </div>

<div>
            <div class="vmkoffice_labels_account"><label>City&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<select id="city" name="city" class="required">
<option selected="selected" value="">--select--</option>
</select></div>
            </div>




<div>
            <div class="vmkoffice_labels_account"><label>Postcode&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
            
<input type="text" name="postcode" size="25" class="required" /></div>
            </div>
<div>
            <div class="vmkoffice_labels_account"><label>Designation&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="desig" size="25"/>
 </div>
 </div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Work Assigned&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="work" size="25"/>
 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Employee Position&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
            <select name="employee_position" class="required" >
<option selected="selected" value="">--select--</option>
<option value="Managing_Director">Managing Director</option>
<option value="General_Manager">General Manager</option>
<option value="Administrator">Administrator</option>
<option value="VMK_Employee">VMK Employee</option>

</select>

 </div>
 </div>
<div style="clear:both; padding-top:12px;"><h2>Emergency contact</h2></div>
 <div>
            <div class="vmkoffice_labels_account"><label>Date of Joining&nbsp;:</label>
            </div>
          
            <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25"  readonly="readonly" style="width:204px;" />
<input type="text" id="datepicker" name="doj"class="required" />

 </div>
 </div>




<div>
            <div class="vmkoffice_labels_account"><label>Phone No.(mobile)&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required number" name="phone" size="25"/>
 </div>
 </div>
<div  style="clear:both;">
            <div class="vmkoffice_labels_account"><label style="font-size:13px;">Emergency Contact No.&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required number" name="econ" size="25"/>
 </div>
 </div>
 
<div>
            <div class="vmkoffice_labels_account"><label>Email ID&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required email" name="emailid" size="25"/>
 </div>
 </div>


<div   style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Resume&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="file" class="required" name="files[]" size="24"  multiple />
 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Photo ID&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="file" class="required" name="files[]" size="25" multiple />
 </div>
 </div>
 <div style="clear:both; padding-top:12px;"><h2>Financial</h2></div>
 <div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Bond Period&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account">
<input type="text" class="required" name="bond" size="25" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Probation Period&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="probation" size="25"/>
 </div>
 </div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Salary Package&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="income" size="25"/>
 </div>
 </div>
<div>
            <div class="vmkoffice_labels_account"><label>Bank Account No.&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="acc" size="24"/>
 </div>
 </div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account" style="width:278px;"><label>Proofs Submitted By Employee Joining&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account" id="proofs_new1"> 
<div style="width:102px; float:left;"><input type="checkbox" name="proofs[]" value="Voter ID"  /><span>Voter Id</span></div>
<div style="width:109px; float:left;"><input type="checkbox" name="proofs[]" value="Pancard" /><span> Pan Card</span></div>
<div style="width:149px; float:left;"><input type="checkbox" name="proofs[]" value="Driving Licence" /><span> Driving License</span></div>
<div style="width:129px; float:left;"><input type="checkbox" name="proofs[]" value="Rationcard" /> <span>Ration Card</span></div>
<div style="width:109px; float:left;"><input type="checkbox" name="proofs[]" value="Passport" /> <span>Passport</span></div>
</div>
</div>


<div style="clear:both; padding-top:12px;"><h2>Leaves</h2></div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account" style="width:178px; margin-top:20px;"><label>Leaves for the Employee&nbsp;:</label>
            
</div>
 <div class="vmkoffice_inputs_account" id="proofs_new" style="padding-left:8px;"> 
<div style="width:220px; float:left;"><span>Annual Leaves:&nbsp;</span><input type="text" class="required" name="al" size="5" style="width:95px;"  /></div>
<div style="width:210px; float:left;"><span>Sick Leaves:&nbsp;</span><input type="text" class="required" name="sl" size="5" style="width:95px;" /></div>
<div style="width:236px; float:left;">
<span>Total Leaves Taken:&nbsp;</span><input type="text" class="required" name="total" size="5" style="width:95px;" /></div>
          
</div>
<div id="proofs_newsp">
<div style="clear:both; padding-top:12px;"><h2>Permissions</h2></div>
<div style="width:180px; float:left;" >
<h2>home</h2>
<input type="checkbox" name="proofs1[]" value="entry"  /><span>Home</span><br />

<input type="checkbox" name="proofs1[]" value="vmk_staff"  /><span>VMK staff</span><br />
<input type="checkbox" name="proofs1[]" value="my_register"  /><span>MY register</span><br />
<input type="checkbox" name="proofs1[]" value="register_view"  /><span>Register View</span><br />
<input type="checkbox" name="proofs1[]" value="leaves_view"  /><span>Leaves View</span><br />
<input type="checkbox" name="proofs1[]" value="add_public_holiday"  /><span>Add Public Holiday</span><br />
<input type="checkbox" name="proofs1[]" value="my_details"  /><span>MY Details</span><br />
<input type="checkbox" name="proofs1[]" value="my_tasks"  /><span>MY tasks</span><br />

</div>
<div style="width:180px; float:left;">
<h2>Projects</h2>
<input type="checkbox" name="proofs2[]" value="entry"  /><span>Projects</span><br />
<input type="checkbox" name="proofs2[]" value="add_project"  /><span>Add A Project</span><br />
<input type="checkbox" name="proofs2[]" value="edit_project"  /><span>Edit A Project</span><br />



</div>
<div style="width:180px; float:left;">
<h2>Clients</h2>

<input type="checkbox" name="proofs3[]" value="client_details"  /><span> Client Details</span><br />
<input type="checkbox" name="proofs3[]" value="registration"  /><span>Registration</span><br />


</div>
<div style="width:180px; float:left;">
<h2>Tracking</h2>
<input type="checkbox" name="proofs4[]" value="entry"  /><span>Entry</span><br />
<input type="checkbox" name="proofs4[]" value="assign_task"  /><span>Assign a Task</span><br />
<input type="checkbox" name="proofs4[]" value="view_task"  /><span>View Task</span><br />
<input type="checkbox" name="proofs4[]" value="add_modifications"  /><span>Add Modifications</span><br />
<input type="checkbox" name="proofs4[]" value="view_modifications"  /><span>View Modifications</span><br />



</div>
<div style="width:180px; float:left;">
<h2>Accounts</h2>

<input type="checkbox" name="proofs5[]" value="accounts"  /><span>Accounts</span><br />



</div>
<div style="width:180px; float:left; clear:both;">
<h2>HR Department</h2>

<input type="checkbox" name="proofs6[]" value="hr_department"  /><span>HR Department</span><br />
</div>
<div style="width:180px; float:left;">
<h2>Marketing</h2>
<input type="checkbox" name="proofs7[]" value="marketing"  /><span>Marketing</span><br />
</div>
 <div style="width:180px; float:left;">
<h2>events</h2>
<input type="checkbox" name="proofs8[]" value="entry"  /><span>Events</span><br />
<input type="checkbox" name="proofs8[]" value="add_event"  /><span>Add A New Event
</span><br />
 
</div><div style="width:180px; float:left;">
<h2>contacts</h2>

<input type="checkbox" name="proofs9[]" value="contacts"  /><span>Contacts</span><br />


</div>




           
<div class="vmkoffice_accounts_button" style="padding-top:8px; padding-bottom:20px;">
<input type="submit" value="Create Employee ID"  class="row"  />
<input type="reset" value="Cancel"  class="row"  />
</div>
</div>

</form></div>
</div>
</div>

      