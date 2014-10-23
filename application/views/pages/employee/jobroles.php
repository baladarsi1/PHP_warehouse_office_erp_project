<div id="content">

<div style="clear:both; padding-top:20px;">
<p class="para1" style="clear:both;" >Below is the list of employees and management and their Roles of work so that all can have work together</p>
<table border="1px" bordercolor="#fff" cellspacing="0" cellpadding="8" width="95%" id="example" style="clear:both; margin:auto;">
<thead>
<tr class="row">
<th >Employee Id</th>
  <th >NAMES</th>
  <th >Position</th>
  <th >WORK ASSIGNED</th>
    <th >Contact Details</th>
   <th >Date of joining</th>
      <th >Date of Reliving</th>
</tr>
</thead>
<tbody>
<?php foreach ($roles as $items){ ?>
<tr>
  <td><?php echo $items['Employee_id']; ?></td>


 <td><?php echo $items['First_name'].' '.$items['Last_name']; ?></td>
 <td><?php echo $items['Designation']; ?></td>
 <td><?php echo $items['work_assigned']; ?></td>
  <td>Contact No:<?php echo $items['Phone_no']; ?><br /> 
  Email:<?php echo $items['Email_id']; ?></td>
 <td><?php echo $items['Date_of_joining']; ?></td>
 
  <td><?php  if($items['date_of_releaving']=='0000-00-00')
  {
  }
  else
  {echo $items['date_of_releaving']; } ?>
  </td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>