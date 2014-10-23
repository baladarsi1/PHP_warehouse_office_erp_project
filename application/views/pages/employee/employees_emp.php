
 <div id="content">
<div id="submenu">
<?php echo $submenu1; ?>
</div><!--end submenu-->
				<h2>EMPLOYEES</h2>
                
	
   <table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="8" width="95%" id="expensestable">
<tr class="row">
  <th >S.NO</th>
  <th >NAME</th>
  <th >EMPLOYEE ID</th>
  <th >DESIGNATION</th>
  <th >Date Of Joining</th>

  <th >Photo Id</th>
</tr>
		<?php foreach($employees as $item): ?>
			<tr>
    		<td><?php echo $item['sno']; ?></td> 	
			<td><?php echo $item['First_name'].$item['Last_name']; ?></td>
			<td><?php echo $item['Employee_id']; ?></td>
			<td><?php echo $item['Designation']; ?></td>
            <td><?php echo $item['Date_of_joining']; ?></td>
			
			<td><img src="<?php echo base_url();?>employee_photos/<?php echo $item['photo_id'] ?>" height="100" width="100" /></td> 
			</tr>
		<?php endforeach ?>
</table>
</div>  

 
</div>     
