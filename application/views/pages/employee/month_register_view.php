   <style>.special_para p{
    line-height: 30px;
    margin: 0;
    max-width: 184px; overflow:hidden;
   }
   </style>     
<div id="content">
<div id="submenu" class="submenu">
   <?php echo $submenu; ?>
</div>

<div class="main_sub_1" style="clear:both;">
      <table border="1px" bordercolor="#469663" cellspacing="0" cellpadding="8" width="95%" id="expensestable" style="position:relative; top:45px;">
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
<?php foreach($roles as $item){ ?>
    
    <?php if($item['work_update']=='no') { ?>
    
    <tr>
    <td style="border:none;" colspan="10"><span style="font-size:16px;"><span><?php echo 'Session Start: '.$item['e_date'].' & '.$item['session_start']; ?></span><span style=" float:right;"><?php echo 'Session Start: '.$item['e_date'].' & '.$item['session_end']; ?></span></span></td>
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
    <td class="special_para"><?php echo $item['description'];?></td>
    <td><?php echo $item['remarks'];?></td>
    
    </tr>
    <?php }?>
<?php } ?>
</table>
<div style="min-height:60px;"></div>
</div>
</div>
</div>

