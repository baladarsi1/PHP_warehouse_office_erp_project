<div style="padding-top:10px;">
<h2 style="clear:both;">Dedicators Details</h2>


<table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="8" width="95%" id="expensestable">
<tr class="row">
  <th >S.NO</th>
  <th >NAME</th>
 <th >personal contact no.</th>  
  <th >emergency contacty no.</th>
 
 <th >Email</th>
  <th >ADDRESS</th>
  <th >photo id</th>
  </tr>
<?php foreach($contact as $item):?>
    <tr>
    <td><?php echo $item['sno'];?></td>
    <td><?php echo $item['First_name'].' '.$item['Last_name'];?></td>
   
   <td><?php echo $item['Phone_no'];?></td>
    <td><?php echo $item['emergency_no'];?></td>
   
      <td><?php echo $item['Email_id'];?></td>
      <td>
 <b>Address Line1:</b><?php echo str_replace(',',' ,',$item['Address1']); ?><br />
 <b>Address Line1:</b><?php echo str_replace(',',' ,',$item['Address1']); ?><br />
	<b>Country:</b><?php echo $item['country'];?><br />
    <b>State:</b><?php echo $item['state'];?><br />
    <b>City:</b><?php echo $item['city'];?><br />
   <b>Suburban:</b><?php echo  $item['suburban'];?><br />
   <b> Postcode:</b><?php echo $item['postcode'];?><br />
   

    </td>
   <td><img src="<?php echo base_url();?>employee_photos/<?php echo $item['photo_id'] ?>" height="100" width="100" /></td> 
    </tr> 
<?php endforeach ?>
</table>
</div>

