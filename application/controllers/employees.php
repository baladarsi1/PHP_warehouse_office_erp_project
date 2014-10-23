<?php
class employees extends CI_Controller {

    public function __construct()
	{
		
		parent::__construct();
		$this->load->model('vmk_model'); //load the model
		$this->load->helper('url'); //url library helper
		$this->load->library('session'); //session library
		$this->load->library('upload'); //to upload any images to use this library
		 $this->load->library('email');
		 $this->load->library('form_validation');
		$dept = $this->session->userdata('usertype');
		$username = $this->session->userdata('username');
		$this->username = $username;
		$this->dept = $dept;
		$this->data = array("username" =>$this->username,
							"usertype" => $this->dept,
							"submenu" => $this->submenu_html(),
							"submenu1" => $this->submenu_html1(),
	
	);

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
	   
	
	public function view($page = 'selfemployee')
		{
	
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		  $username = $this->session->userdata('username'); 
		 $data["username"] = $username;
		 
	 $data["submenu"] = $this->submenu_html();
	$table='addnewemployee';
	$data['employees'] = $this->vmk_model->get_data($table);
	$this->load->view('templates/header', $data);
	$this->load->view('pages/employee/'.$page, $data);
	$this->load->view('templates/footer', $data);
    
	}
	public function view1($page)
		{
	
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		  $username = $this->session->userdata('username'); 
		 $data["username"] = $username;
		 
	 $data["submenu"] = $this->submenu_html();
	$table='projects';
	$data['projects'] = $this->vmk_model->get_data($table);
	$this->load->view('templates/header', $data);
	$this->load->view('pages/employee/'.$page, $data);
	$this->load->view('templates/footer', $data);
    
	}
	public function index()
	{
		
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;  
		 $username = $this->session->userdata('username'); 
	$data["username"] = $username;
	$table='addnewemployee';
	$data['employees'] = $this->vmk_model->get_data($table);
		$this->load->view('templates/header', $data);
		$this->load->view('news/index', $data);//employee folder in views
		$this->load->view('templates/footer');
	}
	public function link()
	{
		
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;  
		 $username = $this->session->userdata('username'); 
	     $data["username"] = $username;
		 $data["submenu1"] = $this->submenu_html1();
	     $this->load->view('templates/header', $data);
		$this->load->view('pages/employee/addnewemp', $data);//employee folder in views
		$this->load->view('templates/footer', $data);
		
		
	}
	public function selfemplink()//which employee login to see those details
	{
		
		 $dept = $this->session->userdata('usertype');
		   $data["usertype"] = $dept;
		    $username = $this->session->userdata('username'); 
		 $data["username"] = $username;
		 $data["submenu"] = $this->submenu_html();
		 $data['home']='home';
		 $data['msg0']='';
		$data['msg1']='';
		$data['edit']='';
		$data['msg']='';
		 $table='users';
		 $where = array('username'=>$username);
		 $user_id = $this->vmk_model->get_where_data($table,$where);
		 $emp_id = $user_id[0]['user_id'];
		 $table='addnewemployee';
		  $where = array('Employee_id'=>$emp_id);
	$data['noofrows'] = $this->vmk_model->no_rows($table,$where);//this model checks the given input authorized r not(only calling)
	   
	   $data['entry'] = $this->vmk_model->get_where_data($table,$where);
       $this->load->view('templates/header', $data);
		$this->load->view('pages/employee/self_employee', $data);//employee folder in views
		$this->load->view('templates/footer');
	}
	public function selfemplink_redirect()
	{
		
		 $dept = $this->session->userdata('usertype');
		   $data["usertype"] = $dept;
		    $username = $this->session->userdata('username'); 
		 $data["username"] = $username;
		  $data["submenu1"] = $this->submenu_html1();
		  $data['edit']='';
		   $data['home']='';
		 $table='addnewemployee';
		$limit=1;
		$data['noofrows'] = $this->vmk_model->no_rows1($table);
		$data['entry'] = $this->vmk_model->last($table,$limit);
		$entry1=$data['entry'];
		$data['msg0']='"'.$entry1[0]['First_name'].' '.$entry1[0]['Last_name'].'"';
	 	$data['msg1']= '<br>'.'Is Successfully Registered'.'<br>'.'The Employee ID Is ';	
	$data['msg']='<br>'.'"'.$entry1[0]['Employee_id'].'"';	

       $this->load->view('templates/header', $data);
		$this->load->view('pages/employee/self_employee', $data);//employee folder in views
		$this->load->view('templates/footer');
	}
	public function employeeslink() // see all employees data
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
	 $collection=json_decode($data['permission'][0]['hr_department'],TRUE);
	}
	
