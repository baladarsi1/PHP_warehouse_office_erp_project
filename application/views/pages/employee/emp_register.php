        <style>
        #welnote{ text-align:center; margin-bottom:10px;}
		.link{    margin-left: 400px;margin-right: 14px;margin-top: 10px;padding: 5px 19px;}
		.main_content #cke_editor1{ width:auto !important; margin:0 !important;}
         .special_para p{
    line-height: 30px;
    margin: 0;
    max-width: 184px; overflow:hidden;
   }
   </style> 
<div id="content">

<?php if($view_message == 0) {
	      $dis_id = "e_register";
		  $dis_msg = "You haven't put your intime today";
		  $dis_but_msg = "Session Start";
      }
	  else { ?>
		 <div style="float: left; padding-top:10px;"> <div class="link" style="   border-radius: 3px 0 0 3px;
    float: left;
    margin-left: 45px;
    margin-right: 0;">Session Start</div><div style="   border: 1px solid #DDDDDD !important;
    float: left;

    margin-top: 10px;
    padding: 3px 10px;"><?php echo $session[0]['session_start']; ?></div>
          </div>
          <div style="float: right; padding-right:20px; padding-top:10px;"> <div class="link" style="   border-radius: 3px 0 0 3px;
    float: left;
    margin-left: 45px;
    margin-right: 0;">Session End</div><div style="   border: 1px solid #DDDDDD !important;
    float: left;

    margin-top: 10px;
    padding: 3px 10px;"><?php echo $session[0]['session_end']; ?></div>
          </div>
          
          <?php 
		  
		  foreach($get_data as $current) {
			  $close_time = $current['session_end'];
			  $count = substr_count($close_time, 0);
			  if($count == 6) {
				  echo '<div style="clear:both;">';
				   $dis_id = "e_closing";
		           $dis_msg = "Please close your session for today";
				   $dis_but_msg = "Session End";
				   echo '</div>';
			  }
			  else {?>
              
               <div style="clear:both;"><?php
		  
				   $dis_id = "e_closed";
		           $dis_msg = "Thank you. you are successfully closed your session for today.";
				   
				    echo '</div>';
				   
                  
                  
				   
			  }
			  
		  }
		 
	  }
?>
<div class="main_content">
       <h2><?php echo $dis_msg ?></h2>
       <?php if($dis_id != "e_closed") { ?>
         <form method="post" action="<?php echo base_url(); ?>index.php/employees/update_reg/<?php echo $dis_id; ?>" />
             <p id="welnote">Welcome Mr/Mrs. <?php echo ucfirst($username); ?>. Please enter the comments what you are going to do today</p>
              <!--<div style="width:850px; margin:auto;">  <textarea cols="29" rows="4" name="desc" id="editor1"></textarea></div>-->
     <input type="hidden" name="user_ids" value="<?php echo $entry; ?>" />
                <input type="submit"  style="color:#FFF" id="register"  class="link" value="<?php echo $dis_but_msg; ?>" />
          </form>
       <?php } ?> 
</div>
<div class="main_sub_1"  style="padding:30px 0;">
      <table border="1px" bordercolor="#ddd " cellspacing="0" cellpadding="8" width="95%" id="expensestable">
<tr class="row">

   <th>Date & Time</th>
  <th>Project Id & Title</th>
  <th>Subject</th>
  <th>Status</th>
  <th >Task Strat Time</th>
  <th>Task End Time</th>
   <th>Description</th>
  <th>Remarks</th>
</tr>
<?php foreach($emp_com_reg as $item){ ?>
    
    <?php if($item['work_update']=='no') { ?>
    
    <tr>
    <td style="border:none;" colspan="8"><span style="font-size:16px;"><span><?php echo 'Session Start: '.$item['e_date'].' & '.$item['session_start']; ?></span><span style=" float:right;"><?php echo 'Session Start: '.$item['e_date'].' & '.$item['session_end']; ?></span></span></td>
    </tr>
   <?php }?>
    <?php if($item['work_update']=='yes') { ?>
    <tr>
    <td><?php echo $item['e_date'];?></td>
    <td><?php echo $item['project_info'];?></td>
    <td><?php echo $item['subject'];?></td>
    <td><?php echo $item['status'];?></td>
    <td><?php echo $item['task_start'];?></td>
    <td><?php echo $item['task_end'];?></td>
    <td  class="special_para"><?php echo $item['description'];?></td>
    <td><?php echo $item['remarks'];?></td>
    
    </tr>
    <?php }?>
<?php } ?>
</table>
</div>
<div class="vmkoffice_mainone_accounts" style="padding-bottom:19px; padding-right:13px; float:right;"><a href="<?php echo base_url(); ?>index.php/employees/leaves_apply/<?php echo $entry ;?>" class="link">Apply Leave</a></div>
<div class="leaves_concept" style="clear:both;">
 <!--<table border="1px" bordercolor="#469663" cellspacing="0" cellpadding="8" width="95%" id="expensestable">
 <tr>
<th></th>
<th></th>
<th></th>
<th>Number Of Days</th>
<th>This year Total</th>
<th>Annual Remaining</th>
</tr>
<tr>
<th>Annual Leave</th>
<?php if($no_rows==0) { ?>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<?php } else { ?>

<td><?php echo $leaves_emp_id_data[0]['from_date']; ?></td>
<td><?php echo $leaves_emp_id_data[0]['to_date']; ?></td>
<td>
<?php
$date1=strtotime($leaves_emp_id_data[0]['to_date']);
$date2=strtotime($leaves_emp_id_data[0]['from_date']);
$diff=$date1-$date2; 

$diff1=floor($diff/3600/24);
echo $diff1; ?>
</td>

<td><?php echo $entry1[0]['Annual_leaves']; ?></td>
<td><?php echo $entry1[0]['Annual_leaves']-$diff1; ?></td>
<?php } ?>
</tr>
<tr>
<th>Sick Leave</th>
<?php if($no_rows1==0) { ?>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<?php } else { ?>
<td><?php echo $leaves_emp_id_data1[0]['from_date']; ?></td>
<td><?php echo $leaves_emp_id_data1[0]['to_date']; ?></td>
<td>
<?php
$date1=strtotime($leaves_emp_id_data1[0]['to_date']);
$date2=strtotime($leaves_emp_id_data1[0]['from_date']);
$diff=$date1-$date2; 

$diff1=floor($diff/3600/24);
echo $diff1; ?>
</td>
<td><?php echo $entry1[0]['Sick_leaves']; ?></td>
<td><?php echo $entry1[0]['Sick_leaves']-$diff1; ?></td>
<?php } ?>
</tr>
<tr>
<th>Public Holidays</th>
<?php if($no_rows2==0) { ?>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<?php } else { ?>
<td><?php echo $holiday[0]['date'] ?></td>
<td><?php echo $holiday[0]['holiday_name'] ?></td>
<td><?php echo $holiday[0]['no_of_days'] ?></td>
<td></td>
<td></td>
<?php } ?>
</tr>
</table>-->

<div><?php echo $calendar; ?></div>
</div>
</div>
</div>

