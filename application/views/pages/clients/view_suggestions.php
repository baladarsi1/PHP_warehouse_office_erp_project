
<h2 style="clear:both;">CLIENT DETAILS</h2>
<table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="0" width="96%" id="expensestable" class="expensestable1">
<tr class="row">  
  
  <th >Client User ID:</th>
  <th >First Name</th>
  <th >Last Name</th>
 
  <th >Address</th>
  <th >Main Domain</th>
 
</tr>

<?php foreach ($entry as $item): ?>
    <tr >
	
   <td><?php echo  $item['client_user_id'];?></td>
    <td><?php echo $item['first_name'];?></td>
    <td><?php echo $item['last_name'];?></td>
    
   
    <td class="bo">
	<b>Address Line1:</b><?php echo str_replace(',',' ,',$item['address_line1']); ?><br />
	<b>Address Line2:</b><?php echo str_replace(',',' ,',$item['address_line2']); ?><br />
    <b>State:</b><?php echo $item['state'];?><br />
    <b>City:</b><?php echo $item['city'];?><br />
   <b>Suburban:</b><?php echo  $item['suburb'];?><br />
   <b> Postcode:</b><?php echo $item['postcode'];?><br />
    <b>Country:</b><?php echo $item['country'];?><br />

   
  <b>Mobile Number:</b><?php echo $item['mobile_number'];?><br />
  <b>Email:</b><?php echo  $item['email'];?>
    </td>
    <td><?php echo $item['main_domain'];?></td>
   
    </tr>
 
<?php endforeach ?>
</table>

</div>
