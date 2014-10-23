 
<div id="vmkoffice_content">

<h2 style="margin-left:55PX;">Contact Form</h2>

<form action="<?php echo base_url();?>index.php/user_controller/contact_submit"  method="post" id="validation" name="drop_list" onLoad="fillcountry();" accept-charset="utf-8" enctype="multipart/form-data" > 
<div class="vmkoffice_mainone_accounts">
             <div>
            <div class="vmkoffice_labels_account"><label>First Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account">
        
 <input type="text" name="fname" size="25" class="required" />
</div>
</div>

<div>
            <div class="vmkoffice_labels_account"><label>Last Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account">
            
 <input type="text" name="lname" size="25" class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Personal Contact No.&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="pcontact" size="25" class="required number" /></div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label style="font-size:13.1px;">Emergency Contact No.&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="econtact" size="25" class="required number" /></div>
</div>



<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Mail ID&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="email" size="25" class="required email" /></div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Photo ID&nbsp;<span style="color:red;">*</span>:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="file" class="required" name="files[]" size="25" multiple />
 </div>
 </div>

<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Address Line1&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<input type="text" name="address1" size="25" class="required" /></div>
            </div>



<div>
            <div class="vmkoffice_labels_account"><label>Address Line2&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<input type="text" name="address2" size="25"class="required" /></div>
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
<option selected="selected" value=""></option>
<option value="India">India</option>
<option value="Australia">Australia</option>
</select>
</div>
            </div>

<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>State&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<select id="state" name="state" class="required">
<option selected="selected" value=""></option>
</select>
</div>
            </div>

<div>
            <div class="vmkoffice_labels_account"><label>City&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
<select id="city" name="city" class="required">
<option selected="selected" value=""></option>
</select></div>
            </div>







<div>
            <div class="vmkoffice_labels_account"><label>Postcode&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account">
            
<input type="text" name="postcode" size="25" class="required" /></div>
            </div>





<div class="vmkoffice_accounts_button" style="padding-bottom:40px;">
<input type="submit" value="SAVE"  class="row">
<input type="reset" value="CANCEL"  class="row"  />
</div>
</div>
</form>
</div>
