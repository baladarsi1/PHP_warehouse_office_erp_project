 
<div id="vmkoffice_content">

<h2 style="margin-left:55PX;">Marketing Clients Form</h2>

<form action="<?php echo base_url(); ?>index.php/user_controller/marketing2/marketing_clients"  method="post" id="validation" name="drop_list" onLoad="fillcountry();" accept-charset="utf-8" enctype="multipart/form-data" > 
<div class="vmkoffice_mainone_accounts">
<div style="clear:both;"><h2>Organization details</h2></div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Organization Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="oname" size="25"/>
 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Organization Address&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="oaddress" size="25"/>
 </div>
 </div>
 <div style="clear:both;">
            <div class="vmkoffice_labels_account"><label style="font-size:13px;">Organization contact No&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="ocon" size="25"/>
 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Organization Email Id&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="oemail" size="25"/>
 </div>
 </div>
<div style="clear:both; padding-top:12px;"><h2>Person details</h2></div>

<div>
            <div class="vmkoffice_labels_account"><label>First Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="fname"  size="25"  />
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




<div>
            <div class="vmkoffice_labels_account"><label>Phone No.(mobile)&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required number" name="phone" size="25"/>
 </div>
 </div>

 
<div>
            <div class="vmkoffice_labels_account"><label>Email ID&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required email" name="emailid" size="25"/>
 </div>
 </div>

 
 <div style="clear:both; padding-top:12px;"><h2>Mediator details</h2></div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Mediator Organization Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="morg" size="25"/>
 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Mediator Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="mname" size="25"/>
 </div>
 </div>
 <div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Address&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="maddress" size="25"/>
 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Contact No&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="mcon" size="25"/>
 </div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Email Id&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" class="required" name="memail" size="25"/>
 </div>
 </div>

            
<div class="vmkoffice_accounts_button" style="padding-top:8px;">
<input type="submit" value="Submit"  class="row"  />
<input type="reset" value="Cancel"  class="row"  />
</div>
</div>
</form>
</div>
