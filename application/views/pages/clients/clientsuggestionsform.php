<div id="vmkoffice_content">
<h2 style=" margin-left:67px;">CLIENT REGISTRATION FORM</h2>
<div id="form">
<form action="<?php echo base_url();?>index.php/client_controller/suggestions_form_submit" method="post" id="validation" name="drop_list" onLoad="fillcountry();">
<div class="vmkoffice_mainone_accounts">
            

<div>
            <div class="vmkoffice_labels_account"><label>First Name:</label></div>
            <div class="vmkoffice_inputs_account">
 <input type="text" name="fname" size="25" class="required"/></div>
            </div>


<div>
            <div class="vmkoffice_labels_account"><label>Last Name:</label></div>
            <div class="vmkoffice_inputs_account">
 <input type="text" name="lname" size="25"  class="required" /></div>
            </div>







<div>
            <div class="vmkoffice_labels_account"><label>Personal Contact No./Mobile Number&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<input type="text" name="mno" size="25" class="required number" maxlength="14" /></div>
            </div>

<div>
            <div class="vmkoffice_labels_account"><label style="font-size:13px;">Emergency Contact No.&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<input type="text" name="eno" size="25" class="required number" maxlength="14" /></div>
            </div>

<div  style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Email&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<input type="text" name="email" size="25" class="required email" /></div>
            </div>



<div>
            <div class="vmkoffice_labels_account"><label>Address Line1&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<input type="text"   name="address1"  class="required" /></div>
            </div>



<div>
            <div class="vmkoffice_labels_account"><label>Address Line2&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<input type="text"  name="address2" class="required" /></div>
            </div>
<div>
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
<option value="America">America</option>
</select>
</div>
            </div>

<div>
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
            <div class="vmkoffice_labels_account"><label>Main Domain&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<input type="text" name="maindomain" size="25" class="required"/></div>
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

<div class="vmkoffice_accounts_button" style="padding-bottom:15px;">
<input type="submit" value="Create Client Id"  class="row"  />
<input type="reset" value="Cancel"  class="row" />
</div>
</div>
</form>
</div>
</div>
</div><!--end wrap-->
