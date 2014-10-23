<?php

class Vmk extends CI_Controller 
{
  public function __construct()
       {
	        parent::__construct();
			$this->load->model('vmk_model'); //load the model
		    $this->load->helper('url');   //url library helper   
			$this->load->library('session'); //session library
			$this->load->helper('text'); //text libary use like as wordlimetr and etc...
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
		
		
		$data["message"]="* Session Was Destroy ";
		redirect(base_url(),$data);
		
	}
	   
	public function view($page)  //here calling view form 
	{
	
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;

	$username = $this->session->userdata('username'); 
	$data["username"] = $username;
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
	 $collection=json_decode($data['permission'][0]['projects'],TRUE);
	}
	
			if (in_array('add_project',$collection))
			{
	$data['message']='';
	$data['msg']='';
	$data['msg1']='';
	$table='users';
	$names = array('VMK_Employee', 'General_Manager', 'Managing_Director');
	$data['user_name'] = $this->vmk_model->gets($table,$names);
	
	$this->load->view('pages/projects/' .$page, $data); // calling data from form 
	
			}
			else
			{
			
	 $this->load->view('templates/unauthorized'); // calling data from form 
	
			}
			 $this->load->view('templates/footer', $data);
	}
	
	 public function disdata()
	 {
	     $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;  
		 $username = $this->session->userdata('username'); 
	$data["username"] = $username;
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
	 $collection=json_decode($data['permission'][0]['projects'],TRUE);
	}
	
			if (in_array('entry',$collection))
			{
				
	$table='projects';
	if($dept=='Clients')
	{
		$table='users';
		$where=array('username'=>$username);
		$user_ids=$this->vmk_model->get_where_data($table,$where);
		$where=array('client_id'=>$user_ids[0]['user_id']);
		$table='projects';
		 $data['project_information'] = $this->vmk_model->get_where_data_order($table,$where,'sno');
	}
	else{
		$table='projects';
	 $data['project_information'] = $this->vmk_model->get_data_order($table,'sno');
	}
	 
	 $this->load->view('pages/projects/project_list', $data); // calling data from form 

			}
			else
			{
				
	 $this->load->view('templates/unauthorized'); // calling data from form 
	
				
			}
			 $this->load->view('templates/footer', $data);
	 }		
	 	  
 	 public function proins()//new project registration submit
	 {
		 
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;  
		 $username = $this->session->userdata('username'); 
	 $data["username"] = $username;
	    	 
	 $proname = $this->input->post("pname");
	 $dname = $this->input->post("dname"); //here form valuses to userdefined variables
	 $hosting = $this->input->post("hosting");
	 $hosting_details = $this->input->post("hosting_details");
	 $client_id = $this->input->post("clientid");
	 $team_leader = $this->input->post("team_leader");
	
	 if(isset($_POST['team'])) {//check boxes values taken
	$teammember = implode(", ", $_POST['team']);	
} else {
	$teammember = "";
}
	 $sdate = $this->input->post("stdate");
	 $enddate = $this->input->post("edate");
	  $projectfrom = $this->input->post("projectfrom");
	  $cproject = $this->input->post("cproject");
	 $prodesc = $this->input->post("desc");
	 //due to the purpose of client id checking
	  $table='clients';
	  $data=array(
	  'client_user_id'=>$client_id
	  );
	$data['noofrows'] = $this->vmk_model->no_rows($table,$data);//this model checks the given input authorized r not(only calling)
	  if($data['noofrows']==0)//verification not authorizerd
	  {
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;  
		 $username = $this->session->userdata('username'); 
	     $data["username"] = $username;
		 $data['message']='* CLINENT IS NOT EXISTED PLEASE CLICK ME BUTTON AND FILL THE DETAILS ';
		 $data['msg']='';
		 $data['msg1']='';
		 $table='users';
	   $names = array('VMK_Employee', 'General_Manager', 'Managing_Director');
	   $data['user_name'] = $this->vmk_model->gets($table,$names);
		 $this->load->view('templates/header', $data);
	     $this->load->view('pages/projects/add_project',$data); // calling data from form 
	     $this->load->view('templates/footer', $data);
 }
 else //verification authorizerd
 {
	
	//data taken from alredy existed once in client table
	  $table='clients';
	  $where=array('client_user_id'=>$client_id);
	  $client_data=$this->vmk_model->get_where_data($table,$where);
	   $email= $client_data[0]['email'];
	  
	
	  $client_name= $client_data[0]['first_name'];
  $clientinfo= $client_data[0]['address_line1'].' '.$client_data[0]['address_line2'].' '.$client_data[0]['state'].' '.$client_data[0]['city'];  
	//end
	$table='projects';
		          $limit=1;
		             $data['trackno']=$this->vmk_model->no_rows1($table);
		       if($data['trackno']==0)
		             {
			        $project_id= 'VMK'.$projectfrom.'1';
					$sno='1';
		             }
		        else
		             {
						 
		                $intial=$this->vmk_model->last_record_event($table,$limit);
						$sno=$intial[0]['sno']+1;
		             $value=$intial[0]['id'];
				    $values = substr($value,0,6);
					
						$values1=explode($values,$value);
					   
				
					 $id=$values1[1];
		           $new_id=$id+1;
					 $project_id= 'VMK'.$projectfrom.$new_id;
		             }
	

/*$body ='<div style="font-family:"Trebuchet MS",sans-serif,Arial;">'.'<div>Dear Mr/Mrs'.' '.$client_name.'<div style="padding:15px 0;">This is the conformation of your successful registration with VMK software solutions Private Limited for a new project and project Identification number is'.$project_id.'.</div><div>Please verify your details<div>'.
'<div> First name:'.$client_name.'</div>'.
'<div> Last name:'.$client_data[0]['last_name'].'</div>'.
'<div> Company name:vmk'.'</div>'.
'<div> Domain name:'.$dname.'</div>'.
'<div> Project name:'.$proname.'</div>'.
'<div> Contact number:'.$client_data[0]['mobile_number'].'</div>'.'<div style="padding-top:15px;">If you notice any of your given details are wrongly displayed above.Please bring it our attention by contacting us at  Info@vmksoftwaresolutions.com'.'</div><div style="padding-top:20px;"><i>'.'<div>Regards</div>'."<div>".'VMK Management'."</div>".'<div>#8/2/268/1/B/12,</div>'.'<div>Aurora Colony,</div>'.'<div>Banjara Hills,</div>'.'<div>Road No: 3,</div>'.'<div>Hyderabad,</div>'.'<div>Andhra Pradesh,</div>'.'<div>India</div>'.'<div>PIN Code: 500034 </div>'.'<div>Contact Numbers:  +91 40-64644891</div>'.'<div>+91 40-64634891</div>'.'<div>+91 9849674891</div>'.'<div>Email: Info@vmksoftwaresolutions.com</div></div></i></div>';*/
	
$body ='<div style="font-family:"Trebuchet MS",sans-serif,Arial;">'.'<div>Hi,</div><div style="padding:15px 0;">This is the conformation of a successful registration with VMK software solutions Private Limited for a new project and the project Identification number is'.$project_id.'.</div><div>Details are as Below</div>'.
'<div> First name:'.$client_name.'</div>'.
'<div> Last name:'.$client_data[0]['last_name'].'</div>'.
'<div> Domain name:'.$dname.'</div>'.
'<div> Project name:'.$proname.'</div></div>'.
 
  
$mail= $client_data[0]['email'];
$sub='VMK New Project';
/*$this->email->to($mail);*/
$this->email->clear();
$this->email->to('baladarsi1@gmail.com,v.v.kishorechowdary@gmail.com,mangakiran.v@gmail.com,mettukuru.sreekanth@gmail.com');
      $this->email->from('info@vmksoftwaresolutions.com');
    $this->email->subject($sub);
    $this->email->message($body);
    $this->email->send();
	if($projectfrom=='Ind')
	{
		$projectfrom1='India';
	}
	else if($projectfrom=='Aus')
	{
		$projectfrom1='Austraila';
	}
	else if($projectfrom=='USA')
	{
		$projectfrom1='USA';
	}
	$table='projects';
		 $data=array(
		 'sno'=>$sno,
	              'name' => $proname,
	  			  'domain_name' => $dname,
				   'domain_hosting' => $hosting,
				    'domain_hosting_details' => $hosting_details,
				  'client_name' => $client_name,
				  'client_information' => $clientinfo,
				  'team_leader' => $team_leader,
				  'team_members' => $teammember,
				  'start_date' => $sdate,
				  'end_date' => $enddate,
				   'cost_of_the_project' => $cproject,
				  'description' => $prodesc,
				  'id' => $project_id,
				  'client_id' => $client_id,
				  'project_place' => $projectfrom1,
				   'project_position' =>'--'
				  
				  );
				  
 $this->vmk_model->insert_data($table,$data);
	 	$dt = date("Y-m-d");
		$table='calendar';
	$dt_new=explode("-",$dt);
	if($dt_new[2]<10)
	{
	$dt_new1=explode("0",$dt_new[2]);
	$data=array(
	
	  			  'date' => $dt_new[0]."-".$dt_new[1]."-".$dt_new1[1],
				  'data' => $proname,
				  'where' => 'ongoing'
				  
				  );
	}
	else
	{
		
		$data=array(
	
	  			  'date' => $dt,
				  'data' => $proname,
				  'where' => 'ongoing'
				  
				  );
	}
	$this->vmk_model->insert_data($table,$data);
	  

	redirect('/vmk/show_projects_id/'.$project_id, 'refresh');
	 }
}
public function show_projects_id($id,$page="")  //once to genarated project id successfully this is success page 
	{
	
	$projectid1 = str_replace("-","/",$id);
	$projectid = str_replace("%20"," ",$projectid1);
	$dept = $this->session->userdata('usertype');
    $data["usertype"] = $dept;
	$username = $this->session->userdata('username'); 
	$data["username"] = $username;
	$data['msg1']='"Your New Project Is Successfully Registered"'.'<br>'.'The Generated Project Id Is ';	
	$data['msg']='<br>'.'"'.$projectid.'"';	
	
	$table='projects';
	 $where=array('id'=>$projectid);
	  $project_data = $this->vmk_model->get_where_data($table,$where);
	  $data['project_data']=$project_data;
	 
	$this->load->view('templates/header', $data);
	$data['page']=$page;
	$this->load->view('pages/projects/show_projects_id_msg', $data); // calling data from form 
	$this->load->view('templates/footer', $data);
	}

