
<div id="vmkoffice_content">


<h2 style="clear:both;"> NEW EVENT </h2>


<table border="1px" bordercolor="#ddd" cellspacing="0" cellpadding="8" width="95%" id="expensestable">
<tr class="row">

  <th >Event No</th>
  <th >EVENT NAME</th>
   <th >Chair Person</th>  
   <th >EVENT DATE</th>
 <th >Time</th>  
 <th >Priority</th>
 <th >Venue</th>  
 <th >EVENT DESCRIPTION</th>
 <th >COMMENTS</th>
 
  </tr>
<?php foreach($vmk_events as $item):?>
    <tr class="$class">

    <td><a href="<?php echo base_url(); ?>index.php/events/event_atendence/<?php echo $item['event_no']; ?>" class="mouse_over_new"><?php echo $fresh=str_replace('_',' ',$item['event_no']); ?></a></td>
    <td><?php echo $item['event'];?></td>
    <td><?php echo $item['chair_person'];?></td>
    <td><?php echo $item['date'];?></td>
    <td><?php echo $item['time'];?></td>
    <td><?php echo $item['priority'];?></td>
    <td><?php echo $item['venue'];?></td>
    <td><?php echo $item['event_desc'];?></td>
    <td><?php echo $item['comments'];?></td>
    
    
    </tr> 
<?php endforeach ?>
</table>
</div>
</div>