			if (in_array('hr_department',$collection))
			{
				
		$data["submenu1"] = $this->submenu_html1();
		 $table='addnewemployee';
		$data['employees'] = $this->vmk_model->get_data($table);
		
		$this->load->view('pages/employee/employees_emp', $data);//employee folder in views
			}
			else
			{
				 $this->load->view('templates/unauthorized');
			}
		$this->load->view('templates/footer');
	}
	public function newemp_form()//new employee registration form submit
	{
		
		 $dept = $this->session->userdata('usertype');
		   $data["usertype"] = $dept;
		   $username = $this->session->userdata('username'); 
		 $data["username"] = $username;	
	    
		$fname = $this->input->post("fname"); //user defined data
       
		$lname = $this->input->post("lname");
		$emailid = $this->input->post("emailid");
		$desig = $this->input->post("desig");
		$employee_position = $this->input->post("employee_position");
		$address1 = $this->input->post("address1");
		$address2 = $this->input->post("address2");
		$work = $this->input->post("work");
		$sub = $this->input->post("sub");
		$country = $this->input->post("country");
		$state = $this->input->post("state");
		$city = $this->input->post("city");
		$postcode = $this->input->post("postcode");
		$phone = $this->input->post("phone");
		$econ = $this->input->post("econ");
		$doj = $this->input->post("doj");
		
		$probation = $this->input->post("probation");
		$income = $this->input->post("income");
		$acc = $this->input->post("acc");
		$proofs = $this->input->post("proofs");
		$bond = $this->input->post("bond");	
		
		$sick = $this->input->post("sl");
		$annual = $this->input->post("al");
		$total = $this->input->post("total");
		
		 $config['upload_path']   = './employee_photos'; //upload employee photo
      $config['allowed_types'] = 'gif|JPEG|jpg|png|xls|xlsx|php|pdf|html|php';
      $config['max_size']   = '4000'; 
      $config['encrypt_name']  = TRUE;
      $this->upload->initialize($config);
      $uploaded = $this->upload->up(TRUE);   
      $count = 0;
     $image=$uploaded['success'][0]['file_name'];
	 $image1=$uploaded['success'][1]['file_name'];
	 
 if(isset($_POST['proofs'])) {//check boxes values taken
	$role = implode(",", $_POST['proofs']);	
} else {
	$role = "";
}


	$fname=trim($fname);

		
$table='addnewemployee';//automatic generation of employee id
		$limit=1;
		$data['trackno']=$this->vmk_model->no_rows1($table);
		if($data['trackno']==0)
		{
			$empid='vmk01';
		}
		else
		{
	
		$intial=$this->vmk_model->last($table,$limit);
		$value=trim($intial[0]['Employee_id']);
		
		$new_value=explode("vmk",$value);
		
		$id=$new_value[1];
		$j=$id+1;
		if($j>=10)
		{
		$empid='vmk'.$j;	
		}
		else
		{
		$empid='vmk0'.$j;
		}
		}


$proofs1 = $this->input->post("proofs1");
$proofs2 = $this->input->post("proofs2");
$proofs3 = $this->input->post("proofs3");
$proofs4 = $this->input->post("proofs4");
$proofs5 = $this->input->post("proofs5");
$proofs6 = $this->input->post("proofs6");
$proofs7 = $this->input->post("proofs7");
$proofs8 = $this->input->post("proofs8");
$proofs9 = $this->input->post("proofs9");
 
$alls1=json_encode($proofs1);
$alls2=json_encode($proofs2);
$alls3=json_encode($proofs3);
$alls4=json_encode($proofs4);
$alls5=json_encode($proofs5);
$alls6=json_encode($proofs6);
$alls7=json_encode($proofs7);
$alls8=json_encode($proofs8);
$alls9=json_encode($proofs9);

$table='permissions';
if($alls1=='false')
{
	$alls1='[""]';
}
if($alls2=='false')
{
$alls2='[""]';	
}
 if($alls3=='false')
{
$alls3='[""]';	
}
if($alls4=='false')
{
$alls4='[""]';	
}
 if($alls5=='false')
{
$alls5='[""]';	
}
 if($alls6=='false')
{
$alls6='[""]';	
}
 if($alls7=='false')
{
$alls7='[""]';	
}
 if($alls8=='false')
{
$alls8='[""]';	
}
 if($alls9=='false')
{
$alls9='[""]';	
}
$fname1=str_replace(' ','',$fname);
$data=array(
'sno'=>' ',
'employee_name'=>$fname1.$empid,
'home'=>$alls1,
'projects'=>$alls2,
'clients'=>$alls3,
'tracking'=>$alls4,
'accounts'=>$alls5,
'hr_department'=>$alls6,
'marketing'=>$alls7,
'events'=>$alls8,
'contacts'=>$alls9,
);

$this->vmk_model->insert_data($table,$data);



	 $table='addnewemployee';	
		$data=array(
		'First_name'=>$fname,
		'Last_name'=>$lname,
		'Email_id'=>$emailid,
		'Designation'=>$desig,
		'Employee_id'=>$empid,
		'Address1'=>$address1,
		'Address2'=>$address2,
		'work_assigned'=>$work,
		'suburban'=>$sub,
		'country'=>$country,
		'state'=>$state,
		'city'=>$city,
		'postcode'=>$postcode,
		'Phone_no'=>$phone,
		'emergency_no'=>$econ,
		'Date_of_joining'=>$doj,
		'date_of_releaving'=>'0000/00/00',
		'Probation'=>$probation,
		'income_perannum'=>$income,
		'Bank_account'=>$acc,
		'Resume'=>$image1,
		'photo_id'=>$image,
		'Proofs_submitted'=>$role,
		'Bond_period'=>$bond,
		
		'Sick_leaves'=>$sick,
		'Annual_leaves'=>$annual,
		'Total_leaves'=>$total,
		'employee_position'=>$employee_position
		);
		$fname1=str_replace(' ','',$fname);
		$employee_position1=str_replace('_',' ',$employee_position);
		$body ='<div style="font-family:"Trebuchet MS",sans-serif,Arial;">'.'<div>Dear Mr/Mrs'.' '.$fname.'<div style="padding:15px 0;"><div  style="padding-top:10px;">
Your Login Details:</div><div>Username:'.$fname1.$empid.'</div><div>Password: '.$fname1.'1'.'</div><div>Type: '.$employee_position1.'</div><div style="padding-top:20px;"><i>'.'<div>Regards</div>'."<div>".'VMK Management'."</div>".'<div>#8/2/268/1/B/12,</div>'.'<div>Aurora Colony,</div>'.'<div>Banjara Hills,</div>'.'<div>Road No: 3,</div>'.'<div>Hyderabad,</div>'.'<div>Andhra Pradesh,</div>'.'<div>India</div>'.'<div>PIN Code: 500034 </div>'.'<div>Contact Numbers:  +91 40-64644891</div>'.'<div>+91 40-64634891</div>'.'<div>+91 9849674891</div>'.'<div>Email: Info@vmksoftwaresolutions.com</div></div></i></div>';

$sub='Your ID is '.$empid;
    $this->email->clear();
	
    $this->email->to($emailid);
    $this->email->from('info@vmksoftwaresolutions.com');
    $this->email->subject($sub);
    $this->email->message($body);
    $this->email->send();
		$this->vmk_model->insert_data($table,$data);//insert new employee data into table
		$table='users';
	$data=array(
	'sno'=>' ',
	'username'=>$fname1.$empid,
	'password'=>$fname1.'1',
	'type'=>$employee_position,
	'user_id'=>$empid
	
	);
	$this->vmk_model->insert_data($table,$data);
	redirect('employees/selfemplink_redirect','refresh');//redirect to registration successful page to get the details 
		
	}
		
