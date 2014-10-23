<script>
$( "#team" )
.change(function () {
var str = "";
$( "select option:selected" ).each(function() {
str += $( this ).text() + " ";
});

})
.change();
</script>
   <!-- ajax search  box script-->
   <script>
$(document).ready(function() {
 $(function() 
 {
  $( "#autocomplete" ).autocomplete({
   source: function(request, response) {
    $.ajax({ url: "<?php echo site_url('vmk/search_client_id'); ?>",
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
 $(function() 
 {
  $( "#autocomplete1" ).autocomplete({
   source: function(request, response) {
    $.ajax({ url: "<?php echo site_url('vmk/search_project_name'); ?>",
    data: { term: $("#autocomplete1").val()},
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
 $(function() 
 {
  $( "#autocomplete2" ).autocomplete({
   source: function(request, response) {
    $.ajax({ url: "<?php echo site_url('vmk/search_domain_name'); ?>",
    data: { term: $("#autocomplete2").val()},
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

<div id="vmkoffice_content">

<div style="text-align:center;" >
<span style="color:red; line-height:30px;"><?php echo $msg1; ?>
<span style=" font-weight:bold; color:#469663"><?php echo $msg; ?></span></span>
</div>
<h2>ADD A PROJECT</h2>
<div style="color:red; text-align:center; font-size:15px; padding-bottom:12px;"> <?php echo $message; ?></div>
<div id="form">
<form method="post" action="<?php echo base_url(); ?>index.php/vmk/proins" id="validation" >
<div class="vmkoffice_mainone_accounts">
<!--<div>
            <div class="vmkoffice_labels_account"><label>Project Id&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" name="id" size="29" class="required" />
</div>
</div> -->
<div>
            <div class="vmkoffice_labels_account"><label>Clients ID&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 


<input type="text" name="clientid" size="29" id="autocomplete" class="required" />
</div>


</div>

<div>
            <div class="vmkoffice_labels_account"><label>Project Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="pname" size="29" class="required" id="autocomplete1" />
</div>
</div> 
<div style="float:left; padding-left:153px; padding-right:78px; clear:both;">
<div style="width:160px; float:left; margin-top:7px; text-align:left; margin-right:4px;"><label style="color:red;">IF client Id is not existing and if the company is new client:</label></div>
<input id="btnShowSimple" type="button" value="Click me"  class="row">
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Domain Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="dname" size="29" class="required" id="autocomplete2" />
</div>
</div> 
<div  style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Domain Hosting&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<select name="hosting" class="required">
            <option value="">--choose--</option>
            <option value="Vmk_Hosting">VMK Hosting</option>
            <option value="Outside_Hosting">Outside Hosting</option>

            </select>
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Project&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 

 <select name="projectfrom" class="required">
            <option value="">--choose--</option>
            <option value="Ind">India</option>
            <option value="Aus">Australia</option>
             <option value="USA">America</option>
            </select>
</div>


</div>
 
<div>
            <div class="vmkoffice_labels_account"><label>Team Leader&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account">
            <select name="team_leader" class="required">
            <option value=""></option>
<?php foreach($user_name as $item) { ?>

<option value="<?php echo $item['username']; ?>"><?php echo $item['username']; ?></option>
<?php } ?>
</select> 

</div>

</div>

<div>
            <div class="vmkoffice_labels_account"><label>Team Members&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
            <select name="team[]" class="required" id="team" multiple="multiple" style="height:auto;">
<option value=""></option>
<?php foreach($user_name as $item) { ?>

<option value="<?php echo $item['username']; ?>"><?php echo $item['username']; ?></option>
<?php } ?>
</select> 

</div>

</div> 


<div>            <div class="vmkoffice_labels_account"><label>Starting Date&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account"> 

 <input name="stdate" type="text" value="<?php echo date('Y-m-d'); ?> "  />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Ending Date&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25" readonly="readonly" style="width:204px;" />
<input type="text" id="datepicker1" name="edate" class="required" />
</div>
</div> 
<div>
            <div class="vmkoffice_labels_account"><label>Cost Of The Project&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"  style="width:300px;"> 
<input type="text" name="cproject" size="29" class="required" />
</div>

</div>
<div style="padding-top:4px; clear:both;">
            <div class="vmkoffice_labels_account"><label>Project Description&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account"> 
<textarea cols="29" rows="4" name="desc" id="editor1" class="required" ></textarea>
</div>
</div>

<div style="padding-top:4px; clear:both;">
            <div class="vmkoffice_labels_account"><label>Domain Hosting Details:</label></div>
            <div class="vmkoffice_inputs_account"> 
<textarea cols="29" rows="4" name="hosting_details" class="required" ></textarea>
</div>
</div>
<div class="vmkoffice_accounts_button" style="padding-top:8px;">
<input type="submit" value="Create Project Id"  class="row">
<input type="reset" value="Cancel"  class="row" />
</div>
</div>
</form></div>
</div>
</div>

        <div style="display: none;" id="overlay" class="web_dialog_overlay"></div>
        <div style="display: none;" id="dialog" class="web_dialog">
        <div style="float:right; padding:10px; 20px; cursor:pointer;" ><img src="<?php echo base_url(); ?>images/26.png"  id="btnClose" /></div>
        <script>
  $(document).ready(function(){
    $("#validation1").validate();
  });
  </script>
        <div id="content">
<h3>CLIENT REGISTRATION FORM </h3>
<div id="form">
<form action="<?php echo base_url();?>index.php/client_controller/suggestions_form_submit" method="post" id="validation1" name="drop_list" onLoad="fillcountry();">
<table width=92% cellspacing="5px" cellpadding="0" border="0px" rules=none align="center" >
<tbody>
<tr>

<td class="dt2">First Name:</td>
<td class="dt3"> <input type="text" name="fname" size="20" class="required"  /></td>

<td class="dt2">Last Name:</td>
<td class="dt3"> <input type="text" name="lname" size="20"  class="required" /></td>
</tr>
<tr>

<td class="dt2">Personal Contact No./Mobile Number&nbsp;:</td>
<td class="dt3"><input type="text" name="mno" size="20" class="required number" maxlength="14" /></td>


<td class="dt2">Emergency Contact No.&nbsp;:</td>
<td class="dt3"><input type="text" name="eno" size="20" class="required number" maxlength="14" /></td>
</tr>
<tr>
<td class="dt2">Email&nbsp;:</td> 
<td class="dt3"><input type="text" name="email" size="20" class="required email" /></td>

<td class="dt2">Address Line1&nbsp;:</td>
<td class="dt3"><input type="text" name="address1"  class="required" /></td>
</tr>
<tr>


<td class="dt2">Address Line2&nbsp;:</td>
<td class="dt3"><input type="text"   name="address2"  class="required" /></td>


<td class="dt2">Country&nbsp;:</td>
<td class="dt3">
<select name="country" class="required" onChange="Selectstate();">
<option selected="selected" value="">--select--</option>
<option value="India">India</option>
<option value="Australia">Australia</option>
<option value="America">America</option>
</select>

</td>
</tr>
<tr>
<td class="dt2">State&nbsp;:</td>

<td class="dt3">
<select id="state" name="state" class="required">
<option selected="selected" value="">--select--</option>
</select>

</td>

<td class="dt2">City&nbsp;:</td>
<td class="dt3">
<select id="city" name="city" class="required">
<option selected="selected" value="">--select--</option>
</select>
</td>
</tr>
<tr>
<td class="dt2">Suburban&nbsp;:</td>
<td class="dt3"><input type="text" name="sub" size="20" class="required" /></td>


<td class="dt2">Postcode&nbsp;:</td>
<td class="dt3"><input type="text" name="postcode" size="20" class="required" /></td>


</tr>
<tr>
<td class="dt2">Main Domain&nbsp;:</td>
<td class="dt3"><input type="text" name="maindomain" size="25" class="required" /></td>
</tr>

</tbody>
</table>
<div class="per_all">
<div style="clear:both; padding-top:12px;"><h2>Permissions</h2></div>

<div style="width:180px; float:left;">
<h2>Projects</h2>
<input type="checkbox" name="proofs2[]" value="entry"  /><span>Projects</span><br />
<input type="checkbox" name="proofs2[]" value="add_project"  /><span>Add A Project</span><br />
<input type="checkbox" name="proofs2[]" value="edit_project"  /><span>Edit A Project</span><br />



</div>
<div style="width:180px; float:left;">
<h2>Clients</h2>

<input type="checkbox" name="proofs3[]" value="client_details"  /><span> Client Details</span><br />
<input type="checkbox" name="proofs3[]" value="registration"  /><span>Registration</span><br />


</div>
<div style="width:180px; float:left;">
<h2>Tracking</h2>
<input type="checkbox" name="proofs4[]" value="entry"  /><span>Entry</span><br />
<input type="checkbox" name="proofs4[]" value="assign_task"  /><span>Assign a Task</span><br />
<input type="checkbox" name="proofs4[]" value="view_task"  /><span>View Task</span><br />
<input type="checkbox" name="proofs4[]" value="add_modifications"  /><span>Add Modifications</span><br />
<input type="checkbox" name="proofs4[]" value="view_modifications"  /><span>View Modifications</span><br />



</div>
<div style="width:180px; float:left;">
<h2>Accounts</h2>

<input type="checkbox" name="proofs5[]" value="accounts"  /><span>Accounts</span><br />



</div>
<div style="width:180px; float:left; clear:both;">
<h2>HR Department</h2>

<input type="checkbox" name="proofs6[]" value="hr_department"  /><span>HR Department</span><br />
</div>
<div style="width:180px; float:left;">
<h2>Marketing</h2>
<input type="checkbox" name="proofs7[]" value="marketing"  /><span>Marketing</span><br />
</div>
 <div style="width:180px; float:left;">
<h2>events</h2>
<input type="checkbox" name="proofs8[]" value="entry"  /><span>Events</span><br />
<input type="checkbox" name="proofs8[]" value="add_event"  /><span>Add A New Event
</span><br />
 
</div><div style="width:180px; float:left;">
<h2>contacts</h2>

<input type="checkbox" name="proofs9[]" value="contacts"  /><span>Contacts</span><br />

</div>
</div>
<div class="vmkoffice_accounts_button" style="width:733px; padding-bottom:15px;">
<input type="submit" value="Create Client Id"  class="row"  />
<input type="reset" value="Cancel"  class="row" />
</div>
</form>
</div>
</div>

</div><!--end wrap-->
<style>
.per_all h2{ font-size:11px; margin:0; padding:0;}
.per_all span{ font-size:10px;}
h3{ margin-bottom:0;}
</style>