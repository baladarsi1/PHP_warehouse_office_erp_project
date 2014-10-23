<style>.calendar th{
	color:#272729;
	
	 }</style>
<div id="content">
<div id="submenu" class="submenu">
   <?php echo $submenu; ?>
 </div>


 

<div id="title">
<h2>Hi all, Welcome to VMK Software Solutions Pvt.Ltd</h2>


</div><!--end title-->
<div class="cal_menu">
<ul>
<li>
<a href="<?php echo base_url(); ?>index.php/user_controller/home/all">ALL</a>
</li>
<li>
<a href="<?php echo base_url(); ?>index.php/user_controller/home/ongoing" class="color1">ONGOING</a>
</li>
<li>
<a href="<?php echo base_url(); ?>index.php/user_controller/home/annual" class="color2">ANNUAL</a>
</li>
<li>
<a href="<?php echo base_url(); ?>index.php/user_controller/home/sick" class="color3">SICK</a>
</li> 
<li>
<a href="<?php echo base_url(); ?>index.php/user_controller/home/events" class="color4">EVENT</a>
</li> 
</ul>
</div>
<div style="clear:both;">

	<?php if($page1=='ongoing'){ ?>
    
	<style>.content{ color:green!important;}</style>
	<?php } ?>
   <?php if($page1=='annual'){ ?>
    
	<style>.content{ color:purple!important;}</style>
	<?php } ?>
    <?php if($page1=='sick'){ ?>
    
	<style>.content{ color:red!important;}</style>
	<?php } ?>
    <?php if($page1=='events'){ ?>
    
	<style>.content{ color:blue!important;}</style>
	<?php } ?>
	
	<?php echo $calendar; ?>
  </div>


</div>

</div>
<div><a href="<?php echo base_url(); ?>index.php/user_controller/view1/about" style="color:#469663;"><h2 style="font-size:15px;">VMK Internal</h2></a></div>