public function edit_emp_details($empid) // see all employees data
	{
		
		 $dept = $this->session->userdata('usertype');
		 $data["usertype"] = $dept;
		  $username = $this->session->userdata('username'); 
		 $data["username"] = $username;
		$data["submenu1"] = $this->submenu_html1();
		$id=str_replace('_',' ',$empid);	
		$data['name']=$id;
		$table='addnewemployee';
		$where=array('Employee_id'=> $id);
		 $data['entry'] = $this->vmk_model->get_where_data($table, $where);
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/edit_emp_details', $data);//employee folder in views
		$this->load->view('templates/footer');
	}
	public function edit_submit()//new employee registration form submit
	{
		
		 $dept = $this->session->userdata('usertype');
		   $data["usertype"] = $dept;
		   $username = $this->session->userdata('username'); 
		 $data["username"] = $username;	
	    
		$fname = $this->input->post("fname"); //user defined data
		
		 
		$lname = $this->input->post("lname");
		$id = $this->input->post("id");
		$emailid = $this->input->post("emailid");
		$desig = $this->input->post("desig");
		$employee_position = $this->input->post("employee_position");
		$address1 = $this->input->post("address1");
		$address2 = $this->input->post("address2");
		$work = $this->input->post("work");
		$sub = $this->input->post("sub");
		$country = $this->input->post("country");
		$state = $this->input->post("state");
		$city = $this->input->post("city");
		$postcode = $this->input->post("postcode");
		$phone = $this->input->post("phone");
		$econ = $this->input->post("econ");
		$doj = $this->input->post("doj");
		$dor = $this->input->post("dor");
		$probation = $this->input->post("probation");
		$income = $this->input->post("income");
		$acc = $this->input->post("acc");
		$proofs = $this->input->post("proofs");
		$bond = $this->input->post("bond");	
		
		$sick = $this->input->post("sl");
		$annual = $this->input->post("al");
		$total = $this->input->post("total");
		
		 $config['upload_path']   = './employee_photos'; //upload employee photo
      $config['allowed_types'] = 'gif|JPEG|jpg|png|xls|xlsx|php|pdf|html|php';
      $config['max_size']   = '4000'; 
      $config['encrypt_name']  = TRUE;
      $this->upload->initialize($config);
      $uploaded = $this->upload->up(TRUE);   
      $count = 0;
     $image=$uploaded['success'][0]['file_name'];
	 $image1=$uploaded['success'][1]['file_name'];

if(isset($_POST['proofs'])) {//check boxes values taken
	$role = implode(",", $_POST['proofs']);	
} else {
	$role = "";
}

	 $table='addnewemployee';	
		$data=array(
		'First_name'=>$fname,
		'Last_name'=>$lname,
		'Email_id'=>$emailid,
		'Designation'=>$desig,
		'Employee_id'=>$id,
		'Address1'=>$address1,
		'Address2'=>$address2,
		'work_assigned'=>$work,
		'suburban'=>$sub,
		'country'=>$country,
		'state'=>$state,
		'city'=>$city,
		'postcode'=>$postcode,
		'Phone_no'=>$phone,
		'emergency_no'=>$econ,
		'Date_of_joining'=>$doj,
		'date_of_releaving'=>$dor,
		'Probation'=>$probation,
		'income_perannum'=>$income,
		'Bank_account'=>$acc,
		'Resume'=>$image1,
		'photo_id'=>$image,
		'Proofs_submitted'=>$role,
		'Bond_period'=>$bond,
		
		'Sick_leaves'=>$sick,
		'Annual_leaves'=>$annual,
		'Total_leaves'=>$total,
		'employee_position'=>$employee_position
		);
	$where=array('Employee_id'=>$id);
		$this->vmk_model->update_data($table,$data,$where);
	
	redirect('employees/employee_details','refresh');//redirect to registration successful page to get the details 
	}
	public function emp_register($page,$year = null, $month = null) { //daily intime enter
	
		$dept = $this->session->userdata('usertype');
		 $data["usertype"] = $dept;
		   $username = $this->session->userdata('username'); 
		 $data["username"] = $username;	
		
		  $table='users';
		 $where=array('username'=>$this->username);
		 $entry = $this->vmk_model->get_where_data($table, $where);
		 $data['entry']= $entry[0]['user_id'];
		$this->load->view('templates/header', $data);
		 $data["submenu"] = $this->submenu_html();
		 $this->load->view('pages/employee/home_menu', $data);
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
	 $collection=json_decode($data['permission'][0]['home'],TRUE);
	}
	
			if (in_array('my_register',$collection))
			{
		$table='addnewemployee';
		$where=array('Employee_id'=>$entry[0]['user_id']);
		$data['entry1']= $this->vmk_model->get_where_data($table, $where);
		$table='apply_leaves';
		$limit=1;
		$where=array('vmk_id'=>$entry[0]['user_id'],'leave_type'=>'annual');
		$data['no_rows']= $this->vmk_model->no_rows($table, $where);
		$data['leaves_emp_id_data']= $this->vmk_model->get_last_record($table, $where,$limit);
		$where=array('vmk_id'=>$entry[0]['user_id'],'leave_type'=>'sick');
		$data['no_rows1']= $this->vmk_model->no_rows($table, $where);
		$data['leaves_emp_id_data1']= $this->vmk_model->get_last_record($table, $where,$limit);
		$table='public_holiday';
		$data['no_rows2']= $this->vmk_model->no_rows1($table);
		$data['holiday']= $this->vmk_model->last_record_event($table,$limit);
		$data = $this->data;
		 date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");
		$send_data = array( "e_username" => $this->username, "e_date" => $date);
		$send_table = "employee_register";
		$get_rows = $this->vmk_model->no_rows($send_table, $send_data);
		
		
		if($get_rows == 0) {
			$data["view_message"] = 0;
			$data['emp_com_reg'] = array();
			$table='users';
		 $where=array('username'=>$this->username);
		 $entry = $this->vmk_model->get_where_data($table, $where);
		 
		 $data['entry']= $entry[0]['user_id'];
			
		   
		}
		else if($get_rows == 1) {
		$data = $this->data;
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");
		
		$send_data = array( "e_username" => $this->username, "e_date" => $date);
		
		$send_table = "employee_register";
		$get_data = $this->vmk_model->get_where_data($send_table, $send_data);
		$data['get_data'] = $get_data;
		$data["view_message"] = 1;
         $date_current= date("Y-m-d",strtotime('-1 month'));
		  $date_last= date("Y-m-d",strtotime('+1 month'));
		 
		$send_data= $this->username;
		$data['emp_com_reg'] = $this->vmk_model->get_where_data_ss($send_table, $send_data, $date_current,$date_last);
		 $date = date("Y-m-d");
		 $send_data = array( "e_username" => $this->username, "e_date" => $date,'work_update'=>'no');
		
		$send_table = "employee_register";
		$session = $this->vmk_model->get_where_data($send_table, $send_data);
		$data['session'] = $session;
		}
		else {
		$data = $this->data;
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");
		
		$send_data = array( "e_username" => $this->username, "e_date" => $date);
		
		$send_table = "employee_register";
		$get_data = $this->vmk_model->get_where_data($send_table, $send_data);
		$data['get_data'] = $get_data;
		$data["view_message"] = 1;
		 $date_current= date("Y-m-d",strtotime('-1 month'));
		  $date_last= date("Y-m-d",strtotime('+1 month'));
		 
		$send_data= $this->username;
		$data['emp_com_reg'] = $this->vmk_model->get_where_data_ss($send_table, $send_data, $date_current,$date_last);
		 $date = date("Y-m-d");
		 $send_data = array( "e_username" => $this->username, "e_date" => $date,'work_update'=>'no');
		
		$send_table = "employee_register";
		$session = $this->vmk_model->get_where_data($send_table, $send_data);
		$data['session'] = $session;
		}
		
		if (!$year) {
			$year = date('Y');
		}
		if (!$month) {
			$month = date('m');
		}
		
		$this->load->model('Mycal_model1');
		
		if ($day = $this->input->post('day')) {
			$this->Mycal_model->add_calendar_data(
				"$year-$month-$day",
				$this->input->post('data')
			);
		}
		
		$data['calendar'] = $this->Mycal_model1->generate($year, $month);
		
		$this->load->view('pages/employee/'.$page, $data);//employee folder in views
			}
			else
			{
				$this->load->view('templates/unauthorized'); 	
			}
		
		$this->load->view('templates/footer');
	}
	
	public function update_reg($id) { //daily outtime update
		
		 date_default_timezone_set("Asia/Kolkata");
	     $india_time = date("g:i:s");
		$data = $this->data;
		$table = "employee_register";
		
		$user_ids = $this->input->post('user_ids');
		//echo $tasks;
		if($id == "e_register") {
		   $data = array("sno" => " ",
		   				 "e_id" => $user_ids,
						 "e_name" => $this->username,
						 "e_username" => $this->username,
						 "e_date"=> date("Y-m-d"),
						 "session_start" => $india_time,
						 "session_end" => 0,
						 "work_update"=>'no'
						 );
		  $emp_reg = $this->vmk_model->insert_data($table,$data);
		}
		else if($id == "e_closing") {
		   $data = array("session_end" => $india_time
		   				 
						 );
		   $where = array("e_username" => $this->username,
		   				  "e_date"=> date("Y-m-d")
						  );
		   $update_reg = $this->vmk_model->update_data($table,$data,$where);
		}
		redirect('employees/emp_register/emp_register','refresh');
	}
	public function work_updates() { //daily outtime update
		
		 date_default_timezone_set("Asia/Kolkata");
	     $india_time = date("g:i:s");
		$data = $this->data;
		
		
		 $table='users';
		 $where=array('username'=>$this->username);
		 $entry = $this->vmk_model->get_where_data($table, $where);
		 $user_ids= $entry[0]['user_id'];
		$project = $this->input->post('project');
		$task_start = $this->input->post('task_start');
		$task_end = $this->input->post('task_end');
		$subject = $this->input->post('subject');
		$description = $this->input->post('description');
		$remarks = $this->input->post('remarks');
		$status = $this->input->post('status');
		
		//echo $tasks;
		$body ='<div style="font-family:"Trebuchet MS",sans-serif,Arial;"><div>'.'<b>Employee Id:</b>'.$user_ids.'</div><div><b>Employee Name</b>:'.$this->username.'</div>'
		.'<div>Project'.$project.'</div>'
		.'<div>Project'.$task_start.'</div>'
		.'<div>Project'.$task_end.'</div>'
		.'<div>Project'.$subject.'</div>'
		.'<div>Project'.$description.'</div>'
		.'<div>Project'.$remarks.'</div>'
		.'<div>Project'.$status.'</div>'
		;



    $this->email->clear();

$sub=$subject;
$this->email->to('v.v.kishorechowdary@gmail.com,prithvi.vmk@gmail.com');

 $send_data = array("Employee_id" => $user_ids);
		
		$send_table = "addnewemployee";
		$get_data = $this->vmk_model->get_where_data($send_table, $send_data);
		$from=$get_data[0]['Email_id'];
    $this->email->from($from);
	$this->email->subject($sub);
    $this->email->message($body);
    $this->email->send();

		$table = "employee_register";
		   $data = array("sno" => " ",
		   				 "e_id" => $user_ids,
						 "e_name" => $this->username,
						 "e_username" => $this->username,
						 "e_date"=> date("Y-m-d"),
						 "status" => $status,
						 "project_info" => $project,
						 "task_start" => $task_start,
						 "task_end" => $task_end,
						 "subject" => $subject,
						 "description" => $description,
						 "remarks" => $remarks,
						  "session_end" => 0,
						 "work_update"=>'yes'
						 );
		  $emp_reg = $this->vmk_model->insert_data($table,$data);
		
		
		redirect('employees/emp_register/emp_register','refresh');
	}
	public function submenu_html($submenu = "") {
		$submenu1 = "<ul>

							<li><a href=\"".base_url()."index.php/employees/jobroles\">VMK staff</a></li>
						    <li><a href=\"".base_url()."index.php/employees/emp_register/emp_register\">MY register</a></li>
							";
							$username = $this->session->userdata('username'); 
		 $data["username"] = $username;	
		 date_default_timezone_set("Asia/Kolkata");
						 $date = date("Y-m-d");
		 $where = array( "e_username" => $this->username, "e_date" => $date);
		 $send_where=$where;
		
		$send_table = "employee_register";
		$table = "employee_register";
		$noofrows = $this->vmk_model->no_rows($table,$where);
		$date1 = $this->vmk_model->get_where_data($send_table,$send_where);
		
		
			
							if($noofrows==0){
							
			$submenu2 = "<li><a href=\"".base_url()."index.php/employees/view1/error\">Work Update</a></li>";
							}
							else if($noofrows>=1 && $date1[0]['session_end']!='00:00:00')
							{
								
								$submenu2 = "<li><a href=\"".base_url()."index.php/employees/view1/error1\">Work Update</a></li>";
								
							}
							else 
							{
						$submenu2 = "<li><a href=\"".base_url()."index.php/employees/view1/work_update\">Work Update</a></li>";
							}
			$submenu3="
			
							<li><a href=\"".base_url()."index.php/employees/register_view\">Register View</a></li>
							<li><a href=\"".base_url()."index.php/employees/leaves_view\">Leaves View</a></li>
							<li><a href=\"".base_url()."index.php/employees/public_holiday\">Add Public Holiday</a></li>
							<li><a href=\"".base_url()."index.php/employees/selfemplink\">My Details</a></li>
							<li><a href=\"".base_url()."index.php/employees/my_track1\">MY tasks</a></li>
							
			
					</ul>";
			$submenu=$submenu1.$submenu2.$submenu3;
		return $submenu;
	}
	public function submenu_html1($submenu1 = "") {
		$submenu1 = "<ul>
	
							
							<li><a href=\"".base_url()."index.php/employees/all/employeeselectform\">Employee Details</a></li>
							<li><a href=\"".base_url()."index.php/employees/link\">Add New Employee</a></li>
						
					</ul>";
		return $submenu1;
	}
	
	public function register_view() { //management wants to see daily register 
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		
		  $data["submenu"] = $this->submenu_html();
		  $this->load->view('templates/header', $data);
		 $this->load->view('pages/employee/home_menu', $data);
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
	 $collection=json_decode($data['permission'][0]['home'],TRUE);
	}
	
			if (in_array('register_view',$collection))
			{
				 $table='users';
	      $data['roles'] = $this->vmk_model->retrive_data($table);
		  $table='employee_register';
		$where = array('e_date' => date("Y-m-d"));
		$data['entry'] = $this->vmk_model->get_where_data($table,$where);
		
		
		 $data["message"]="";
	     $this->load->view('pages/employee/register_view', $data);
			}
			
			else
			{
			 $this->load->view('templates/unauthorized'); 	
			}
	     $this->load->view('templates/footer', $data);
	}
	public function leaves_view() { //management wants to see daily register 
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		
		  $data["submenu"] = $this->submenu_html();
		   $this->load->view('templates/header', $data);
		 $this->load->view('pages/employee/home_menu', $data);
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
	 $collection=json_decode($data['permission'][0]['home'],TRUE);
	}
	
			if (in_array('leaves_view',$collection))
			{
	      $table='apply_leaves';
		  $where=array('leaves_confirmation'=>'---');
		  $data['entry'] = $this->vmk_model->get_last_record_leaves($table ,$where);
		  $this->load->view('pages/employee/leaves_view', $data);
			}
			else
			{
			 $this->load->view('templates/unauthorized'); 	
			}
			
	     $this->load->view('templates/footer', $data);
	}
	public function leaves_apply($id) { //management wants to see daily register 
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		 $table='users';
		  $data["submenu"] = $this->submenu_html();
	   
		 $this->load->view('templates/header', $data);
		 $this->load->view('pages/employee/leaves_apply', $data);
	     $this->load->view('templates/footer', $data);
	}
	public function leave_sension($id) { //management wants to see daily register 
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		 $table='users';
		  $data["submenu"] = $this->submenu_html();
	        $table='apply_leaves';
		$limit=1;
		$ids=str_replace('%20',' ',$id);
		 $where=array('vmk_id'=>$ids);
	
		 $data['entry'] = $this->vmk_model->get_last_record($table, $where,$limit);
	
		 $this->load->view('templates/header', $data);
		 $this->load->view('pages/employee/leave_sension', $data);
	     $this->load->view('templates/footer', $data);
	}
	public function leave_san_submit($sno,$type) { //management wants to see daily register 
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		 $table='users';
		  $data["submenu"] = $this->submenu_html();
	        $table='apply_leaves';
		  
	  $san=$this->input->post('san');
	  $data=array('leaves_confirmation'=>$san);
	  $where=array('sno'=>$sno);
	  $this->vmk_model->update_data($table, $data,$where);
	 if($san=="YES")
	 {
	  $entry=$this->vmk_model->get_where_data($table,$where);
	  $table='calendar';
 $date1=strtotime($entry[0]['to_date']);
$date2=strtotime($entry[0]['from_date']);
$diff=$date1-$date2; 
$diff1=floor($diff/3600/24);

	  $dt=date("Y-m-j");
	   $dt1=$entry[0]['from_date'];
	   $dt_new=explode('-',$dt1);

		
		$data=array(
	
	  			  'date' => $dt,
				  'data' => $entry[0]['name'].'('.$entry[0]['vmk_id'].')',
				    'where'=>$entry[0]['vmk_id']
				  );
				
				if($dt_new[2]<10)
				{
					$dt_new1=explode("0",$dt_new[2]);
	$data1=array(
	
	  			  'date' => $dt_new[0]."-".$dt_new[1]."-".$dt_new1[1],
	  'data' => $entry[0]['name'].'('.$entry[0]['vmk_id'].')'.'Leaved',
				   'where'=>$entry[0]['vmk_id']
				  
				  );
				}
				else {
				  $data1=array(
	
	  			  'date' => $dt1,
	              'data' => $entry[0]['name'].'('.$entry[0]['vmk_id'].')'.$entry[0]['leave_type'].'Leaved',
				  'where'=>$entry[0]['vmk_id']
				  
				  );
				}
				  
				  $this->vmk_model->insert_data('individual_calendar',$data1);	
				  if($entry[0]['to_date']==$entry[0]['from_date'])
				  {
					   
				  }
				  else
				  {
					
				  for($i=0;$i<$diff1;$i++)		  
				  {
					 
					  $values1=explode('-',$dt1);
					 $y=$values1[0];
					$m=$values1[1];
					$de=$values1[2];
					  $data1=array(
	               
	  			  'date' => date('Y-m-j',mktime(0,0,0,$m,($de+($i+1)),$y)),
	              'data' => 'Leaved',
				  'where'=>$entry[0]['vmk_id']
				  );
					  
					  $this->vmk_model->insert_data('individual_calendar',$data1);//insert user defined data into table
					  
			
				  }
	}
	
	
	//print_r($data);

	$this->vmk_model->insert_data($table,$data);//insert user defined data into table
	
	 }
	 else{
	 }
redirect('employees/leaves_view','refresh');

	}
	
