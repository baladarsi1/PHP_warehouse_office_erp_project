
<div id="vmkoffice_content">

<h2 style="margin-left:55PX;">NEW EVENT</h2>

<form action="<?php echo base_url();?>index.php/events/addevent"  method="post" id="validation"> 
<div class="vmkoffice_mainone_accounts">
             <div>
            <div class="vmkoffice_labels_account"><label>Event Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" name="event" size="25" class="required" />
</div>
</div>

<div>
            <div class="vmkoffice_labels_account"><label>Chair person&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" name="chair" size="25" class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Event Date&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25" style="width:205px;" readonly="readonly"  />
<input type="text" id="datepicker" name="start" class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Event Time&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
             <input type="text" name="start1" class="required" size="24" style="width:125px;" /> 
 <select name="etime_in" style="width:100px;" class="required">
<option value=""></option>
<option value="A.M">A.M</option>
<option value="P.M">P.M</option>
</select>
            

</div>
</div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Priority&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<select name="priority"  class="required">
<option value=""></option>
<option value="compulsory">Compulsory</option>
<option value="optional">Optional</option>
</select>
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Venue&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" name="venue" size="25" class="required" />
</div>
</div>
<div style="clear:both;">
             <div class="vmkoffice_labels_account"><label>Event Description&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<textarea cols="29" rows="4" name="event_desc" id="editor1" class="required" ></textarea>
</div>
</div>

<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Agenda&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account" id="text_error"> 
 <textarea cols="29" rows="4" name="com" style="margin-top:20px;" class="required" ></textarea>
 </div>
</div>

<div class="vmkoffice_accounts_button">
<input type="submit" value="SAVE"  class="row">
<input type="reset" value="CANCEL"  class="row"  />
</div>
</div>
</form>
</div>
</div>
