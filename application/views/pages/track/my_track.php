
<div id="content">
<table border="2px" bordercolor="#ddd" cellspacing="0" cellpadding="8" width="95%" id="expensestable"  class="using_positions">
<tr class="row">
  <th >PROJECT ID</th>
  <th >PROJECT NAME</th>
  <th >WHO ASSIGNED PROJECT</th>
<!--  <th >PROJECT SHIFTED TO</th>-->
   <th >DATE</th>
  <th >COMMENTS</th>
</tr>

<?php foreach ($entry as $item): ?>
    <tr>
    <td><?php echo $item['project_id'];?></td>
    <td><?php echo $item['project_name'];?></td>
    <td><?php echo $item['project_assign_to'];?></td>
<!--    <td><?php echo $item['project_shifted_to'];?></td>-->
    <td><?php echo $item['date'];?></td>
    <td><?php echo $item['comments'];?></td>
    </tr>
	
<?php endforeach ?>

</table>
</div></div>