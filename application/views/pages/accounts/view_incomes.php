<div id="vmkoffice_content">

<h2>TOTAL INCOMES</h2>
<table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="0" width="95%" id="expensestable" 
class="expensestable1">
<tr class="row">  
  <th >Sno</th>
  <th >REF ID:</th>
  <th >INCOME TYPE</th>
  <th > DATE</th>
  <th >AMOUNT</th>
</tr>

<?php foreach ($incomes as $item): ?>
    <tr >
	<td id="dt1"><?php echo $item['sno'];?></td>
    <td><a href="<?php echo base_url(); ?>index.php/accounts/print_income/<?php echo $item['ref_id']; ?> " class="mouse_over_new" ><?php echo  $item['ref_id'];?></a></td>
    <td><?php echo $item['income_type'];?></td>
    <td><?php echo $item['date'];?></td>
    <td><?php echo $item['total_amount'].' '. $item['amount_type'];?></td>
    </tr> 
   
<?php endforeach ?>

</table>
</div>
</div>


