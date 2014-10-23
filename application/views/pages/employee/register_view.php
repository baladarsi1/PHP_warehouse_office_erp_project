<script>
$(document).ready(function() {
 $(function() 
 {
  $( "#autocomplete" ).autocomplete({
   source: function(request, response) {
    $.ajax({ url: "<?php echo site_url('employees/search_employee_id'); ?>",
    data: { term: $("#autocomplete").val()},
    dataType: "json",
    type: "POST",
    success: function(data){
     response(data);
    }
   });
  },
  minLength: 1 
  });
 });

});
</script>

<div id="form1">

<div style="width:448px; padding:10px; margin:auto;">
       <h2 style="margin-top:5px;">Register View</h2>
       <div style="text-align:center; color:red; padding-bottom:10px;"><?php echo $message; ?></div>
<form action="<?php echo base_url(); ?>index.php/employees/register_views" method="post" id="validation" >


      <div>
     <div class="vmkoffice_labels_account" style="width:116px;"><label>Employee ID:</label>
     </div>
     <div class="vmkoffice_inputs_account" style="width:172px; margin-top:17px;">
<input type="text" name="id"  size="29" id="autocomplete" class="required" />

</div>
</div>
 <div style="clear:both">
            <div class="vmkoffice_labels_account" style="width:116px; "><label>From&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account" style="margin-top:17px;"> 
<input type="text"  size="25" style="width:205px;" readonly="readonly"  />
<input type="text" id="datepicker" name="from" class="required" />
</div>
</div>
  <div style="clear:both">
            <div class="vmkoffice_labels_account" style="width:116px;"><label>To&nbsp;:</label>
            </div>
           <div class="vmkoffice_inputs_account" style="margin-top:17px;"> 
<input type="text"  size="25" style="width:205px;" readonly="readonly"  />
<input type="text" id="datepicker1" name="to" class="required" />
</div>
</div>
 <div class="vmkoffice_accounts_button" style="padding-bottom:20px; text-align:center;">
          <input type="submit" value="Submit"  class="row"></div>
</div>
</form>

<div class="main_sub_1">
<h2>Daily Register</h2>
      <table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="8" width="95%" id="expensestable">
<tr class="row">
<th>Emp Id</th>
<th>Emp Name</th>
   <th>Date & Time</th>
  <th>Project Id & Title</th>
  <th>Subject</th>
  <th>Status</th>
  <th >Task Strat Time</th>
  <th>Task End Time</th>
   <th>Description</th>
  <th>Remarks</th>
</tr>
<?php foreach($entry as $item){ ?>
    
    <?php if($item['work_update']=='no') { ?>
    
    <tr>
    <td style="border:none;" colspan="10"><span style="font-size:16px;"><span><?php echo $item['e_id']; ?></span><span style=" padding-left:30px;"><?php echo 'Session Start: '.$item['e_date'].' & '.$item['session_start']; ?></span><span style=" float:right;"><?php echo 'Session Start: '.$item['e_date'].' & '.$item['session_end']; ?></span></span></td>
    </tr>
   <?php }?>
    <?php if($item['work_update']=='yes') { ?>
    <tr>
    <td><?php echo $item['e_id'];?></td>
    <td><?php echo $item['e_name'];?></td>
    <td><?php echo $item['e_date'];?></td>
    <td><?php echo $item['project_info'];?></td>
    <td><?php echo $item['subject'];?></td>
    <td><?php echo $item['status'];?></td>
    <td><?php echo $item['task_start'];?></td>
    <td><?php echo $item['task_end'];?></td>
    <td><?php echo $item['description'];?></td>
    <td><?php echo $item['remarks'];?></td>
    
    </tr>
    <?php }?>
<?php } ?>
</table>
<div style="min-height:60px;"></div>
</div>
</div>