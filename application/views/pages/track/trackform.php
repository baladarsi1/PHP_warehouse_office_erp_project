
<div id="content">

<h2 style="clear:both;">ASSIGN A TASK</h2>
<div id="form">
<form action="<?php echo base_url();?>index.php/projectsselect_controller/form_link" method="post" id="validation" accept-charset="utf-8" enctype="multipart/form-data">
<div class="vmkoffice_mainone_accounts" id="track">
<div>
            <div class="vmkoffice_labels_account"><label>Project ID:</label></div>
            <div class="vmkoffice_inputs_account"><input type="text" name="projid" size="25" readonly="readonly" value="<?php echo $projectid; ?>"/>
            </div>
</div>
<div>
         <div class="vmkoffice_labels_account"><label>Project Name:</label></div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" name="projname" size="25" readonly="readonly" value="<?php echo $projectname; ?>"/>
 </div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Task Assigned By:</label></div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" name="projat" size="25" readonly="readonly" value="<?php echo $username; ?>"/>
 </div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Task Assigned To:</label></div>
            <div class="vmkoffice_inputs_account"> 
 <select name="projsht" class="sel" class="required">

<?php foreach($emp as $item) { ?>
<option value="<?php echo $item['username']; ?>"><?php echo $item['username']; ?></option>
<?php } ?>
</select>
</div>
</div>

<div>
            <div class="vmkoffice_labels_account"><label>Date&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="currentdate" readonly="readonly" size="25" value="<?php echo date("Y-m-d") ?>"/>
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label style="font-size:13px;">Estimated Finishing Date&nbsp;:</label></div>
          <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25" readonly="readonly" style="width:204px;" />
<input type="text" id="datepicker" name="edate" class="required" />
</div>
</div> 
<div style="clear:both;">
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
         <div class="vmkoffice_labels_account"><label>Urgency Of Task:</label></div>
            <div class="vmkoffice_inputs_account"> 
<select name="utask">
<option value=""></option>
<option value="Level 1">Level 1</option>
<option value="Level 2">Level 2</option>
<option value="Level 3">Level 3</option>
</select>
 </div>
</div>
<div style="clear:both;">
    <div class="vmkoffice_labels_account">   <label>Task Name:</label></div>
     <div class="vmkoffice_inputs_account" >
       <input type="text" name="task_name" class="required" size="24" />    </div>
        </div>
<div>
    <div class="vmkoffice_labels_account">   <label>Files:</label></div>
     <div class="vmkoffice_inputs_account" id="error_repair" >
       <input type="file" name="files[]" class="required" size="24" multiple />    </div>
        </div>
<div style="padding-top:4px; clear:both;">
            <div class="vmkoffice_labels_account"><label>Comments&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account"> 
<textarea cols="29" rows="4" name="comments" id="editor1" class="required" ></textarea>
</div>
</div>


<input type="hidden" name="status" size="25"  />

<div class="vmkoffice_accounts_button">
 <input type="submit" value="SAVE" class="row" />
<input type="reset" value="CANCEL" class="row" />
</div>
</div>
</form></div>
</div>
</div><!--end wrap-->
