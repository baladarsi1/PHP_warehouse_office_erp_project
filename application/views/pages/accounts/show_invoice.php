<div>

<h2>TOTAL INVOICES</h2>
<table border="1px" bordercolor="#469663" cellspacing="0" cellpadding="0" width="95%" id="expensestable"  class="expensestable2">
<tr class="row">  
<th >INVOICE ID</th>
<th >INVOICE TITLE</th>

<th >INVOICE DATE</th>
<th >TOTAL AMOUNT</th>
<th >INVOICE DESCRIPTION</th>
</tr>
<?php foreach($invoice as $items) { ?>
<tr>
<td><?php echo $items['invoice_id']; ?></td>
<td><?php echo $items['invoice_title']; ?></td>
<td><?php echo $items['invoice_no']; ?></td>
<td><?php echo $items['invoice_date']; ?></td>
<td><?php echo $items['total_amount'].' '.$items['amount_type']; ?></td>
<td><?php echo $items['invoice_desc']; ?></td>
</tr>
<?php } ?>
</table>
</div>
</div>