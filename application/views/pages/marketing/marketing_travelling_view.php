<div style="padding-top:10px;">
<h2 style="clear:both;">Marketing Travelling Details</h2>
 	 	 	
<table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="8" width="95%" id="expensestable">
<tr class="row">
  <th >sno</th>
  <th >Starting date</th>
   <th >Ending date</th>
    <th >App. No</th>
     <th >user name</th>
  <th >Organization name</th>
 <th >Contact person number</th>  
  <th >Source=>Destination</th>

  <th >Mode of transport</th>
  <th >Expenses</th>
  </tr>
<?php foreach($contact as $item):?>
    <tr> 
   <td><?php echo $item['sno']; ?></td>
    <td><?php echo $item['starting_date']; ?></td>
   <td><?php echo $item['ending_date']; ?></td>
   <td><?php echo $item['appointment_no']; ?></td>
   <td><?php echo $item['user_name']; ?></td>
   <td><?php echo $item['organization_name'];?></td>
    <td><?php echo $item['contact_person_number'];?></td>
   
      <td><?php echo $item['starting_place'].'=>'.$item['destination'];?></td>
    
    <td><?php echo $item['mode_of_transport'];?></td>
   
      <td><?php echo $item['expenses'];?></td>
    
    </tr> 
<?php endforeach ?>
</table>
</div>

