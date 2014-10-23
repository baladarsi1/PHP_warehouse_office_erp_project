

<div id="vmkoffice_content">


<h2>EDIT A PROJECT</h2>

<div id="form">
<?php if($read=="write"){ ?>
<form method="post" action="<?php echo base_url(); ?>index.php/vmk/edit_submit" id="validation" >
<div class="vmkoffice_mainone_accounts">

<div>
            <div class="vmkoffice_labels_account"><label>Clients ID&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 


<input type="text" name="clientid" size="29"  value="<?php echo $entry[0]['client_id']; ?>"   class="required" />
</div>


</div>
<div>
            <div class="vmkoffice_labels_account"><label>Project Id&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
 <input type="text" name="id" size="29"  value="<?php echo $entry[0]['id']; ?>"  class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Project Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="pname" size="29"  value="<?php echo $entry[0]['name']; ?>"  class="required" />
</div>
</div> 

<div>
            <div class="vmkoffice_labels_account"><label>Domain Name&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="dname" size="29"  value="<?php echo $entry[0]['domain_name']; ?>"  class="required" />
</div>
</div> 
<div  style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Domain Hosting&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<input type="text" name="dname" size="29"  value="<?php echo $entry[0]['domain_hosting']; ?>"  class="required" />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Project&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 

          <input type="text" name="projectfrom" size="29"  value="<?php echo $entry[0]['project_place']; ?>"  class="required" />
</div>


</div>
 
<div>
            <div class="vmkoffice_labels_account"><label>Team Leader&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account">
            <input type="text" name="team_leader" size="29"  value="<?php echo $entry[0]['team_leader']; ?>"  class="required" />
          

</div>

</div>

 


<div>            <div class="vmkoffice_labels_account"><label>Starting Date&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account"> 

 <input name="stdate" type="text"  value="<?php echo $entry[0]['start_date']; ?> "  />
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Ending Date&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account"> 
<input type="text"  size="25" readonly="readonly" style="width:204px;" />
<input type="text" id="datepicker1" name="edate"  value="<?php echo $entry[0]['end_date']; ?>" class="required" />
</div>
</div> 
<div>
            <div class="vmkoffice_labels_account"><label>Cost Of The Project&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"  style="width:300px;"> 
<input type="text" name="cproject" size="29"  value="<?php echo $entry[0]['cost_of_the_project']; ?>"  class="required" />
</div>

</div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label>Project Position&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"  style="width:300px;"> 
<select name="project_pos"  class="required" >
<option value="">--select--</option>
<option value="25%">25%</option>
<option value="55%">50%</option>
<option value="75%">75%</option>
<option value="100%">100%</option>
</select>
</div>

</div>
<div style="padding-top:6px; clear:both;">
            <div class="vmkoffice_labels_account"><label>Domain Hosting Details:</label></div>
            <div class="vmkoffice_inputs_account"> 
<textarea cols="29" rows="4" name="desc"  class="required" ><?php echo $entry[0]['domain_hosting_details']; ?></textarea>
</div>
</div>
<div>
            <div class="vmkoffice_labels_account"><label>Team Members&nbsp;:</label>
            </div>
            <div class="vmkoffice_inputs_account"> 
<textarea cols="29" rows="4" name="desc"  class="required" >  <?php echo $entry[0]['team_members']; ?></textarea></div>

</div>
<div style="padding-top:6px; clear:both;">
            <div class="vmkoffice_labels_account"><label>Project Description&nbsp;:</label></div>
            <div class="vmkoffice_inputs_account"> 
<textarea cols="29" rows="4" name="desc" id="editor1" class="required" ><?php echo $entry[0]['description']; ?></textarea>
</div>
</div>
<input name="client_name" size="29"  value="<?php echo $entry[0]['client_name']; ?>" type="hidden"/>
<input name="client_information" size="29"  value="<?php echo $entry[0]['client_information']; ?>" type="hidden"/>
<div class="vmkoffice_accounts_button" style="padding-top:8px;">
<input type="submit" value="Save"  class="row">
<input type="reset" value="Cancel"  class="row" />
</div>
</div>
</form>
<?php } else { ?>




<form method="post" action="<?php echo base_url(); ?>index.php/vmk/edit_submit_read_only/<?php echo $entry[0]['id']; ?>" id="validation" >
<div class="vmkoffice_mainone_accounts" id="invoices_left" style="padding-bottom:68px;  padding-left:290px;">
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Clients ID&nbsp;:</b></label>
            </div>
            <div class="vmkoffice_labels_account">


<label><?php echo $entry[0]['client_id']; ?></label>
</div>


</div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Project Id&nbsp;:</b></label>
            </div>
            <div class="vmkoffice_labels_account"> 
 <label><?php echo $entry[0]['id']; ?></label>
</div>
</div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Project Name&nbsp;:</b></label>
            </div>
           <div class="vmkoffice_labels_account">
<label><?php echo $entry[0]['name']; ?></label>
</div>
</div> 

<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Domain Name&nbsp;:</b></label>
            </div>
         <div class="vmkoffice_labels_account"> 
<label><?php echo $entry[0]['domain_name']; ?></label>
</div>
</div> 
<div  style="clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Domain Hosting&nbsp;:</b></label>
            </div>
       <div class="vmkoffice_labels_account"> 
<label><?php echo $entry[0]['domain_hosting']; ?></label>
</div>
</div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Project&nbsp;:</b></label>
            </div>
           <div class="vmkoffice_labels_account">

         <label><?php echo $entry[0]['project_place']; ?></label>
</div>


</div>
 
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Team Leader&nbsp;:</b></label>
            </div>
          <div class="vmkoffice_labels_account">
          <label><?php echo $entry[0]['team_leader']; ?></label>
          

</div>

</div>

 


<div style="clear:both;">           <div class="vmkoffice_labels_account"><label><b>Starting Date&nbsp;:</b></label></div>
         <div class="vmkoffice_labels_account"> 

<label><?php echo $entry[0]['start_date']; ?></label>
</div>
</div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Ending Date&nbsp;:</b></label></div>
         <div class="vmkoffice_labels_account">

<label><?php echo $entry[0]['end_date']; ?></label>
</div>
</div> 
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Cost Of The Project&nbsp;:</b></label>
            </div>
           <div class="vmkoffice_labels_account">
<label><?php echo $entry[0]['cost_of_the_project']; ?></label>
</div>

</div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Project Position&nbsp;:</b></label>
            </div>
   <div class="vmkoffice_labels_account">

<label><?php echo $entry[0]['project_position']; ?></label>
</div>

</div>
<div style="padding-top:6px; clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Domain Hosting Details:</b></label></div>
          <div class="vmkoffice_labels_account">
<label><?php echo $entry[0]['domain_hosting_details']; ?></label>
</div>
</div>
<div style="clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Team Members&nbsp;:</b></label>
            </div>
         <div class="vmkoffice_labels_account">
<label>  <?php echo $entry[0]['team_members']; ?></div>

</div>
<div style="padding-top:6px; clear:both;">
            <div class="vmkoffice_labels_account"><label><b>Project Description&nbsp;:</b></label></div>
            <div class="vmkoffice_inputs_account" style="padding-top:10px;"> 
<textarea cols="29" rows="4" name="desc" class="required" > <?php echo $entry[0]['description']; ?></textarea>
</div>
</div>
<input name="client_name" size="29"  value="<?php echo $entry[0]['client_name']; ?>" type="hidden"/>
<input name="client_information" size="29"  value="<?php echo $entry[0]['client_information']; ?>" type="hidden"/>
<div class="vmkoffice_accounts_button" style="padding-top:8px;">
<input type="submit" value="Save"  class="row">
<input type="reset" value="Cancel"  class="row" />
</div>
</div>
</form>

<?php }?>

</div>
</div>
</div>

       