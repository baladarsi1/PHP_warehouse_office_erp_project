     <div id="content">
 <div id="submenu" class="submenu">
   <?php echo $submenu; ?>
 </div>
 
 <div id="vmkoffice_content">

<h2>Leave Sanction</h2>

<form method="post" action="<?php echo base_url(); ?>index.php/employees/leave_san_submit/<?php echo $entry[0]['sno']; ?>/<?php echo $entry[0]['leave_type']; ?>" id="validation" >
<div class="vmkoffice_mainone_accounts" id="invoices_left">
<div>
        <div class="vmkoffice_labels_account"><label><b>Sno</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $entry[0]['sno']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Name</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $entry[0]['name']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Leave Type</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $entry[0]['leave_type']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>From Date</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $entry[0]['from_date']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>To Date</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $entry[0]['to_date']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>No of Leaves</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $entry[0]['noof_leaves']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Contact Address</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $entry[0]['available_in_holidays_time']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Contact No</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $entry[0]['contact_no']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><h2 style="text-decoration:none;">Leave Sanction</h2></label> </div>
        <div class="vmkoffice_labels_account">
        <select name="san" style="width:100px;">
        <option value="">--Choose--</option>
        <option value="YES">YES</option>
        <option value="NO">NO</option>
        </select>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><h2 style="text-decoration:none;">Description</h2></label> </div>
        <div class="vmkoffice_labels_account">
       <textarea name="leave_des" style="height:100px;"></textarea>
        </div>
        </div>

<div class="vmkoffice_accounts_button" style="padding-left:100px; text-align:left;">
          <input type="submit" value="Submit"  class="row"  />

</div>
</div>

</form>

</div>
  </div>

</div>
