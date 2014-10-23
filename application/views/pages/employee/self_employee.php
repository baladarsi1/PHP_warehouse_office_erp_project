<div>
<div id="submenu">

<?php if($home=='home'){ echo $submenu; } else { echo $submenu1; }?>
</div><!--end submenu-->
<div style="text-align:center;" >
<span style=" font-weight:bold; color:#469663"><?php echo $msg0; ?></span></span>
<span style="color:red; line-height:30px;"><?php echo $msg1; ?>
<span style=" font-weight:bold; color:#469663"><?php echo $msg; ?></span></span>
</div>
<div style="width:540px; float:left;"><?php if($edit=='edit'){?><h2 style="text-align:right; margin-right:30px;">DETAILS</h2> <?php } else{?><h2 style="text-align:right;">MY DETAILS</h2><?php }?></div>
<?php if($edit=='edit') {?><div style="float:left; width:394px; text-align:right;  padding-top:20px;"><a href="<?php echo base_url(); ?>index.php/employees/edit_emp_details/<?php echo str_replace(' ','_',$entry[0]['Employee_id']); ?>" class="link">Edit Details</a></div><?php } ?>
</div><!--end title-->



<div id="table" style=" width:890px; margin:auto; clear:both;">
   <table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="8" width="100%" frame="box" rules="none">
<tr> 
	 
		   <tr><td>First Name</td><td>:</td><td><?php echo $entry[0]['First_name']; ?></td></tr>  
		  	<tr><td>Last Name</td><td>:</td><td><?php echo $entry[0]['Last_name']; ?></td></tr>
			<tr><td>Email ID</td><td>:</td><td><?php echo $entry[0]['Email_id']; ?></td></tr>
			<tr><td>Designation</td><td>:</td><td><?php echo $entry[0]['Designation']; ?></td></tr>
			<tr><td>Employee ID</td><td>:</td><td><?php echo $entry[0]['Employee_id']; ?></td></tr>
			<tr><td>Address Line1</td><td>:</td><td><?php echo $entry[0]['Address1'] ?></td></tr>
			<tr><td>Address Line2</td><td>:</td><td><?php echo $entry[0]['Address2'] ?></td></tr>
			<tr><td>Alternate Phone No.</td><td>:</td><td><?php echo $entry[0]['emergency_no'] ?></td></tr>
			<tr><td>Date of Joining</td><td>:</td><td><?php echo $entry[0]['Date_of_joining'] ?></td></tr>
			<tr><td>Probation period</td><td>:</td><td><?php echo $entry[0]['Probation'] ?></td></tr>
			<tr><td>Income per Annum</td><td>:</td><td><?php echo $entry[0]['income_perannum'] ?></td></tr>
			<tr><td>Bank Account No.</td><td>:</td><td><?php echo $entry[0]['Bank_account'] ?></td></tr>
			<tr><td>Resume</td><td>:</td><td><a href="<?php echo base_url(); ?>employee_photos/<?php echo $entry[0]['Resume'] ?>" target="_blank"><?php echo $entry[0]['First_name'].' '.'Resume' ?></td></tr>
			<tr><td>Proofs Submitted By Employee Joining</td><td>:</td><td><?php echo $entry[0]['Proofs_submitted'] ?></td></tr>
			<tr><td>Bond Period</td><td>:</td><td><?php echo $entry[0]['Bond_period'] ?></td></tr>
		
 </tr>
<table  border="1px" bordercolor="#ddd" style="margin-top:5px;" cellspacing="0" cellpadding="8" width="100%" frame="box" style="border-top:none;">
<tr>
	<td>Leaves for the employee</td>
	<td>Annual leaves</td>
	<td>Sick leaves</td>
	
	<td>Total no of leaves per annum</td>
</tr>
<tr>
    <td rowspan="1" valign="bottom">Total no of leaves assigned for employee</td>
	
	
	<td><?php echo $entry[0]['Annual_leaves'] ?></td>
	<td><?php echo $entry[0]['Sick_leaves'] ?></td>
	<td><?php echo $entry[0]['Total_leaves'] ?></td>
</tr>
</table>
</table>

   </div>        
</div>