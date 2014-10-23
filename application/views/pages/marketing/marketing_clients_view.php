<div style="padding-top:10px;">
<h2 style="clear:both;">Marketing Client Details</h2>


<table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="8" width="95%" id="expensestable">
<tr class="row">
  <th >S.NO</th>
  <th >Organization Name</th>
 <th >Organization Address</th>  
  <th >Person name</th>
 
 <th >Person Address</th>
  <th >Mediator Organization name</th>
  <th>Mediator Name </th>
<th>Mediator Address </th>
  </tr>
<?php foreach($contact as $item):?>
    <tr>
    <td><?php echo $item['sno'];?></td>
    <td><?php echo $item['organization_name']; ?></td>
   
   <td><b>Org. Address:</b><?php echo $item['organization_address'];?><br />
	<b>Org. Email:</b><?php echo $item['organization_email'];?><br />
    <b>Org Contact:</b><?php echo $item['organization_contact'];?>
	</td> 	
    
   
     
      
      <td><?php echo $item['person_first_name'].' '.$item['person_last_name'];?></td>
      <td>
 <b>Address Line1:</b><?php echo str_replace(',',' ,',$item['person_address_line1']); ?><br />
	<b>Address Line2:</b><?php echo str_replace(',',' ,',$item['person_addressline2']); ?><br />
     <b>Country:</b><?php echo $item['person_country'];?><br />
    <b>State:</b><?php echo $item['person_state'];?><br />
    <b>City:</b><?php echo $item['person_city'];?><br />
   <b>Suburban:</b><?php echo  $item['person_suburban'];?><br />
   <b> Postcode:</b><?php echo $item['person_postcode'];?><br />
    <b> Postcode:</b><?php echo $item['person_designation'];?><br />
     <b> Postcode:</b><?php echo $item['person_email'];?><br />
      <b> Postcode:</b><?php echo $item['person_phone_no'];?></td>
      <td><?php echo $item['mediator_organization']; ?></td>
      <td><?php echo $item['mediator_name'];?></td>
      <td>
       <b>Mediator Address:</b><?php echo $item['mediator_address'];?><br />
	<b>Mediator Contact No: </b><?php echo $item['mediator_contact_no'];?><br />
    <b>Mediator Email:</b><?php echo $item['mediato_email'];?></td>
    
	
    </tr> 
<?php endforeach ?>
</table>
</div>

