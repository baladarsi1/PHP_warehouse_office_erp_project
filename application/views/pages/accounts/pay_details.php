<div id="vmkoffice_content">

<h2>PAY BILL FORM</h2>
<?php global $less_amt;
$less_amt=0;
?>

<form method="post" action="<?php echo base_url(); ?>index.php/accounts/bill_modify/<?php echo $bill_data[0]['bill_id']; ?>" id="validation" >
<div class="vmkoffice_mainone_accounts" id="invoices_left">
<div>
        <div class="vmkoffice_labels_account"><label><b>S.NO</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['sno']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Bill ID</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['bill_id']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>BILL TITLE</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['bill_title']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>INVOICE NO</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['invoice_no']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>BILL DESCREPTION</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['bill_desc']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>BILL TYPE</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['bill_type']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>BILL GENERATE DATE</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['bill_date']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>TOTAL AMOUNT</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $bill_data[0]['total_amount'].' '.$bill_data[0]['amount_type']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>PAID AMOUNT DETAILS</b></label> </div>
        <div class="vmkoffice_labels_account"><label>
        <?php 
		if($bill_data[0]['paid_amount']=='')
{
	echo '--------';
}
else
{
?>
<?php 


//$paid=$bill_data[0]['paid_amount'];
//echo $paid;
$paid=$bill_data[0]['paid_amount'];
$paid_data=json_decode($paid,true);
//print_r($paid_data);

?>

<?php 
$i=1;
foreach ($paid_data as $items) 
{
echo $items['a'];
echo ' ';
echo $items['b'];
$amt=$items['a'];
$less_amt+=$amt;
$i=$i+1;
echo '<br/>';;
} 

?>

<?php  } ?>

<?php 
$total=$bill_data[0]['total_amount'];
$due_amount=($total-$less_amt);
?></label>
</div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>DUE AMOUNT</b></label> </div>
   <div class="vmkoffice_labels_account"><label><?php echo $due_amount; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>PAY AMOUNT</b></label> </div>
        <div class="vmkoffice_inputs_account" style="width:320px;"><input type="text" name="pay" class="required number" />
        </div>
        </div>

<input type="hidden" name="array_index" value="<?php $i=0;
echo $i; ?>" />
<input type="hidden" name="paid_amount" value="<?php echo $less_amt; ?>" />
<input type="hidden" name="sno" value="<?php echo $bill_data[0]['sno']; ?>" />
<input type="hidden" name="total_amount" value="<?php echo $bill_data[0]['total_amount']; ?>" />
<input type="hidden" name="old_paid" value="<?php echo $bill_data[0]['paid_amount']; ?>" />
<div class="vmkoffice_accounts_button">
          <input type="submit" value="Submit"  class="row"  />

</div>
</div>

</form>

</div>
  </div>