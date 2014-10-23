<script>
$(document).ready(function() {
 $(function() 
 {
  $( "#autocomplete" ).autocomplete({
   source: function(request, response) {
    $.ajax({ url: "<?php echo site_url('vmk/search_project_name'); ?>",
    data: { term: $("#autocomplete").val()},
    dataType: "json",
    type: "POST",
    success: function(data){
     response(data);
    }
   });
  },
  minLength: 1 
  });
 });

});
</script>


 <div id="submenu" class="submenu">
<!--<ul>
<li><a href="#" >Calender</a></li>
<li><a href="<?php echo base_url(); ?>index.php/projectsselect_controller/my_track/my_track"  id="my_track" >My track list</a></li>
</ul>-->
</div><!--end submenu-->
<div style="text-align:center; color:red;">
<?php echo $message; ?>
</div>
<div id="form1">
<form action="<?php echo base_url(); ?>index.php/vmk/edit_project" method="post" id="formtable" >
<div id="prl" class="prl"><h3>PROJECT NAME</h3></div>
<div style="margin-left:340px;">
<div style="width:250px; float:left;">

 <input type="text" name="pro"  size="29" id="autocomplete" class="required"  />

   </div>
  <div style="float:left;">
<input type="submit" value="GO" name="sub" id="sub" class="sub" style="padding:3px 3px 5px 3px;" /></div>
</div>

</form>
</div>