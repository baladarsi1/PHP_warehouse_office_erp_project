
<div style="clear:both;">
      <form action="<?php echo base_url(); ?>index.php/projectsselect_controller/finished_submit" method="post" id="validation" >
       <div style="width:368px; padding:10px; margin:auto;">
       <h2 style="margin-top:0; margin-left:92px;">STATUS</h2>
      <div>
     <div class="vmkoffice_labels_account" style="width:116px;"><label>Status:</label>
     </div>
     <div class="vmkoffice_inputs_account" style="width:172px; margin-top:17px;">
      <select name="status" class="required">
      <option value="">--status--</option>
      <option value="Pending">Started</option>
      <option value="Pending">Ongoing</option>
      <option value="Finished">Finished</option>
      
      </select></div>
      </div>
      <div style="clear:both;">
            <div class="vmkoffice_labels_account" style="width:116px;"><label>Department:</label></div>
            <div class="vmkoffice_inputs_account" style="width:172px; margin-top:17px;"> 
            <select name="dep1" class="required">
            <option></option>
            <option>Server</option>
            <option>Analysis</option>
            <option>Designing</option>
            <option>Css</option>
            <option>Coding</option>
            <option>Implementation</option>
            <option>Testing</option>
            </select>
            </div>
            </div>
            <div style="clear:both;">
            <div class="vmkoffice_labels_account" style="width:116px;"><label>Time:</label></div>
            <div class="vmkoffice_inputs_account" style="width:247px; margin-top:17px;"> <input type="text" name="time" class="required"  style="width:132px;"  /> <select name="time_in" class="required" style="width:94px;">
            <option></option>
            <option>hours</option>
            
            
            </select></div>
            </div>
            
            <input type="hidden" name="task_id" value="<?php echo $task_id; ?>"  />
             <input type="hidden" name="project_name" value="<?php echo $project_name; ?>"  />
      <div class="vmkoffice_accounts_button" style="padding-bottom:20px; text-align:center; padding-left:107px;">
          <input type="submit" value="Submit"  class="row">
<input type="reset" value="Cancel"  class="row" id="btnClose" />
</div>
</div>
</form>
       </div>
       </div>