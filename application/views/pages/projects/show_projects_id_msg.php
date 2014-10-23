
<div style="padding-bottom:20px;" >
<?php if($page=='view') {?>
<div style="clear:both; text-align:center; padding:20px;"><input type="button" id="print" class="row" value="Print View" /></div>
<h2>View</h2>
<div id="printable" style="clear:both;">
<div class="vmkoffice_mainone_accounts" id="invoices_left" style="padding-bottom:68px;  padding-left:290px;">
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Project Name</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['name']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Domain Name</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['domain_name']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Domain Hosting Details</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['domain_hosting_details']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Team Leader</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['team_leader']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Team Members</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['team_members']; ?></label>
        </div>
        </div>
       <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Starting Date</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['start_date']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Estimated Finishing Date</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['end_date']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Descripition</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['description']; ?></label>
        </div>
        </div>
                </div> </div>
<?php } else {?>
<span style="color:#469663; line-height:30px;"><?php echo $msg1; ?>
<span style=" font-weight:bold;"><?php echo $msg; ?></span></span>
</div>
<h2>SUMMERY</h2>

	<div class="vmkoffice_mainone_accounts" id="invoices_left" style="padding-bottom:68px;  padding-left:290px;">
    <div>
        <div class="vmkoffice_labels_account"><label><b>The New Project ID Is</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['id']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Project Name</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['name']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Domain Name</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['domain_name']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Domain Hosting</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['domain_hosting']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Client ID</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['client_id']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Team Leader</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['team_leader']; ?></label>
        </div>
        </div>
        <div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Team Members</b></label> </div>
       <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['team_members']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Starting Date</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['start_date']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Estimated Finishing Date</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['end_date']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Domain Hosting Details</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['domain_hosting_details']; ?></label>
        </div>
        </div>
<div style="clear:both;">
        <div class="vmkoffice_labels_account"><label><b>Descripition</b></label> </div>
        <div class="vmkoffice_labels_account"><label><?php echo $project_data[0]['description']; ?></label>
        </div>
        </div>
</div>
<?php }?>
</div>