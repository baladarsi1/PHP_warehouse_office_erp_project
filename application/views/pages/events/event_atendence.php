<div><h2>Welcome <?php echo $username; ?></h2></div>
<div style="padding:20px 40px 20px 60px;; font-size:13px;">
<div><b>Event Number: </b><?php echo $fresh = str_replace("_"," ",$entry[0]['event_no']); ?></div>
<div><b>Priority Level: </b><label style="color:red; text-decoration:blink;"><?php echo $entry[0]['priority']; ?></label></div>
<div style="padding-top:15px;">You are requested to attend a meeting on <b><?php echo $entry[0]['date']; ?></b> at <b><?php echo $entry[0]['time'] ?></b> in <b><?php echo $entry[0]['venue']; ?></b> branch to deliberate on <b><?php echo $entry[0]['event_desc']; ?></b></div>
<div>The meeting will be chaired by <b><?php echo $entry[0]['chair_person']; ?></b></div>
<div>The agenda for the event is as under <b><?php echo $entry[0]['comments']; ?></b></div>
<div style="padding-top:15px;">In case you are unable to attend the meeting you may intimate the same to <?php echo $entry[0]['chair_person']; ?>
through mail Info@vmksoftwaresolutionscom


<div style="padding-top:15px;"><i>
<div>Regards</div>
<div><?php echo $entry[0]['who_conducting']; ?></div>
<div>#8/2/268/1/B/12,</div>
<div>Aurora Colony,</div>
<div>Banjara Hills,</div>
<div>Road No: 3,</div>
<div>Hyderabad,</div>
<div>Andhra Pradesh,</div>
<div>IndiaPIN Code: 500034 </div>
<div>Contact Numbers:  +91 40-64644891+91 40-64634891+91 9849674891</div>
<div>Email: Info@vmksoftwaresolutionscom</div>
</i></div>
<?php
  if(($entry[0]['are_you_attending'] == "---")){
 ?>

<div>
<h2>Are You Attending</h2>
<div class="new_seel">
<a href="<?php echo base_url(); ?>index.php/events/attendence"><input type="submit" value="YES" class="row"  /></a>
<a href="<?php echo base_url(); ?>index.php/events/attendence"><input type="submit" value="NO" class="row" /></a>
</div>

</div><?php } ?>