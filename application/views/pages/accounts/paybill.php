<?php global $less_amt;
$less_amt=0;
?>
<div id="vmkoffice_content">

<h2>PAY BILL</h2>
<table border="1px" bordercolor="#acacac" cellspacing="0" cellpadding="0" width="96%" id="expensestable"  class="expensestable2">
<tr class="row">  
<th >BILL ID</th>
<th >BILL TITLE</th>
<th >INVOICE NO.</th>
<th >BILL TYPE</th>
<th >BILL DATE</th>
<th >TOTAL AMOUNT</th>
<th >PAID AMOUNT</th>
<th >DUE AMOUNT</th>

</tr>
<?php foreach($expenses as $items) { ?>
<?php $less_amt=0; ?>
<tr>
<td><a href="<?php echo base_url(); ?>index.php/accounts/show_data/<?php echo $items['bill_id']; ?> " class="mouse_over_new" ><?php echo $items['bill_id']; ?></a></td>
<td><?php echo $items['bill_title']; ?></td>
<td><?php echo $items['invoice_no']; ?></td>
<td><?php echo $items['bill_type']; ?></td>
<td><?php echo $items['bill_date']; ?></td>
<?php $total1=$items['amount_type']; ?>
<?php $total=$items['total_amount']; ?>
<td><?php echo $total.' '.$items['amount_type']; ?></td>
<td>
<?php
$pay=$items['paid_amount'];
//echo $pay;
if($pay=='')
{
	echo '------';
}
else
{
$paid_data=json_decode($pay,true);
//print_r($paid_data);
$i=1;
foreach ($paid_data as $pay1) 
{
echo $pay1['a'];
echo ' ';
echo $pay1['b'];	
$amt=$pay1['a'];
$less_amt += $amt;
$i = $i+1;
echo '<br/>';
}
}
?>
</td>
<td>
<?php 
if($pay=='')
{
	echo $total.$total1;
}
else
{
	$due=$total-$less_amt;
	echo $due.$total1; 
}
?>
</td>

</tr>
<?php } ?>
</table>

</div>
</div>