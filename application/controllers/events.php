<?php
class events extends CI_Controller 
{
	public function __construct()
    	{
	        parent::__construct();
		
			$this->load->model('vmk_model');   //load the model
		    $this->load->helper('url');   //url library helper
			$this->load->library('session'); //session library
		     $this->load->library('email');
			 $dept = $this->session->userdata('usertype');
		$username = $this->session->userdata('username');
		$this->username = $username;
		$this->dept = $dept;
			 if($username == NULL)
  {
   $this->sessionExpires();
  }
        }
		public function sessionExpires()
	{
		
		$this->session->sess_destroy();
		$data["message"]="* Session Was Destroy ";
		redirect(base_url(),$data);
		
	}
	public function view($page = 'form')  //here calling view form 
		{
	
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		  $username = $this->session->userdata('username'); 
		 $data["username"] = $username;
	
	$this->load->view('templates/header', $data);
	$this->load->view('pages/events/events_menu', $data);
	 $table='permissions';
	 $where=array('employee_name'=>$username);
	 
	  $data['permission'] = $this->vmk_model->get_where_data($table,$where);
	$noofrows = $this->vmk_model->no_rows($table,$where);
	
	if($noofrows==0)
	{
		$collection=array();
		
	}
	else
	{
	 $collection=json_decode($data['permission'][0]['events'],TRUE);
	}
	
			if (in_array('add_event',$collection))
			{

	$this->load->view('pages/events/'.$page, $data); // calling data from form
			}
			else
			{
				 $this->load->view('templates/unauthorized'); 	
			}
	$this->load->view('templates/footer', $data);
		}
public function event_atendence($event_no='event')  //here calling view form 
		{
	
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		  $username = $this->session->userdata('username'); 
		 $data["username"] = $username;
	
	$this->load->view('templates/header', $data);
	$this->load->view('pages/events/events_menu', $data);
	$table='events';
	$where=array('event_no'=>$event_no);
	$data['entry'] = $this->vmk_model->get_where_data($table,$where);
	$this->load->view('pages/events/event_atendence', $data); // calling data from form
	$this->load->view('templates/footer', $data);
		}
	public function disdata()
		{
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		 $username = $this->session->userdata('username'); 
		 $data["username"] = $username;
		
	 $this->load->view('templates/header', $data);
	 $this->load->view('pages/events/events_menu', $data);
	 $table='permissions';
	 $where=array('employee_name'=>$username);
	 
	  $data['permission'] = $this->vmk_model->get_where_data($table,$where);
	$noofrows = $this->vmk_model->no_rows($table,$where);
	
	if($noofrows==0)
	{
		$collection=array();
		
	}
	else
	{
	 $collection=json_decode($data['permission'][0]['events'],TRUE);
	}
	
			if (in_array('entry',$collection))
			{
				 $table='events';
		 $data['vmk_events'] = $this->vmk_model->get_data_order($table,'sno');
				
	 $this->load->view('pages/events/disevent', $data); // calling data from form 
			}
			else
			{
			 $this->load->view('templates/unauthorized'); 	
			}
	 $this->load->view('templates/footer', $data);
	 	}
		public function attendence()
		{
			$table='events';
	 $data=array(
	 
				  'are_you_attending'=>'test'
				  );
	//print_r($data);
	$this->vmk_model->update_data1($table,$data);
		redirect('/events', 'refresh');
	 	}
	public function addevent()
		{ 
		
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		  $username = $this->session->userdata('username'); 
		 $data["username"] = $username;     	 
	 $event = $this->input->post("event"); //here form valuses to userdefined variables
	 $desc = $this->input->post("event_desc");
	 $dt = $this->input->post("start");
	 $dt1 = $this->input->post("start1");
	 $etime_in = $this->input->post("etime_in");
	  $chair = $this->input->post("chair");	
	 $priority = $this->input->post("priority");
	  $venue = $this->input->post("venue");	
	 $comm = $this->input->post("com");
	 
	
	 $table='events';
		$limit=1;
	
		$data['trackno']=$this->vmk_model->no_rows1($table);
		if($data['trackno']==0)
		{
			$event_id='Event_1';
		}
		else
		{
		$intial=$this->vmk_model->last_record_event($table,$limit);
		$value=trim($intial[0]['event_no']);
		$new_value=explode("_",$value);
		$id=$new_value[1];
		$j=$id+1;
		$event_id='Event_'.$j;
		}
$table='addnewemployee';
$body ='<div style="font-family:"Trebuchet MS",sans-serif,Arial;"><div>'.'<b>Event Number:</b>'.$event_id.'</div><div><b>Priority Level</b>:'.$priority.'</div><div style="padding-top:17px;">You are requested to attend a meeting on'.' '.'<b>'.$dt.'</b>'.' '.'at'.' '.'<b>'.$dt1.' '.$etime_in.'</b>'.' '.'in'.' '.'<b>'.$venue.'</b>'.' '.'branch'.' '.'to deliberate on'.' '.'<b>'.$desc.'</b>'."</div>".'<div>The meeting will be chaired by'.' '.'<b>'.$chair.'</b>'."</div>".'<div>The agenda for the event is as under'."</div><div>".$comm."</div>".'<div style="padding-top:17px;">In case you are unable to attend the meeting you may intimate the same to'.' '.$chair.' '.'through mail Info@vmksoftwaresolutions.com'.'.'.'</div><div style="padding-top:20px;"><i>'.'<div>Regards</div>'."<div>".$username."</div>".'<div>#8/2/268/1/B/12,</div>'.'<div>Aurora Colony,</div>'.'<div>Banjara Hills,</div>'.'<div>Road No: 3,</div>'.'<div>Hyderabad,</div>'.'<div>Andhra Pradesh,</div>'.'<div>India</div>'.'<div>PIN Code: 500034 </div>'.'<div>Contact Numbers:  +91 40-64644891</div>'.'<div>+91 40-64634891</div>'.'<div>+91 9849674891</div>'.'<div>Email: Info@vmksoftwaresolutions.com</div></div></i></div>';


 
    $this->email->clear();
	
 $data['entry'] = $this->vmk_model->get_data($table);
 $count=count($data['entry']);
 $all=array();
 for($i=0;$i<$count;$i++)
 {
	$all_mails= $data['entry'][$i]['Email_id'];
	array_push($all,$all_mails);
	
 }
$all_mails = implode(",", $all);
$list = array($all_mails);

$sub="Event on"." ".$dt." "."at"." ".$dt1." ".$etime_in." "."to deliberate on"." ".$event;
$this->email->to($list);
 
    $this->email->from('info@vmksoftwaresolutions.com');
    $this->email->subject($sub);
    $this->email->message($body);
    $this->email->send();

 $table='events';
	 $data=array(
	 'event' => $event,
	 			 'event_desc' => $desc,
	  			  'date' => $dt,
				  'time' => $dt1." ".$etime_in,
				  'comments' => $comm,
				  'priority' => $priority,
				  'venue' => $venue,
				  'chair_person' => $chair,
				  'event_no' => $event_id,
				  'who_conducting'=>$username,
				  'are_you_attending'=>'---'
				  );
	//print_r($data);
	$this->vmk_model->insert_data($table,$data);//insert user defined data into table
	$table='calendar';
	$dt_new=explode("-",$dt);
	if($dt_new[2]<10)
	{
	$dt_new1=explode("0",$dt_new[2]);
	$data=array(
	
	  			  'date' => $dt_new[0]."-".$dt_new[1]."-".$dt_new1[1],
				  'data' => $event,
				  'where'=>'events'
				  
				  );
	}
	else
	{
		
		$data=array(
	
	  			  'date' => $dt,
				  'data' => $event,
				   'where' =>'events'
				  );
	}
	
	//print_r($data);
	$this->vmk_model->insert_data($table,$data);//insert user defined data into table
	redirect('/events', 'refresh');
		}
}
