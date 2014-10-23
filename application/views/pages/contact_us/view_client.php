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

  </tr>
<?php foreach($contact as $item):?>
    <tr>
    <td><?php echo $item['sno'];?></td>
    <td><?php echo $item['first_name'].' '.$item['last_name'];?></td>
   
   <td><?php echo $item['mobile_number'];?></td>
    <td><?php echo $item['emergency_contact_no'];?></td>
   
      <td><?php echo $item['email'];?></td>
      <td>
 <b>Address Line1:</b><?php echo str_replace(',',' ,',$item['address_line1']);?><br />
	<b>Address Line2:</b><?php echo str_replace(',',' ,',$item['address_line1']); ?><br />
     <b>Country:</b><?php echo $item['country'];?><br />
    <b>State:</b><?php echo $item['state'];?><br />
    <b>City:</b><?php echo $item['city'];?><br />
   <b>Suburban:</b><?php echo  $item['suburb'];?><br />
   <b> Postcode:</b><?php echo $item['postcode'];?><br />
   

    </td>
   
    </tr> 
<?php endforeach ?>
</table>
</div>

