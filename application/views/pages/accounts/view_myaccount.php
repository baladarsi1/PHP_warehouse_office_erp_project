<div id="vmkoffice_content">

<h2>MY ACCOUNT</h2>
<table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="0" width="95%" id="expensestable" 
class="expensestable1">

 <tr class="row"> 
  <th >Sno</th>
  <th >REF ID:</th>
  <th >INVESTER</th>
  <th >AMOUNT</th>
  <th >DATE</th>
  <th >DESCRIPTION</th>
  <th >AMOUNT</th>
  <th >PROOF</th>
</tr>

<?php foreach ($myaccount as $item): ?>
    <tr >
	<td id="dt1"><?php echo $item['sno'];?></td>
    <td><?php echo  $item['ref_id'];?></td>
    <td><?php echo $item['invester'];?></td>
    <td><?php echo $item['amount'];?></td>
    <td><?php echo $item['date'];?></td>
    <td><?php echo $item['amount_desc'];?></td>
    <td><?php echo $item['amount'].' '. $item['amount_type'];?></td>
    <td> <img src="<?php echo base_url();?>uploads/<?php echo $item['amount_proof'] ?>" height="100" width="100" /></td>
    </tr>
 
<?php endforeach ?>
</table>

</div>
</div>