public function all($page) { //management wants to see daily register 
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		 $table='users';
		  $data["message"]="";
		 $where=array('username'=>$username);
		  $data["submenu"] = $this->submenu_html();
		  $data["submenu1"] = $this->submenu_html1();
		 $data['entry'] = $this->vmk_model->get_where_data($table,$where);
		 $this->load->view('templates/header', $data);
		 $this->load->view('pages/employee/'.$page, $data);
	     $this->load->view('templates/footer', $data);
	}
	public function employee_details() { //management wants to see daily register 
	
	$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		 $table='users';
		  $data["submenu1"] = $this->submenu_html1();
		
	     $this->load->view('templates/header', $data);
		 
		   $id=$this->input->post('id');
		 $table='addnewemployee';
		$data = array('Employee_id'=>$id);
		$data['noofrows'] = $this->vmk_model->no_rows($table,$data);
	   
     if($data['noofrows']==0)//verification authorizerd r not
	 {
		  
		$data["message"]="* The Employee ID Is INVALID";
		
		$this->load->view('pages/employee/employeeselectform', $data);
	
	 }
	  else
		{
				
			  $where=array('Employee_id'=>$id);
		    $data['entry'] = $this->vmk_model->get_where_data($table,$where);
		$data['edit']='edit';
		 $data['home']='';
			 $data['msg0']='';
		 $data['msg']='';
		 $data['msg1']='';
		 $this->load->view('pages/employee/self_employee', $data);
		}
	     $this->load->view('templates/footer', $data);
	}