public function edit_project()
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
		$data['projects'] = $this->vmk_model->get_data_limit($table,$limit);
		 $this->load->view('templates/header', $data);
		
	     $this->load->view('pages/projects/all_projects_list', $data);
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
		$data['entry'] = $this->vmk_model->get_where_data($table,$where);
		
     $this->load->view('templates/header', $data);
		$data['read']="write";	
	     $this->load->view('pages/projects/edit_project',$data);
	     $this->load->view('templates/footer', $data);
		}
		
	
	}
	public function edit_project_read_only($id)
	{
		
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		 $username = $this->session->userdata('username'); 
	     $data["username"] = $username;
		 $table='permissions';
	 $where=array('employee_name'=>$username);
	   $this->load->view('templates/header', $data);
	  $data['permission'] = $this->vmk_model->get_where_data($table,$where);
	$noofrows = $this->vmk_model->no_rows($table,$where);
	
	if($noofrows==0)
	{
		$collection=array();
		
	}
	else
	{
	 $collection=json_decode($data['permission'][0]['projects'],TRUE);
	}
	
			if (in_array('edit_project',$collection))
			{	
		$table='projects';
		$where=array('id'=>$id);
		$data['entry'] = $this->vmk_model->get_where_data($table,$where);
	   
		 $data['read']="read_only";
	     $this->load->view('pages/projects/edit_project',$data);
			}
		 else
			{
			
	 $this->load->view('templates/unauthorized'); // calling data from form 
	
			}
	     $this->load->view('templates/footer', $data);
	
	
	}
	
