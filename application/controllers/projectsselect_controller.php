<?php

class projectsselect_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	
		$this->load->model('vmk_model'); //load the model
		$this->load->helper('url'); //url library helper
		$this->load->library('session'); //session library
		$this->load->library('upload'); //to upload any images to use this library
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
		
		
		$data["message"]="* Session Was Destroy ";
		redirect(base_url(),$data);
		
	}
	public function view($page)
	{
	$dept = $this->session->userdata('usertype');
	$data["usertype"] = $dept;
	$username = $this->session->userdata('username'); 
	$data["username"] = $username;
	
	$this->load->view('templates/header', $data);
	$this->load->view('pages/track/'.$page, $data);
	$this->load->view('templates/footer', $data);

	}
	public function link1($projectid1)
	{
	
	$projectid11 = str_replace("-","/",$projectid1);
	$projectid = str_replace("%20"," ",$projectid11);
	$dept = $this->session->userdata('usertype');
	$data["usertype"] = $dept;
	$data["projectid"] = $projectid;

	$username = $this->session->userdata('username'); 
	$data["username"] = $username;
	$this->load->view('templates/header' , $data);
	$this->load->view('pages/track/track_menu', $data);
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
	 $collection=json_decode($data['permission'][0]['tracking'],TRUE);
	}
	
			if (in_array('assign_task',$collection))
			{
	$table='projects';
	$where=array('id'=>$projectid);
	$projects = $this->vmk_model->get_where_data($table,$where);
	$table='users';
	$names = array('VMK_Employee', 'General_Manager', 'Managing_Director');
	
	$data['emp']=$this->vmk_model->gets($table,$names);
	

	$data['projectname']= $projects[0]['name'];
	
	$this->load->view('pages/track/trackform' , $data);
	}
			else
			{
			 $this->load->view('templates/unauthorized'); 	
			}
	$this->load->view('templates/footer' , $data);
	
	
		}
	
	public function project_form()
	{
		
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		 $username = $this->session->userdata('username'); 
	     $data["username"] = $username;	
		$project_name = $this->input->post("pro");
		$table='projects';
			
		$entry = $this->vmk_model->get_data($table);
	    $project_name1=$entry[0]['name'];
		$table='projects';
		$data = array('name'=>$project_name);
		$data['noofrows'] = $this->vmk_model->no_rows($table,$data);
	   
     if($data['noofrows']==0)//verification authorizerd r not
	 {
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		 $username = $this->session->userdata('username'); 
	     $data["username"] = $username;	
		$data["message"]="* The Project Is not Registered";
		$table='projects';
	    $limit=30;
		$data['projects'] = $this->vmk_model->get_data_limit_order($table,$limit,'sno');
		 $this->load->view('templates/header', $data);
		
	     $this->load->view('pages/track/projectsselectform', $data);
	     $this->load->view('templates/footer', $data);
		
	 }
	 
	    else
		{
			$dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		 $username = $this->session->userdata('username'); 
	     $data["username"] = $username;	
			$table='projects';
		$where=array('name'=>$project_name);
		$entry = $this->vmk_model->get_where_data($table,$where);
	    $project_id=$entry[0]['id'];
		 $table='track';
		$where=array('project_name'=>$project_name);
		$data['entry'] = $this->vmk_model->get_where_data($table,$where);
		$count=count($data['entry']);
		$value=0;
		for($i=0;$i<$count;$i++)
		{
		 $total = $data['entry'][$i]['time'];
		 $value +=$total;
		 
		}
		
		 $data['total1']=$value;
		 $page = "trackbody";
		 $data["projectid"] = $project_id;
		 /*echo $data["pro_id"];*/
		 $this->load->view('templates/header', $data);
		 $this->load->view('pages/track/track_menu', $data);
	     $this->load->view('pages/track/'.$page, $data);
	     $this->load->view('templates/footer', $data);
		
		}
		
	
	}
	
	public function project_view($id)
	{
		$projectid1 = str_replace("-","/",$id);
		$projectid = str_replace("%20"," ",$projectid1);
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		 $username = $this->session->userdata('username'); 
	     $data["username"] = $username;	
		  $data["projectid"] = $projectid;
		
		 $this->load->view('templates/header', $data);
		 $this->load->view('pages/track/track_menu', $data);
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
	 $collection=json_decode($data['permission'][0]['tracking'],TRUE);
	}
	
			if (in_array('view_task',$collection))
			{
		$table='track';
		$where=array('project_id'=>$projectid);
		$data['entry'] = $this->vmk_model->get_where_data($table,$where);
		$count=count($data['entry']);
		$value=0;
		for($i=0;$i<$count;$i++)
		{
		 $total = $data['entry'][$i]['time'];
		 $value +=$total;
		 
		}
		
		 $data['total1']=$value;
		 $page = "trackbody";
		
	     $this->load->view('pages/track/'.$page, $data);
		 }
			else
			{
			 $this->load->view('templates/unauthorized'); 	
			}
	     $this->load->view('templates/footer', $data);
		
	}
	public function project_form1($projectid1)
	{
	    $project_id11 = str_replace("-","/",$projectid1);
		 $project_id = str_replace("%20"," ",$project_id11);
		$table='track';
		$where=array('project_id'=>$project_id);
		$data['entry'] = $this->vmk_model->get_where_data($table,$where);
		$count=count($data['entry']);
		$value=0;
		for($i=0;$i<$count;$i++)
		{
		 $total = $data['entry'][$i]['time'];
		 $value +=$total;
		 
		}
		
		 $data['total1']=$value;
		 $page = "trackbody";
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		 $username = $this->session->userdata('username'); 
	     $data["username"] = $username;
		 $data["projectid"] = $project_id;
		 /*echo $data["pro_id"];*/
		 $this->load->view('templates/header', $data);
		 $this->load->view('pages/track/track_menu', $data);
	     $this->load->view('pages/track/'.$page, $data);
	     $this->load->view('templates/footer', $data);
	}
	public function project_retrive()
	{ 
	$username = $this->session->userdata('username'); 
	 $data["username"] = $username;
	 
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		  $this->load->view('templates/header', $data);
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
	 $collection=json_decode($data['permission'][0]['tracking'],TRUE);
	}
	
			if (in_array('entry',$collection))
			{
		
	 $page = "projectsselectform";
	 $table='projects';
	 $limit=30;
	if($dept=='Clients')
		 {  
		
		 $where=array('client_id'=>$username);
	    $data['projects'] = $this->vmk_model->get_data_limit1($table,$where,$limit);
		$data['entry'] = $this->vmk_model->get_where_data($table,$where);
		 
		 }
		 else
		 {
		
		$data['projects'] = $this->vmk_model->get_data_limit_order($table,$limit,'sno');
		
		
		 }
	
	$data["message"]="";
	 $this->load->view('pages/track/'.$page, $data);
	
			}
			else
			{
				 $this->load->view('templates/unauthorized'); 	
			}
			 $this->load->view('templates/footer', $data);
	}
	public function form_link()
	{
		$projid1 = $this->input->post("projid");
		$projname1 = $this->input->post("projname");
		$projat1 = $this->input->post("projat");
		$projsht1 = $this->input->post("projsht");
		$currentdate1 = $this->input->post("currentdate");
		$edate = $this->input->post("edate");
		$etime = $this->input->post("etime");
		$etime_in = $this->input->post("etime_in");
		$utask = $this->input->post("utask");
		$task_name = $this->input->post("task_name");
		$comments1 = $this->input->post("comments");
		
	 $config['upload_path']   = './tasks';
      $config['allowed_types'] = 'gif|JPEG|jpg|png|xls|xlsx|php|pdf|html|php';
      $config['max_size']   = '4000'; 
      $config['encrypt_name']  = TRUE;
      $this->upload->initialize($config);
      $uploaded = $this->upload->up(TRUE);   
 
      $count = 0;
    
      $image=$uploaded['success'][0]['file_name'];
     
	
		$table='track';
		$limit=1;
		$where=array('project_id'=>$projid1);
		$data['trackno']=$this->vmk_model->no_rows($table,$where);
		if($data['trackno']==0)
		{
			$task_id='TASK-'.$projid1.'-'.'1';
		}
		else
		{
		$intial=$this->vmk_model->last_record($table,$where,$limit);
		$value=trim($intial[0]['task_id']);
		$new_value=explode("-",$value);
		$id=$new_value[2];
		$j=$id+1;
		$task_id='TASK-'.$projid1.'-'.$j;
		}
	$data=array(
		
		'project_id'=>$projid1,
		'project_name'=>$projname1,
		'project_assign_to'=>$projat1,
		'project_shifted_to'=>$projsht1,
		'date'=>$currentdate1,
		
		'estimated_finishing_date'=>$edate,
		'estimated_finishing_time'=>$etime.' '.$etime_in,
		'urgency_of_task'=>$utask,
		'task_name'=>$task_name, 
		'comments'=>$comments1,
		'task_id'=>$task_id,
		'status'=>'---',
		'time'=>'0',
		'time_in'=>'hours',
		'department'=> '---',
		'track_files'=> $image
		);

		$data['pass'] = $this->vmk_model->insert_data($table,$data);
	redirect('/projectsselect_controller/project_form_submit/'.$projname1, 'refresh');
	}
	public function project_form_submit($project_name1)
	{
	     $project_name = str_replace("%20"," ",$project_name1);
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		 $username = $this->session->userdata('username'); 
	     $data["username"] = $username;	
	
		$table='projects';
		$where=array('name'=>$project_name);
		$entry = $this->vmk_model->get_where_data($table,$where);
	    $project_id=$entry[0]['id'];
	    $username = $this->session->userdata('username'); 
		$table='track';
		$where=array('project_name'=>$project_name);
		$data['entry'] = $this->vmk_model->get_where_data($table,$where);
		$count=count($data['entry']);
		$value=0;
		for($i=0;$i<$count;$i++)
		{
		 $total = $data['entry'][$i]['time'];
		 $value +=$total;
		 
		}
		
		 $data['total1']=$value;
		 $page = "trackbody";
		 $data["projectid"] = $project_id;
		 /*echo $data["pro_id"];*/
		 $this->load->view('templates/header', $data);
		 $this->load->view('pages/track/track_menu', $data);
	     $this->load->view('pages/track/'.$page, $data);
	     $this->load->view('templates/footer', $data);
	
	}
	public function my_track($page) {
		
		$username = $this->session->userdata('username');
		$dept = $this->session->userdata('usertype');
		$where = array('project_shifted_to' => $username);
		$data["username"] = $username;
		$data["usertype"] = $dept;
		$table='track';
		$data['entry'] = $this->vmk_model->get_where_data($table,$where);
		//print_r($data['entry']);
		$this->load->view('templates/header', $data);
		$this->load->view('pages/track/track_menu', $data);
	    $this->load->view('pages/track/'.$page, $data);
	    $this->load->view('templates/footer', $data);
	}
	
	//modifications
	public function add_modifications($projectid1)
	{
		
		
	$projectid11 = str_replace("-","/",$projectid1);
	$projectid = str_replace("%20"," ",$projectid11);
	$dept = $this->session->userdata('usertype');
	$data["usertype"] = $dept;
	$data["projectid"] = $projectid;
	$username = $this->session->userdata('username'); 
	$data["username"] = $username;
	$this->load->view('templates/header' , $data);
	$this->load->view('pages/track/track_menu', $data);
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
	 $collection=json_decode($data['permission'][0]['tracking'],TRUE);
	}
	
			if (in_array('add_modifications',$collection))
			{
	$table='projects';
	$where=array('id'=>$projectid);
	$projects = $this->vmk_model->get_where_data($table,$where);
	$data['project_id']= $projects[0]['id'];
	$data['project_name']= $projects[0]['name'];
	
	$this->load->view('pages/track/add_modifications' , $data);
	}
			else
			{
			 $this->load->view('templates/unauthorized'); 	
			}
	$this->load->view('templates/footer' , $data);
	
	
		}
	
	public function add_modifications_submit() {
		$dept = $this->session->userdata('usertype');
	    $data["usertype"] = $dept;
	   $username = $this->session->userdata('username'); 
	   $data["username"] = $username;
	   $project_id=$this->input->post('project_id');
	    $project_name=$this->input->post('project_name');
		$client_name=$this->input->post('client_name');
	   $data['projectid']=$project_id;
	    $date=$this->input->post('date');
		 $edate=$this->input->post('edate');
		 $etime=$this->input->post('etime');
		 $etime_in=$this->input->post('etime_in');
		$umod=$this->input->post('umod');
		$mod_name=$this->input->post('mod_name');
		
		$mod_desc=$this->input->post('mod_desc');
		$Ecost=$this->input->post('Ecost');
		
		 $config['upload_path']   = './modifications';
      $config['allowed_types'] = 'gif|JPEG|jpg|png|xls|xlsx|php|pdf|html|php';
      $config['max_size']   = '4000'; 
      $config['encrypt_name']  = TRUE;
      $this->upload->initialize($config);
      $uploaded = $this->upload->up(TRUE);   
  
      $count = 0;
    
      $image=$uploaded['success'][0]['file_name'];
		$table='modifications';
		$data=array(
		'project_id'=>$project_id,
		'project_name'=>$project_name,
		'client_name'=>$client_name,
		'estimated_finishing_date'=>$edate,
		'estimated_finishing_time'=>$etime.' '.$etime_in,
		'urgency_of_modification'=>$umod, 	
		'modifiction_name'=>$mod_name,
		'date'=>$date,
		'mod_desc'=>$mod_desc,
		'mod_files'=>$image,
		'estimated_cost_of_the_modification'=>$Ecost
		);
		$this->vmk_model->insert_data($table,$data);
		
		$pro_id1 = str_replace("/","-",$project_id);
		
		redirect('/projectsselect_controller/view_modifications/'.$pro_id1 , 'refresh');
	 
	}
	public function view_modifications($projectid1) {
		$data['projectid']=$projectid1;
		
	$projectid11 = str_replace("-","/",$projectid1);
	$projectid = str_replace("%20"," ",$projectid11);
	
		$dept = $this->session->userdata('usertype');
	    $data["usertype"] = $dept;
	   $username = $this->session->userdata('username'); 
	   $data["username"] = $username;
	   $this->load->view('templates/header', $data);
		$this->load->view('pages/track/track_menu', $data);
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
	 $collection=json_decode($data['permission'][0]['tracking'],TRUE);
	}
	
			if (in_array('view_modifications',$collection))
			{
	   $table='modifications';
	  $where=array('project_id'=>$projectid);
	 $data['modifications']=$this->vmk_model->get_where_data($table,$where);
	 $table='track';
	 $data['noofrows'] = $this->vmk_model->no_rows($table,$where);//no tasks means no modifications occured in our project
		
	    $this->load->view('pages/track/view_modifications',$data);
		}
			else
			{
			 $this->load->view('templates/unauthorized'); 	
			}
	    $this->load->view('templates/footer', $data);
	}
	public function finished($id,$project_name1) {
		
		$project_name = str_replace("%20"," ",$project_name1);
		$username = $this->session->userdata('username');
		$dept = $this->session->userdata('usertype');
		$where = array('project_shifted_to' => $username);
		$data["username"] = $username;
		$data["usertype"] = $dept;
	    $data['task_id']=$id;
		$data['project_name']=$project_name;
		$table='track';
			$where=array('project_name'=>$project_name);
		$entry = $this->vmk_model->get_where_data($table,$where);
	    $project_id=$entry[0]['project_id'];
	    $data["projectid"] = $project_id;
		$this->load->view('templates/header', $data);
		$this->load->view('pages/track/track_menu', $data);
	    $this->load->view('pages/track/finished', $data);
	    $this->load->view('templates/footer', $data);
	}
	public function finished_submit() {
		
	
		$status = $this->input->post("status");
		$time = $this->input->post("time");
		$time_in = $this->input->post("time_in");
		$dep1 = $this->input->post("dep1");
		$task_id = $this->input->post("task_id");
		$project_name = $this->input->post("project_name");
		 $table='track';
	    $where=array('task_id'=>$task_id);
		$entry = $this->vmk_model->get_where_data($table,$where);
	    $time1=$entry[0]['time'];
	    $time_new = $time+$time1;
		$data=array(
		'status'=>$status,
		'time'=>$time_new,
		'time_in'=>$time_in,
		'department'=>$dep1
		
		);
	
		$where=array('task_id'=>$task_id);
		$this->vmk_model->update_data($table,$data,$where);
		redirect('/projectsselect_controller/finished_submit_view/'.$project_name,'referesh');
		
	}
	public function finished_submit_view($project_name1)
	{
	     $project_name = str_replace("%20"," ",$project_name1);
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		 $username = $this->session->userdata('username'); 
	     $data["username"] = $username;	
	
		$table='projects';
		$where=array('name'=>$project_name);
		$entry = $this->vmk_model->get_where_data($table,$where);
	    $project_id=$entry[0]['id'];
	    $username = $this->session->userdata('username'); 
		$table='track';
		$where=array('project_name'=>$project_name);
		$data['entry'] = $this->vmk_model->get_where_data($table,$where);
		$count=count($data['entry']);
		$value=0;
		for($i=0;$i<$count;$i++)
		{
		 $total = $data['entry'][$i]['time'];
		 $value +=$total;
		 
		}
		
		 $data['total1']=$value;
		 $page = "trackbody";
		 $data["projectid"] = $project_id;
		 /*echo $data["pro_id"];*/
		 $this->load->view('templates/header', $data);
		 $this->load->view('pages/track/track_menu', $data);
	     $this->load->view('pages/track/'.$page, $data);
	     $this->load->view('templates/footer', $data);
	
	}
}
