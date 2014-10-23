<div id="form1">
<form action="<?php echo base_url(); ?>index.php/employees/delete_employee" method="post" id="formtable" >
<div id="prl" class="prl"><h3>Employee ID</h3>
<div>
<select class="sele" name="id">
<!--<option>VIOLETANDPURPLE</option>
<option>VMK</option>
<option>VIOLET AND PURPLE</option>
<option>VMK</option>-->
<?php foreach ($entry as $item): ?>
   
   <option value="<?php echo $item['Employee_id'];?>"> <?php echo $item['Employee_id'];?> </option>
  <?php endforeach ?>
  </select>
<input type="submit" value="DELETE" name="sub" id="sub" class="sub" /></div>
</div>
</form>
</div>