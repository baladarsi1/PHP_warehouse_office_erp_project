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
<form action="<?php echo base_url(); ?>index.php/project" method="post" id="formtable" >
<div id="prl" class="prl"><h3>PROJECT NAME</h3></div>
<div style="margin-left:340px;">
<div style="width:250px; float:left;">

 <?php
 if(($usertype == "Clients" )){

 ?>
<select class="sele" name="pro">
<!--<option>VIOLETANDPURPLE</option>
<option>VMK</option>
<option>VIOLET AND PURPLE</option>
<option>VMK</option>-->
<?php foreach ($entry as $profield): ?>
   
   <option value="<?php echo $profield['name'];?>"> <?php echo $profield['name'];?> </option>
  <?php endforeach ?>
  </select>
<?php }  else {?>

 <input type="text" name="pro"  size="29" id="autocomplete" class="required"  />
 <?php } ?>
  </div>
  <div style="float:left;">
<input type="submit" value="GO" name="sub" id="sub" class="sub" style="padding:3px 3px 5px 3px;" /></div>
</div>

</form>
</div>
<div>
<h2 style="clear:both;">NEW PROJECTS</h2>
<table border="1px" bordercolor="#fff" cellspacing="0" cellpadding="0" width="95%" id="example" style="clear:both; margin:auto;" class="expensestable1">
<thead>
 <tr class="row"> 
  
  <th >project id</th>
  <th >PROJECT name</th>
  <th >client name</th>
   <th >project place</th>
  <th >team leader</th>
   <th >team members</th>
 <th >chart</th>

</tr>
</thead>
<tbody>

<?php foreach ($projects as $item): ?>
<?php  $pro_id1 = str_replace("/","-",$item['id']); ?>
    <tr >
	
    <td><a href="<?php echo base_url(); ?>index.php/projectsselect_controller/project_form1/<?php echo $pro_id1;?>" class="mouse_over_new" ><?php echo $item['id'];?></a></td>
    <td><?php echo  $item['name'];?></td>
    <td><?php echo  $item['client_name'];?></td>
     <td><?php echo  $item['project_place'];?></td>
   <td><?php echo  $item['team_leader'];?></td>
    <td></td>
     <td style="text-align:right;">
     <?php if($item['project_position']=='25%') { ?>
     <img src="<?php echo base_url(); ?>images/graph1.png" width="71" height="77;" />

      <?php } else if($item['project_position']=='50%') { ?>
     <img src="<?php echo base_url(); ?>images/graph2.png" width="71" height="77;" />
    
      <?php } else if($item['project_position']=='75%') { ?>
     <img src="<?php echo base_url(); ?>images/graph3.png" width="71" height="77;" />
    
      <?php } else if($item['project_position']=='100%') { ?>
     <img src="<?php echo base_url(); ?>images/graph4.png" width="71" height="77;" />
     <?php } ?>
     
     </td>
    </tr>
 
<?php endforeach ?>
</tbody>
</table>
<div class="graph_images_small" >
<img src="<?php echo base_url(); ?>images/green.png" width="15" /> Complated 
<img src="<?php echo base_url(); ?>images/red.png" width="15" /> Not Completed
 </div>
</div>

</div>

