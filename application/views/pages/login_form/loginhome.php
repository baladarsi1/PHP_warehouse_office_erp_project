<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="<?php echo base_url(); ?>custom_js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>custom_js/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>custom_js/jquery_validate.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Loginform</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" />
<link rel="icon" href="<?php echo base_url()?>uploads/vmkbrowsericon.PNG" />
<script>
  $(document).ready(function(){
    $("#validation").validate();
  });
  </script>
</head>

<body>

<div class="changes_wrap">
<div id="wrap" class="wrap">
<div>
<div class="vmkoffice_wrap"><img src="<?php echo base_url(); ?>images/2.png" class="img1" id="img1" /></div>
<div style="padding-bottom:100px; clear:both;">
<div class="error" id="error">
<?php echo $message; ?>
</div>
<div class="vmkoffice_wrap2">
<h2 id="head1" class="head1">Login Form</h2></div>

<div class="vmkoffice_wrap_new">
<form action="<?php echo base_url(); ?>index.php/login" method="post" id="validation" class="validation" >
<div id="form1" class="form1">
<div class="vmkoffice_wrap3">

<div>
<label>User Name<sup class="span1">*</sup> :

</label>
<div class="user_logo_new"></div>
 <input type="text" name="uname" value="" id="class" class="required" minlength="2" id="req"  /></div>
</div>

<div class="vmkoffice_wrap4"> 
<label>Password <sup class="span1">*</sup> :

</label>
<div class="pass_logo_new"></div>
<input type="password" name="pwd" value=""  id="pwd" class="required" minlength="2"  id="req" /></div>
<div class="vmkoffice_wrap5">

<label>Department <sup class="span1">*</sup> :
</label>
<div class="dep_logo_new"></div>
<select name="dep" class="required">
<option value=""></option>
<option value="Managing_Director">Managing Director</option>
<option value="General_Manager">General Manager</option>
<option value="Administrator">Administrator</option>
<option value="VMK_Employee">VMK Employee</option>
<option value="Clients">Clients</option>
</select></div>
<div class="check1"><input type="checkbox" name="check1" value=""  id="check1" /><label class="check">Remember me</label></div>
<div class="login"><input type="submit" value="Login" name="Login"  id="login" /></div>
</div>
</form>
</div>
<div style=" margin-left:3px;"><img src="<?php echo base_url(); ?>images/23.png" width="446px;"  /></div>
</div>

</div><!-- end wrap-->
</div>
</body>
</html>
