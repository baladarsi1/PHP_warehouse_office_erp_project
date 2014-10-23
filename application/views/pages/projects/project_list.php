<div id="link" style="float:left; padding-left:16px; padding-top:10px;">

<a class="link" id="eve" href="<?php echo base_url();?>index.php/new_project">ADD A PROJECT</a>
<a class="link" id="eve" href="<?php echo base_url();?>index.php/vmk/view/all_projects_list">EDIT A PROJECT</a>


</div>

<div style=" text-align:center; clear:both;">
<h2> PROJECT INFORMATION </h2>
 </div>
<table id="example1" border="1px" bordercolor="#fff" cellspacing="0" cellpadding="0" width="95%" style="clear:both; margin:auto;" >
<thead>
<tr class="row">  
  <th >Sno</th>
  <th >Project Id</th>
  <th >Project Name</th>

  <th >Team Members</th>
  <th >Start Date</th>
  <th >End Date</th>
   <th >COST of the project Date</th>
  <th >Description</th>
  <th >Edit</th>
</tr>
</thead>
<tbody>
<?php foreach ($project_information as $item): ?>

<?php  $pro_id1 = str_replace("/","-",$item['id']);
       ?>
    <tr >
	<td id="dt1"><?php echo $item['sno'];?></td>
   <td> <a href="<?php echo base_url(); ?>index.php/projectsselect_controller/project_form1/<?php echo $pro_id1; ?>" class="mouse_over_new"><?php echo $item['id'];?></a></td>
    <td><a href="<?php echo $item['domain_name'];?>" onmouseover="Tip('<?php echo $item['domain_name'];?>')" onmouseout="UnTip()" target="_blank" style="text-decoration:none;"><?php echo $item['name'];?></a></td>
   
    
    <td><?php echo $item['team_members'];?></td>
    <td><?php echo $item['start_date'];?></td>
    <td><?php echo $item['end_date'];?></td>
     <td><?php echo $item['cost_of_the_project'];?></td>
    <td><a onmouseover="Tip('<?php echo $item['description'];?>')" onmouseout="UnTip()" target="_blank"><?php echo word_limiter($item['description'],2); ?></a>
	 </td>
      <td style="padding:10px 6px;"><div><a  class="spaecial_eed" href="<?php echo base_url(); ?>index.php/vmk/edit_project_read_only/<?php echo $pro_id1; ?>" >Edit</a></div>
      <div style="clear:both; padding-top:18px;">
      <a  class="spaecial_eed" href="<?php echo base_url(); ?>index.php/vmk/show_projects_id/<?php echo $pro_id1; ?>/view" >View</a>
      </div>
      </td>
    </tr>
  
<?php endforeach ?>
</tbody>
</table>

</div>
