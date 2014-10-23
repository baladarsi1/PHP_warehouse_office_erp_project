 <style>
 .add-on{ margin-top:20px;}
 </style>
 
<div id="vmkoffice_content">
<div id="submenu" class="submenu">
   <?php echo $submenu; ?>
 </div><h2 style="margin-left:55PX;">Work Updates Form</h2>

<form action="<?php echo base_url();?>index.php/employees/work_updates"  method="post" id="validation"> 
<div class="vmkoffice_mainone_accounts">
             


<div>
            <div class="vmkoffice_labels_account"><label>Project:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 

<select name="project">
<option selected="selected">----</option>
<?php foreach($projects as $info) { ?>
<option value="<?php echo $info['id'].'-'.$info['name']; ?>"><?php echo $info['id'].'-'.$info['name']; ?></option>
<?php } ?>
</select>
</div>
</div>

<div>
<div class="vmkoffice_labels_account"><label>Task Start Time:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
             <div class="datetimepicker">
             <div class="input-append date">
             
      <input name="task_start" class="required"  style="width:205px;"  data-format="MM/dd/yyyy HH:mm:ss PP"type="text"></input>
      <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
      </div>
    </div>
</div>
</div>
<div style="clear:both;">
<div class="vmkoffice_labels_account"><label>Task End Time:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
            <div class="datetimepicker">
             <div class="input-append date">
             
      <input name="task_end" class="required" style="width:205px;"   data-format="MM/dd/yyyy HH:mm:ss PP"type="text"></input>
      <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
      </div>
    </div>

</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Subject:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 

<input type="text" name="subject" class="required"  />
</div>
</div>
  

<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Description:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<textarea cols="29" rows="4" name="description" id="editor1" class="required" ></textarea>
</div>
</div>
<div style="padding-top:10px;clear:both;">
<div>
            <div class="vmkoffice_labels_account"><label>Remarks:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<textarea cols="29" rows="4" name="remarks" id="editor1" class="required" ></textarea>
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Status:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<textarea cols="29" rows="4" name="status" class="required" ></textarea>
</div>
</div>
</div>
<div class="vmkoffice_accounts_button">
<input type="submit" value="SAVE"  class="row" style="margin:0;">
<input type="reset" value="CANCEL"  class="row" style="margin:0;"  />
</div>
</div>
</form>
</div>
</div>

    <link href="<?php echo base_url(); ?>css/timepicker_css1.css" rel="stylesheet"  />
    <link rel="stylesheet" type="text/css" media="screen"
     href="<?php echo base_url(); ?>css/timepicker_css2.css" />
 
   
 <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>custom_js/timepicker_js1.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>custom_js/timepicker_js2.js"></script>
   
    <script type="text/javascript">
      $('.datetimepicker').datetimepicker({
        format: 'dd/MM/yyyy HH:mm:ss PP',
       language: 'en'
      });
    </script>
<style>
h4{ font-size:14px !important; color: #727272;
    text-align: center;}
	h2{   color: #469663;
    font-size: 23px; font-family:"Trebuchet MS",sans-serif,Arial;}
	label{ font-family:"Trebuchet MS",sans-serif,Arial;}
</style>