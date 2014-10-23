
<div id="content">
<div id="title">
<div id="submenu">
<?php echo $submenu1; ?>
</div><!--end submenu-->
<h2>EDIT <?php echo $name; ?> DETAILS</h2>
</div><!--end title-->
<div id="form">
<form action="<?php echo base_url(""); ?>index.php/employees/edit_submit" method="post" id="validation"  accept-charset="utf-8" enctype="multipart/form-data" name="drop_list" onLoad="fillcountry();" />
<div class="vmkoffice_mainone_accounts">
<div style="clear:both;"><h2>Profile</h2></div>
<div>
            <div class="vmkoffice_labels_account"><label>First Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="fname" value="<?php echo $entry[0]['First_name']; ?>"  size="25" value="<?php echo $entry[0]['First_name']; ?>"   />
 </div>
 </div>

<div>
            <div class="vmkoffice_labels_account"><label>Last Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="lname" size="25" value="<?php echo $entry[0]['Last_name']; ?>" />
 </div>
 </div>
 
<div  style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Address Line1&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="address1" size="25" value="<?php echo $entry[0]['Address1']; ?>"  class="required" />

 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Address Line2&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" name="address2" size="25" value="<?php echo $entry[0]['Address2']; ?>"  class="required" />

 </div>
 </div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Suburban&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<input type="text" name="sub" size="25" value="<?php echo $entry[0]['suburban']; ?>"  class="required" /></div>
            </div>

<div>
            <div class="vmkoffice_labels_account"><label>Country&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
            <select name="country" class="required" onChange="Selectstate();">
            <option selected="selected"  value="<?php echo $entry[0]['country']; ?>"><?php echo $entry[0]['country']; ?></option>
<option  value="">--select--</option>
<option value="India">India</option>
<option value="Australia">Australia</option>
</select>
</div>
            </div>

<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>State&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<select id="state" name="state" class="required">
   <option selected="selected"  value="<?php echo $entry[0]['state']; ?>"><?php echo $entry[0]['state']; ?></option>
<option  value="">--select--</option>
</select>
</div>
            </div>

<div>
            <div class="vmkoffice_labels_account"><label>City&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<select id="city" name="city" class="required">
   <option selected="selected"  value="<?php echo $entry[0]['city']; ?>"><?php echo $entry[0]['city']; ?></option>

<option value="">--select--</option>
</select></div>
            </div>




<div>
            <div class="vmkoffice_labels_account"><label>Postcode&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
            
<input type="text" name="postcode" size="25" value="<?php echo $entry[0]['postcode']; ?>"  class="required" /></div>
            </div>
<div>
            <div class="vmkoffice_labels_account"><label>Designation&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="desig" size="25" value="<?php echo $entry[0]['Designation']; ?>" />
 </div>
 </div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Work Assigned&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="work" size="25" value="<?php echo $entry[0]['work_assigned']; ?>" />
 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Employee Position&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account">
            <select name="employee_position" class="required" >
<option value="<?php echo $entry[0]['employee_position']; ?>"><?php echo $entry[0]['employee_position']; ?></option>
<option value="Managing_Director">Managing Director</option>
<option value="General_Manager">General Manager</option>
<option value="Administrator">Administrator</option>
<option value="VMK_Employee">VMK Employee</option>

</select>

 </div>
 </div>
 
<div style="clear:both; padding-top:12px;"><h2>Emergency contact</h2></div>
<div>
            <div class="vmkoffice_labels_account"><label>Employee ID&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="id" size="25" value="<?php echo $entry[0]['Employee_id']; ?>" />
 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Date of Joining&nbsp;:</label>
            </div>
          
            <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25"    readonly="readonly" style="width:204px;" />
<input type="text" id="datepicker" value="<?php echo $entry[0]['Date_of_joining']; ?>" name="doj"class="required" />

 </div>
 </div>


 <div>
            <div class="vmkoffice_labels_account"><label>Date of Reliving&nbsp;:</label>
            </div>
          
            <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25"    readonly="readonly" style="width:204px;" />
<input type="text" id="datepicker1"  name="dor"class="required" />

 </div>
 </div>



<div>
            <div class="vmkoffice_labels_account"><label>Phone No.(mobile)&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required number" name="phone" size="25" value="<?php echo $entry[0]['Phone_no']; ?>" />
 </div>
 </div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label style="font-size:13px;">Emergency Contact No.&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required number" name="econ" size="25" value="<?php echo $entry[0]['emergency_no']; ?>" />
 </div>
 </div>
 
<div>
            <div class="vmkoffice_labels_account"><label>Email ID&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required email" name="emailid" size="25" value="<?php echo $entry[0]['Email_id']; ?>" />
 </div>
 </div>


<div  style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Resume&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="file" name="files[]" size="24"  multiple />
 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Photo ID&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="file" name="files[]" size="25" value="<?php echo $entry[0]['First_name']; ?>"  multiple />
 </div>
 </div>
 <div style="clear:both; padding-top:12px;"><h2>Financial</h2></div>
 <div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Bond Period&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account">
<input type="text" class="required" name="bond" size="25" value="<?php echo $entry[0]['Bond_period']; ?>"  />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Probation Period&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="probation" size="25" value="<?php echo $entry[0]['Probation']; ?>" />
 </div>
 </div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Salary Package&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="income" size="25" value="<?php echo $entry[0]['income_perannum']; ?>" />
 </div>
 </div>
<div>
            <div class="vmkoffice_labels_account"><label>Bank Account No.&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="acc" value="<?php echo $entry[0]['Bank_account']; ?>" size="24"/>
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
<div style="width:220px; float:left;"><span>Annual Leaves:&nbsp;</span><input  value="<?php echo $entry[0]['Annual_leaves']; ?>" type="text" class="required" name="al" size="5" style="width:95px;"  /></div>
<div style="width:210px; float:left;"><span>Sick Leaves:&nbsp;</span><input value="<?php echo $entry[0]['Sick_leaves']; ?>" type="text" class="required" name="sl" size="5" style="width:95px;" /></div>
<div style="width:236px; float:left;">
<span>Total Leaves Taken:&nbsp;</span><input   value="<?php echo $entry[0]['Total_leaves']; ?>" type="text" class="required" name="total" size="5" style="width:95px;" /></div>
          
</div>

            
<div class="vmkoffice_accounts_button" style="padding-top:8px;">
<input type="submit" value="Save"  class="row"  />
<input type="reset" value="Cancel"  class="row"  />
</div>


</form></div>
</div>
</div>

      