public function leaves_submit() { //management wants to see daily register 
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		 $table='users';
		  $data["submenu"] = $this->submenu_html();
		  $name=$this->input->post('name');
		  $vmk_id=$this->input->post('vmk_id');
		  $type=$this->input->post('type');
		  $from_date=$this->input->post('from_date');
		  $to_date=$this->input->post('to_date');
		  $leave=$this->input->post('leave');
		  $purpose=$this->input->post('purpose');
		  $ava=$this->input->post('ava');
		  $con=$this->input->post('con');
	    $date=date("Y-m-d");
	
		 $body ='fghgf';
        $table='users';
		 $where=array('username'=>$username);
		 $entry = $this->vmk_model->get_where_data($table,$where);
       $table='addnewemployee';
		 $where=array('Employee_id'=>$entry[0]['user_id']);
		 $entry1 = $this->vmk_model->get_where_data($table,$where);   
           $mail=$entry1[0]['Email_id'];
    $this->email->clear();

$sub='You have successfully registered a project with VMK';
$this->email->to('kishore@vmksoftwaresolutions.com');
 
    $this->email->from($mail);
    $this->email->subject($sub);
    $this->email->message($body);
    $this->email->send();
	 $table='apply_leaves';
	  $data=array('name'=>$name,'vmk_id'=>$vmk_id,'leave_type'=>$type,'from_date'=>$from_date,'to_date'=>$to_date,'noof_leaves'=>$leave,'purpose'=>$purpose,'available_in_holidays_time'=>$ava,'contact_no'=>$con,'today_date'=>$date,'leaves_confirmation'=>'---');
		$this->vmk_model->insert_data($table,$data);
		redirect('employees/all/form_apply_holiday','refresh');
	}
