     <div id="content">
 <div id="submenu" class="submenu">
   <?php echo $submenu; ?>
 </div>
<div>
<h2>APPLY LEAVE</h2>
</div><!--end title-->
<div>
<form action="<?php echo base_url() ?>index.php/employees/leaves_submit" method="post" id="validation">
<div class="vmkoffice_mainone_accounts">
<div>
            <div class="vmkoffice_labels_account"><label>Name&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="name" value="<?php echo $username; ?>" class="required" /></div>
 </div>
  <div>
            <div class="vmkoffice_labels_account"><label>VMK Id&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="vmk_id" value="<?php echo $entry[0]['user_id']; ?>" class="required" /></div>
 </div>
 <div>
            <div class="vmkoffice_labels_account"><label>Leave Type&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account"> 
             <select name="type"  class="required">
<option  value="">--choose--</option>
<option value="sick">Sick</option>
<option value="annual">Annual</option>
</select></div>
 </div>
                    <div>
            <div class="vmkoffice_labels_account"><label>From Date&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account">
            <input type="text"  size="25"  readonly="readonly" style="width:204px;" />
<input type="text" id="datepicker" name="from_date" class="required" />

 </div>
                   <div>
            <div class="vmkoffice_labels_account"><label>To Date&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account">
            <input type="text"  size="25"  readonly="readonly" style="width:204px;" />
<input type="text" id="datepicker1" name="to_date" class="required" />
</div>
 </div>
                    <div>
            <div class="vmkoffice_labels_account"><label>No. of leaves&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="leave" class="required" /></div>
 </div>
         		<div style="clear:both;	">
            <div class="vmkoffice_labels_account"><label>purpose&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account"> <textarea rows="3" cols="15" class="required" name="purpose" style="margin-top:20px;"></textarea></div>
 </div>
                    <div>
            <div class="vmkoffice_labels_account"><label>Contact Address&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account"> <textarea class="required" rows="3" cols="15" name="ava" style="margin-top:20px;"></textarea></div>
 </div>
                   
 <div  style="clear:both;">
            <div class="vmkoffice_labels_account"><label>contact no&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="con" class="required number"  /></div>
 </div>          
 <div class="vmkoffice_accounts_button" style="padding-top:8px;">
                   
<input type="submit" class="row" value="SAVE" />
<input class="row" type="reset" value="CANCEL" /></div>
</div>
</form>
</div>
</div>
</div>
