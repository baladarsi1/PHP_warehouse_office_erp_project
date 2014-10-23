
<div id="content">
<h2>MY TASKS</h2>
<table border="1px" bordercolor="#ddd " cellspacing="0" cellpadding="8" width="95%" id="expensestable"  >
<tr class="row">
  <th >PROJECT ID</th>
  <th >PROJECT NAME</th>
  <th >WHO ASSIGNED PROJECT</th>
<!--  <th >PROJECT SHIFTED TO</th>-->
   <th >DATE</th>
  <th >COMMENTS</th>
  <th >Status</th>
   <th >department</th>
  <th >time</th>
 
</tr>

<?php foreach ($entry as $item): ?>

<?php  $pro_id1 = str_replace("/","-",$item['project_id']);
       ?>
    <tr>
    <td><a class="mouse_over_new" href="<?php echo base_url(); ?>index.php/projectsselect_controller/project_form1/<?php echo $pro_id1; ?>"><?php echo $item['project_id'];?></a></td>
    <td><?php echo $item['project_name'];?></td>
    <td><?php echo $item['project_assign_to'];?></td>
<!--    <td><?php echo $item['project_shifted_to'];?></td>-->
    <td><?php echo $item['date'];?></td>
    <td><?php echo $item['comments'];?></td>
     <td><?php echo $item['status'];?></td>
      <td><?php echo $item['department'];?></td>
      <td><?php echo $item['time'].' '.$item['time_in'];?></td>
      
    </tr>
	
<?php endforeach ?>

</table>
</div></div>