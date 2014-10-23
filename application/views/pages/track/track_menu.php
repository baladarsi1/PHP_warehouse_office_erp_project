<?php  $pro_id1 = str_replace("/","-",$projectid);
        ?>


<div id="link" style="margin-bottom:26px; margin-left:26px;">

 <div style="float:left; width:138px;  margin-top:-1px; ">
 <div id="menu1" style="width:130px; margin:0 !important; margin-top:-4px !important; height:26px; padding:0 !important;">
 <ul class='menu1'>
 <li>
  <a class="link" href="#" style="border:none !important; margin-left:17px; background: none; margin-top:-7px;">MODIFICATIONS</a>
  <div style="margin:0 0 0 -5px; top:30px;width:148px; height:41px;">
  <ul>
  
  <li><a class="link" href="<?php echo base_url(); ?>index.php/modification/<?php echo $pro_id1; ?>" style="width:148px; margin:0;">ADD MODIFICATIONS</a></li>
<li><a class="link" href="<?php echo base_url(); ?>index.php/modifications/<?php echo $pro_id1; ?>" style="width:148px;margin:0;">VIEW MODIFICATIONS</a></li>
  </ul>
  </div>
  </li>
  </ul>
  </div>
  </div>

 
 <div style="float:left; width:138px;  margin-top:-1px; ">
 <div id="menu1" style="width:130px; margin:0 !important; margin-top:-4px !important; height:26px; padding:0 !important;">
 <ul class='menu1'>
 <li>
  <a class="link" href="#" style="border:none !important; margin-left:21px; background: none; margin-top:-7px;">ASSIGN TASK</a>
  <div style="margin:0 0 0 -5px; top:30px;width:148px; height:41px;">
  <ul>
  
  <li><a class="link" href="<?php echo base_url();?>index.php/assign_project/<?php echo $pro_id1; ?>" style="width:148px; margin:0;">ASSIGN A TASK</a></li>
<li><a class="link" href="<?php echo base_url(); ?>index.php/projectsselect_controller/project_view/<?php echo $pro_id1; ?>" style="width:148px;margin:0;">VIEW TASK</a></li>
  </ul>
  </div>
  </li>
  </ul>
  </div>
  </div>



</div>