public function register_views() { //management wants to see monthly register
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		  $this->load->view('templates/header', $data);
		 $id=$this->input->post('id');
		 $from=$this->input->post('from');
		 $to=$this->input->post('to');
		
		
	$table='addnewemployee';
		$data = array('Employee_id'=>$id);
		$data['noofrows'] = $this->vmk_model->no_rows($table,$data);
	   
     if($data['noofrows']==0)//verification authorizerd r not
	 {
		   $data["submenu"] = $this->submenu_html();
		$data["message"]="* The Employee ID Is INVALID";
		 $table='employee_register';
		$where = array('e_date' => date("Y-m-d"));
		$data['entry'] = $this->vmk_model->get_where_data($table,$where);
		$this->load->view('pages/employee/register_view', $data);
	
	 }
	  else
		{
		 $data["submenu"] = $this->submenu_html();
	     $table='employee_register';
		 
		 $data['roles'] = $this->vmk_model->get_datas($table,$id,$from,$to);
		
	     $this->load->view('pages/employee/month_register_view', $data);
		}
		
		 $this->load->view('templates/footer', $data);
	}
	
	public function jobroles() { //vmk job roles  view
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		   $data["submenu"] = $this->submenu_html();
		 $this->load->view('templates/header', $data);
		 $this->load->view('pages/employee/home_menu', $data);
		 
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
	 $collection=json_decode($data['permission'][0]['home'],TRUE);
	}
	
			if (in_array('vmk_staff',$collection))
			{
		$page = "jobroles";
		 $table='addnewemployee';
		
	    $data['roles'] = $this->vmk_model->get_data($table);
		 
	     $this->load->view('pages/employee/'.$page, $data);
			}
			else
			{
			 $this->load->view('templates/unauthorized'); 	
			}
	     $this->load->view('templates/footer', $data);
	}
	public function roles_form() { //vmk job roles form 
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		   $data["submenu"] = $this->submenu_html();
		 $this->load->view('templates/header', $data);
	     $this->load->view('pages/employee/roles_form', $data);
	     $this->load->view('templates/footer', $data);
	}
	public function public_holiday()
		{
	
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		  $username = $this->session->userdata('username'); 
		 $data["username"] = $username;
		 $data["submenu"] = $this->submenu_html();
	
	$this->load->view('templates/header', $data);
	$this->load->view('pages/employee/home_menu', $data);
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
	 $collection=json_decode($data['permission'][0]['home'],TRUE);
	}
	
			if (in_array('add_public_holiday',$collection))
			{
	$this->load->view('pages/employee/form_add_public_holiday', $data);
			}
			else
			{
				 $this->load->view('templates/unauthorized');
			}
	$this->load->view('templates/footer', $data);
    
	}
