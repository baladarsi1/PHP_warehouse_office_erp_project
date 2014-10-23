     <div id="content">

<div>
<h2>Public Holiday</h2>
</div><!--end title-->
<div>
<form action="<?php echo base_url() ?>index.php/employees/public_holiday_submit" method="post" id="validation">
<div class="vmkoffice_mainone_accounts">

 <div>
            <div class="vmkoffice_labels_account"><label>Public Holiday Name&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account"> 
            <input type="text" name="name" class="required" />
           </div>
 </div>
                    <div>
            <div class="vmkoffice_labels_account"><label>Start Date&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account">
            <input type="text"  size="25"  readonly="readonly" style="width:204px;" />
<input type="text" id="datepicker" name="date" class="required" />

 </div>
                    <div>
            <div class="vmkoffice_labels_account"><label>No. of Days&nbsp;:</label> </div>
            <div class="vmkoffice_inputs_account"> <input type="text" name="days" class="required" /></div>
 </div>
         	
 <div class="vmkoffice_accounts_button" style="padding-top:8px;">
                   
<input type="submit" class="row" value="SAVE" />
<input class="row" type="reset" value="CANCEL" /></div>
</div>
</form>
</div>
</div>
</div>
