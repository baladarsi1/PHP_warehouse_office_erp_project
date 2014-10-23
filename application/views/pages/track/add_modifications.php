
<div id="vmkoffice_content">

<h2 style="clear:both;">MODIFICATIONS</h2>

 	<form id="validation" method="post" action="<?php echo base_url(); ?>index.php/projectsselect_controller/add_modifications_submit" accept-charset="utf-8" enctype="multipart/form-data">
    <div class="vmkoffice_mainone_accounts" id="track">
     <div >  
     <div class="vmkoffice_labels_account">   <label>Project ID:</label> </div>
     <div class="vmkoffice_inputs_account"> <input name="project_id" type="text" value="<?php echo $project_id; ?>" readonly="readonly" /></div>
     </div>
     <div >  
     <div class="vmkoffice_labels_account">   <label>Project Name:</label> </div>
     <div class="vmkoffice_inputs_account"> <input name="project_name" type="text" value="<?php echo $project_name; ?>" readonly="readonly" /></div>
     </div>
     <div >  
     <div class="vmkoffice_labels_account">   <label>Client Name:</label> </div>
     <div class="vmkoffice_inputs_account"> <input name="client_name" type="text" value="<?php echo $username; ?>" readonly="readonly" /></div>
     </div>
     <div>
    <div class="vmkoffice_labels_account">   <label>Modification Name:</label></div>
     <div class="vmkoffice_inputs_account" >
       <input type="text" name="mod_name" class="required" size="24" />    </div>
        </div> 
<div >  
     <div class="vmkoffice_labels_account">   <label>Current Date:</label> </div>
     <div class="vmkoffice_inputs_account"> <input name="date" type="text" value="<?php echo date('Y-m-d'); ?> " readonly="readonly" /></div>
     </div>
    

      <div>
            <div class="vmkoffice_labels_account"><label style="font-size:13px;">Estimated Finishing Date&nbsp;:</label></div>
          <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25" readonly="readonly" style="width:204px;" />
<input type="text" id="datepicker" name="edate" class="required" />
</div>
</div> 
<div>
            <div class="vmkoffice_labels_account"><label style="font-size:13px;">Estimated Finishing Time&nbsp;:</label></div>
          <div class="vmkoffice_inputs_account"> 
          <input type="text" name="etime" class="required" size="24" style="width:125px;" /> 
 <select name="etime_in" style="width:100px;" class="required">
<option value=""></option>
<option value="Minutes">Minutes</option>
<option value="Hours">Hours</option>
</select>
</div>
</div>
<div>
         <div class="vmkoffice_labels_account"><label>Urgency of Modification:</label></div>
            <div class="vmkoffice_inputs_account"> 
<select name="umod">
<option value=""></option>
<option value="Level 1">Level 1</option>
<option value="Level 2">Level 2</option>
<option value="Level 3">Level 3</option>
</select>
 </div>
</div>
 <div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Estimated Cost Of The Modification&nbsp;:</label></div>
          <div class="vmkoffice_inputs_account"> 
<input type="text" name="Ecost" class="required" size="24" /> 
</div>
</div>

<div >
    <div class="vmkoffice_labels_account">   <label>Files:</label></div>
     <div class="vmkoffice_inputs_account" id="error_repair" >
       <input type="file" name="files[]" size="24" class="required" multiple />     </div>
        </div>
       
<div style="clear:both;" >  
     <div class="vmkoffice_labels_account">   <label>Modification Description:</label></div>
      <div class="vmkoffice_inputs_account"><textarea cols="29" rows="4" name="mod_desc" id="editor1"></textarea></div>
      </div>

            
			<div class="vmkoffice_accounts_button">
          <input type="submit" value="SAVE"  class="row">
<input type="reset" value="CANCEL"  class="row" />
</div>
</div>
		</form>

 </div><!-- vmk content end-->
</div><!-- end above-->