public function edit_submit()
	{
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;  
		 $username = $this->session->userdata('username'); 
	 $data["username"] = $username;
	     $id = $this->input->post("id");	 
	 $proname = $this->input->post("pname");
	 $dname = $this->input->post("dname"); //here form valuses to userdefined variables
	 $client_id = $this->input->post("clientid");
	  $client_name = $this->input->post("client_name");
	   $client_information = $this->input->post("client_information");
	 $team_leader = $this->input->post("team_leader");
	 $teammember = $this->input->post("team");
	 $sdate = $this->input->post("stdate");
	 $enddate = $this->input->post("edate");
	  $projectfrom = $this->input->post("projectfrom");
	  $cproject = $this->input->post("cproject");
	 $prodesc = $this->input->post("desc");
	  $project_pos = $this->input->post("project_pos");
	 
	 //due to the purpose of client id checking
	 $where=array('name'=>$proname);
	 	$table='projects';
		 $data=array(
	              'name' => $proname,
	  			  'domain_name' => $dname,
				  'client_name' => $client_name,
				  'client_information' => $client_information,
				  'team_leader' => $team_leader,
				  'team_members' => $teammember,
				  'start_date' => $sdate,
				  'end_date' => $enddate,
				   'cost_of_the_project' => $cproject,
				  'description' => $prodesc,
				  'id' => $id,
				  'client_id' => $client_id,
				  'project_place' => $projectfrom,
				  'project_position' => $project_pos
				  
				  );
				  
 $this->vmk_model->update_data($table,$data,$where);
	redirect('/projects', 'refresh');
	
	}
	public function edit_submit_read_only($id)
	{
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;  
		 $username = $this->session->userdata('username'); 
	 $prodesc = $this->input->post("desc");
	  $project_pos = $this->input->post("project_pos");
	 
	 //due to the purpose of client id checking
	 $where=array('id'=>$id);
	 	$table='projects';
		 $data=array(
	              
				  'description' => $prodesc,
				
				  'project_position' => $project_pos
				  
				  );
				  
 $this->vmk_model->update_data($table,$data,$where);
	redirect('/projects', 'refresh');
	
	}
	public function search_client_id()//search existing client id
	{
		 $term = $this->input->post('term',TRUE);
		 if (strlen($term) < 1) break;
		 $rows = $this->vmk_model->GetAutocomplete1(array('keyword' => $term));
		 $json_array = array();
		 foreach ($rows as $row)
		 array_push($json_array, $row->client_user_id);
		  echo json_encode($json_array); 
	}
	
	public function search_domain_name()//search existing domain name
	{
		 $term = $this->input->post('term',TRUE);
		 if (strlen($term) < 1) break;
		 $rows = $this->vmk_model->GetAutocomplete_domain_name(array('keyword' => $term));
		 $json_array = array();
		 foreach ($rows as $row)
		 array_push($json_array, $row->main_domain);
		  echo json_encode($json_array); 
	}
	public function search_project_name()//search existing domain name
	{
		 $term = $this->input->post('term',TRUE);
		 if (strlen($term) < 1) break;
		 $rows = $this->vmk_model->GetAutocomplete_project_name(array('keyword' => $term));
		 $json_array = array();
		 foreach ($rows as $row)
		 array_push($json_array, $row->name);
		  echo json_encode($json_array); 
	}
	
}

