<div style="padding-top:10px;">
<h2 style="clear:both;">Marketing Appointments Details</h2>

<table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="8" width="95%" id="expensestable">
<tr class="row">
  <th >S.NO</th>
  <th >Appointment No</th>
   <th >User Name</th>
  <th >Person name</th>
 <th >Date</th>  
  <th >Time</th>
  <th >Adress</th>
  <th >Result of appointment</th>
  <th >Edit/cancel</th>
  </tr> 	 	 	 	
<?php foreach($contact as $item):?>
    <tr>
    <td><?php echo $item['sno'];?></td>
    <td><a class="mouse_over_new" href="<?php echo base_url(); ?>index.php/user_controller/travaling/<?php echo $item['appointment_no']; ?>/<?php echo $item['user_name']; ?>"><?php echo $item['appointment_no']; ?></a></td>
     <td><?php echo $item['user_name']; ?></td>
    <td><?php echo $item['person_name']; ?></td>
   
   <td><?php echo $item['organization_name']; ?></td>
    <td><?php echo $item['date']; ?></td>
   
      <td><?php echo $item['time']; ?></td>
  <td><?php echo $item['result_of_appointment']; ?></td>
  <td><a href="<?php echo base_url(); ?>index.php/user_controller/appointement_edit/<?php echo $item['sno']; ?>" style="text-decoration:none;"><input type="button" class="row" value="Edit" /></a> <a href="<?php echo base_url(); ?>index.php/user_controller/appointement_delete/<?php echo $item['sno']; ?>" style="text-decoration:none;"><input type="button" class="row" value="Cancel" /></a></td>
    </tr> 
<?php endforeach ?>
</table>
</div>

