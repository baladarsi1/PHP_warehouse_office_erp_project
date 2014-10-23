<div id="vmkoffice_content">

<h2>VIEW WAGES</h2>
<table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="0" width="95%" id="expensestable" 
class="expensestable1">

 <tr class="row"> 
  <th >Sno</th>
  <th >Employee name:</th>
  <th >Employee id</th>
  <th >salary amount</th>
  <th >starting date</th>
  <th >ending date</th>
  <th >DESCRIPTION</th>
</tr>

<?php foreach ($wages as $item): ?>
    <tr >
	<td id="dt1"><?php echo $item['sno']; ?></td>
    <td><?php echo  $item['employee_name']; ?></td>
    <td><?php echo $item['employee_id']; ?></td>
    <td><?php echo $item['salary_amount']; ?></td>
    <td><?php echo $item['starting_date']; ?></td> 	
    <td><?php echo $item['ending_date']; ?></td>
    <td><?php echo $item['description']; ?></td>
    </tr>
 
<?php endforeach ?>
</table>

</div>
</div>

