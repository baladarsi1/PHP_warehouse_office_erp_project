
<div style="clear:both;">
<h2>TRACK VIEW</h2></div>
<table border="1px" bordercolor="#fff" cellspacing="0" cellpadding="8" width="95%" id="expensestable">
<tr class="row">
  <th >TASK ID</th>
  
  <th >PROJECT NAME</th>
  <th >Task Assigned By</th>
  <th >Task Assigned To</th>
   <th >DATE</th>
    <th >ESTIMATED FINISHING Date</th>
    <th >ESTIMATED FINISHING TIME</th>
    <th >Urgency Of task</th>
  <th >COMMENTS</th>
   <th >STATUS</th>
    <th >Department</th>
  <th >TIME</th>
</tr>

<?php foreach($entry as $item):?>
    <tr>
     <?php if(($usertype == "Clients" )){ ?>
    <td><?php echo $item['task_id'];?></td>
    <?php } else
    {  ?>
   <td><a href="<?php echo base_url(); ?>index.php/projectsselect_controller/finished/<?php echo $item['task_id'];?>/<?php echo $item['project_name'];?>" class="mouse_over_new" ><?php echo $item['task_id'];?></a></td>
        
    <?php } ?>
   
    <td><?php echo $item['project_name'];?></td>
    
    <td><?php echo $item['project_assign_to'];?></td>
    <td><?php echo $item['project_shifted_to'];?></td>
    <td><?php echo $item['date'];?></td>
     <td><?php echo $item['estimated_finishing_date'];?></td>
    <td><?php echo $item['estimated_finishing_time'];?></td>
     <td><?php echo $item['urgency_of_task'];?></td>
    <td><?php echo $item['comments'];?></td>
     <td><?php echo $item['status'];?></td>
      <td><?php echo $item['department'];?></td>
    <td><?php echo $item['time'].' '.$item['time_in'];?></td>
    </tr>
	
   
    
<?php endforeach ?>

</table>
<div class="new_score"><button>Total Time</button>
<input type="text" value="<?php echo $total1.' hours'; ?>" readonly="readonly"   style=" width:80px;padding:2px 0px 2px 12px;" />
</div>
       
</div><!--end wrap-->
