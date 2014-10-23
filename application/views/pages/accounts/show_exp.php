<div id="vmkoffice_content">

<h2>TOTAL EXPENSES</h2>
<table border="1px" bordercolor="#469663" cellspacing="0" cellpadding="0" width="96%" id="expensestable"  class="expensestable2">
<tr class="row">  
<th >BILL ID</th>
<th >BILL TITLE</th>
<th >INVOICE NO</th>
<th >BILL TYPE</th>
<th >BILL DATE</th>
<th >TOTAL AMOUNT</th>
<th >BILL DESCRIPTION</th>
</tr>
<?php foreach($expenses as $items) { ?>
<tr>
<td><a href="<?php echo base_url(); ?>index.php/accounts/print_bill/<?php echo $items['bill_id']; ?> " class="mouse_over_new"><?php echo $items['bill_id']; ?></td></a>
<td><?php echo $items['bill_title']; ?></td>
<td><?php echo $items['invoice_no']; ?></td>
<td><?php echo $items['bill_type']; ?></td>
<td><?php echo $items['bill_date']; ?></td>
<td><?php echo $items['total_amount'].' '.$items['amount_type']; ?></td>
<td><?php echo $items['bill_desc']; ?></td>
</tr>
<?php } ?>
</table>
</div>
</div>