<div style="padding-top:10px;">
<h2 style="clear:both;"><?php echo $page ?></h2>


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
    <td><?php echo $item['first_name'].' '.$item['last_name'];?></td>
   
   <td><?php echo $item['personal_contact'];?></td>
    <td><?php echo $item['emergency_contact'];?></td>
   
      <td><?php echo $item['email'];?></td>
      <td>
 <b>Address Line1:</b><?php echo $item['addressline1'];?><br />
	<b>Address Line2:</b><?php echo $item['addressline2'];?><br />
     <b>Country:</b><?php echo $item['country'];?><br />
    <b>State:</b><?php echo $item['state'];?><br />
    <b>City:</b><?php echo $item['city'];?><br />
   <b>Suburban:</b><?php echo  $item['suburban'];?><br />
   <b> Postcode:</b><?php echo $item['postcode'];?><br />
   

    </td>
   <td><img src="<?php echo base_url();?>contact_us_photos/<?php echo $item['photo_id'] ?>" height="100" width="100" /></td> 
    </tr> 
<?php endforeach ?>
</table>
</div>

