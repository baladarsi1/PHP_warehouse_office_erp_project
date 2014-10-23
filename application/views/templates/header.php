<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php header("Cache-Control: no-store, no-cache, must-revalidate"); ?>
<script src="<?php echo base_url(); ?>custom_js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>custom_js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>custom_js/dialog_script.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>custom_js/jquery_validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>custom_js/jquery_print.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>custom_js/myscript.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>custom_js/states_list_ajax.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>custom_js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
				
	$('#example1').dataTable( {
		"aaSorting": [[ 0, "desc" ]]
		
	} );
} );
		
		</script>
<script type="text/javascript">
       $(function() {
               $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
			    $("#datepicker1").datepicker({ dateFormat: "yy-mm-dd" }).val()
			
       });
   </script>

<script>
  $(document).ready(function(){
    $("#validation").validate();
  });
  </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/expenses.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery_ui.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/menu.css" type="text/css" />
<link rel="icon" href="<?php echo base_url(); ?>images/24.png" type="image/png" />

</head>
<body   onload="mbSet('menu10', 'mbv');">
<script src="<?php echo base_url(); ?>custom_js/wz_tooltip.js" type="text/javascript"></script>
<div id="wrap">
<div id="header">
<div style=" margin-top:-25px; float:left;">
<img src="<?php echo base_url(); ?>images/2.png" class="logo" />

</div>
<?php
 if(($usertype == "Clients" ))
 {
	  ?>
<?php  $usertype1 = str_replace("_"," ",$usertype);?>

<div id="user">
<p class="welcome">
                   <span class="user">Welcome <?php echo $username; ?> </span>
                 
</p>
</div>
<?php } else { ?>

<?php  $usertype1 = str_replace("_"," ",$usertype);?>

<div id="user">
<p class="welcome">
                   <span class="user">Welcome <?php echo $username; ?> </span>
                   <span class="place">Place: Hyderabad</span>
                   <span>Designation: <?php echo $usertype1; ?></span>
</p>
</div>


<?php } ?>



<div class="logout_fresh1">
<img src="<?php echo base_url(); ?>images/20.png">
<span><a href="<?php echo base_url(); ?>index.php/logout">Logout</a></span></div>
</div><!--end header-->
<div style="padding:20px 0;">
<div style="padding-bottom:14px;">

<div id="menu"> 
<div class="fresh_menu">
<a href="<?php echo base_url(); ?>index.php/user_controller/home/all">
<div style="width:48px; float:left;">
<img src="<?php echo base_url(); ?>images/16.png" width="48" height="45"  />
</div>
<div style="float:left; margin-top:21px;">
<span>home</span>
</div>

</a>

</div>
<div class="fresh_menu">

<a href="<?php echo base_url(); ?>index.php/projects">
<div style="width:48px; float:left">
<img src="<?php echo base_url(); ?>images/3.png"  />
</div>
<div style="float:left; margin-top:21px;">
<span>projects</span>
</div>
</a>
</div>
<div class="fresh_menu">
<a href="<?php echo base_url(); ?>index.php/client_controller/suggestions">
<div style="width:48px; float:left">
<img src="<?php echo base_url(); ?>images/22.png" width="50px;" height="45px;"  />
</div>
<div style="float:left; margin-top:21px;">
<span>Clients</span>
</div>
</a>

</div>
<div class="fresh_menu">
<a  href="<?php echo base_url(); ?>index.php/track">
<div style="width:48px; float:left">
<img src="<?php echo base_url(); ?>images/7.png"  />
</div>
<div style="float:left; margin-top:21px;">
<span>tracking</span>
</div>
</a></div>
<div class="fresh_menu">
<a href="<?php echo base_url(); ?>index.php/accounts">
<div style="width:48px; float:left">
<img src="<?php echo base_url(); ?>images/4.png"  />
</div>
<div style="float:left; margin-top:21px;">
<span>accounts</span>
</div>
</a></div>
<div class="fresh_menu">
<a href="<?php echo base_url(); ?>index.php/employees/employeeslink">
<div style="width:48px; float:left">
<img src="<?php echo base_url(); ?>images/5.png" style="width:29px;"  />
</div>
<div style="float:left; margin-top:21px;">
<span>HR Department</span>
</div>
</a></div>
<div class="fresh_menu">
<a href="<?php echo base_url(); ?>index.php/user_controller/marketing">
<div style="width:48px; float:left">
<img src="<?php echo base_url(); ?>images/22.png" width="50px;" height="45px;"  />
</div>
<div style="float:left; margin-top:21px;">
<span>MARKETING</span>
</div>
</a>

</div>
<div class="fresh_menu">
<a href="<?php echo base_url(); ?>index.php/events">
<div style="width:48px; float:left">
<img src="<?php echo base_url(); ?>images/6.png"  />
</div>
<div style="float:left; margin-top:21px;">
<span>events</span>
</div>
</a></div>
<div class="fresh_menu"><a href="<?php echo base_url(); ?>index.php/user_controller/contact_us/contact_us" style="border:none;">
<div style="width:28px; float:left; margin-left:10px;">
<img src="<?php echo base_url(); ?>images/15.png"  />
</div>
<div style="float:left; margin-top:21px;">
<span>contacts</span></a></div>

</div><!--end menu-->




</div>
</div>
