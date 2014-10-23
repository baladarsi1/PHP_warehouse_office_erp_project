<div id="vmkoffice_content">

<h2 style="clear:both;">VIEW MODIFICATIONS</h2>

<table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="0" width="95%" id="expensestable" 
class="expensestable1">

 <tr class="row"> 

 
  <th >PROJECT Name</th>
  <th >client Name</th>
  <th >MODIFICATION name</th>
  <th >DATE</th>
  <th >ESTIMATED FINISHING Date</th>
    <th >ESTIMATED FINISHING TIME</th>
    <th >Urgency Of Modification</th>
  <th >Estimated Cost Of Modification</th>
  <th >MODIFICATION DESCRIPTION</th>

</tr>

<?php foreach ($modifications as $item): ?>
    <tr >
	<td><?php echo  $item['project_name'];?></td>
    <td><?php echo  $item['client_name'];?></td>
     <td><?php echo $item['modifiction_name'];?></td> 	 	
    <td><?php echo  $item['date'];?></td>
    <td><?php echo  $item['estimated_finishing_date'];?></td>
    <td><?php echo  $item['estimated_finishing_time'];?></td>
   <td><?php echo  $item['urgency_of_modification'];?></td>
   <td><?php echo  $item['estimated_cost_of_the_modification'];?></td>
    <td><?php echo $item['mod_desc'];?></td>
    
    </tr>
 
<?php endforeach ?>

</table>

</div>
</div>