public function public_holiday_submit() { //management wants to see daily register 
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		 $table='users';
		  $data["submenu"] = $this->submenu_html();
		  $name=$this->input->post('name');
		  $date=$this->input->post('date');
		  $days=$this->input->post('days');
		 $table='public_holiday';
		 $data=array(
		 'holiday_name'=>$name,
		 'date'=>$date,
		 'no_of_days'=>$days
		 );
	  $this->vmk_model->insert_data($table,$data);
	  redirect('/employees/view/form_add_public_holiday','referesh');
	
}
	public function my_track1() { //to see which employee enter into this project to see those works
		
		$username = $this->session->userdata('username');
		$dept = $this->session->userdata('usertype');
		$data["username"] = $username;
		$data["usertype"] = $dept;
		$data["submenu"] = $this->submenu_html();
		$this->load->view('templates/header', $data);
		 $this->load->view('pages/employee/home_menu', $data);
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
	 $collection=json_decode($data['permission'][0]['home'],TRUE);
	}
	
			if (in_array('my_tasks',$collection))
			{
		$table='track';
		$where = array('project_shifted_to' => $username);
		$data['entry'] = $this->vmk_model->get_where_data_order($table,$where,'sno');
		//print_r($data['entry']);
		
	    $this->load->view('pages/employee/my_track', $data);
		}
			else
			{
			 $this->load->view('templates/unauthorized'); 	
			}
	    $this->load->view('templates/footer', $data);
	}	
	public function search_employee_id() //due to register viewing purpose to enter employee id
	{
		 $term = $this->input->post('term',TRUE);
		 if (strlen($term) < 1) break;
		 $rows = $this->vmk_model->GetAutocomplete_user_id(array('keyword' => $term));
		 $json_array = array();
		 foreach ($rows as $row)
		 array_push($json_array, $row->Employee_id);
		  echo json_encode($json_array); 
	}
	
	public function username_check()
	{
		$fname=$this->input->post('fname');
		$table='addnewemployee';
		$where=array('First_name' => $fname);
		$fname_check=$this->vmk_model->rows_count($table,$where);
		if($fname_check==0)
		{
			echo 'FALSE';
		}
		else
		{
			echo 'TRUE';
		}
	}
	
}
