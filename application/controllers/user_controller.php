<?php

class user_controller extends CI_Controller {

  public function __construct()
	{
		parent::__construct();
		$this->load->model('vmk_model'); //load the model
		$this->load->library('upload'); //to upload any images to use this library
		$this->load->helper('url'); //url library helper
		$this->load->library('session'); //session library
		$dept = $this->session->userdata('usertype');
		$username = $this->session->userdata('username');
		$this->username = $username;
		$this->dept = $dept;
		$this->data = array("username" =>$this->username,"usertype" => $this->dept,"submenu" => $this->submenu_html());
		
	if($username == NULL)
  {
   $this->sessionExpires();
  }
        }
		public function sessionExpires()
	{
		
		
		$data["message"]="* Session Was Destroy ";
		redirect(base_url());
		
	}

	public function view($page)
	{
		if ( ! file_exists('application/views/pages/login_form/'.$page.'.php'))
	{
		// Whoops, we don't have a page for that!
		show_404();
	}
	
	$data['title'] = ucfirst($page); // Capitalize the first letter
	$data["message"]="";
	
	$this->load->view('pages/login_form/'.$page, $data);
	


	}
	public function view1($page)
	{
	$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		 $data["submenu"] = $this->submenu_html();
		 
	
		 $this->load->view('templates/header', $data);
	$this->load->view('pages/login_form/'.$page, $data);
	 $this->load->view('templates/footer', $data);
	


	}
	
	public function submenu_html($submenu = "") {
		$submenu1 = "<ul>

							<li><a href=\"".base_url()."index.php/employees/jobroles\">VMK staff</a></li>
						    <li><a href=\"".base_url()."index.php/employees/emp_register/emp_register\">MY register</a></li>
							";
							$username = $this->session->userdata('username'); 
		 $data["username"] = $username;	
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
	
	/*
	* @ add by bala on 1-20-13 for home page link...
	*/
	public function home($page1,$year = null, $month = null) {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
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
	 $collection=json_decode($data['permission'][0]['home'],TRUE);
	}
	
			if (in_array('entry',$collection))
			{
		 $data["submenu"] = $this->submenu_html();
		 
		 $page = "entry";
		
		
		 if (!$year) {
			$year = date('Y');
		}
		if (!$month) {
			$month = date('m');
		}
		
		$this->load->model('Mycal_model');
		
		
		if ($day = $this->input->post('day')) {
			$this->Mycal_model->add_calendar_data(
				"$year-$month-$day",
				$this->input->post('data')
			);
		}
		
		$data['page1']=$page1;
		$data['calendar'] = $this->Mycal_model->generate($year, $month,$page1);
		
		$table='calendar';
			
		$entry = $this->vmk_model->get_data($table);
	
		  $this->load->view('pages/login_form/entry', $data);
			}
			else
			{
				$this->load->view('templates/others'); 	
			}
		  $this->load->view('templates/footer', $data);
	}


/* contact us */
public function contact_us($page) {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
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
	 $collection=json_decode($data['permission'][0]['contacts'],TRUE);
	}
	
			if (in_array('contacts',$collection))
			{
		 $data['height']='height';
	     $this->load->view('pages/contact_us/'.$page,$data);
			}
			else
			{
				$this->load->view('templates/unauthorized');
			}
	     $this->load->view('templates/footer', $data);
	}

public function contact_us1() {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		
		 $this->load->view('templates/header', $data);
		
		 $data['height']='ss';
		 $this->load->view('pages/contact_us/contact_us',$data);
		  $this->load->view('pages/contact_us/contact_form',$data);
	     $this->load->view('templates/footer', $data);
	}
public function contact_submit() {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		
	 $fname = $this->input->post("fname");
   $lname = $this->input->post("lname");
	  $econtact = $this->input->post("econtact");
	   $pcontact = $this->input->post("pcontact");
	    $email = $this->input->post("email");
	    $addressline1 = $this->input->post("address1");
		 $addressline2 = $this->input->post("address1");
		 $suburban = $this->input->post("sub");
		 $country = $this->input->post("country");
		 $city = $this->input->post("city");
		 $postcode = $this->input->post("postcode");
		 $state = $this->input->post("state");
		 $config['upload_path']   = './contact_us_photos';
      $config['allowed_types'] = 'gif|JPEG|jpg|png|xls|xlsx|php|pdf';
      $config['max_size']   = '4000'; 
      $config['encrypt_name']  = TRUE;
      $this->upload->initialize($config);
      $uploaded = $this->upload->up(TRUE);   
 
      $count = 0;
    
      $image=$uploaded['success'][0]['file_name'];
		$table='contact_us';
		$data=array(
		
		'first_name'=>$fname,
		'last_name'=>$lname,
		'personal_contact'=>$pcontact,
		'emergency_contact'=>$econtact,
		'email'=>$email,
		'addressline1'=>$addressline1,
		'addressline2'=>$addressline2, 
	     'suburban'=>$suburban,
		'country'=>$country,
		'city'=>$city,
		'postcode'=>$postcode,
		'state'=>$state,
		'photo_id'=>$image
				);
		$this->vmk_model->insert_data($table,$data);
		redirect('/user_controller/contact_view/dedicator','referesh');
	}
public function contact_view($page) {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		
		 $this->load->view('templates/header', $data);
		 $data['height']='ss';
		 $this->load->view('pages/contact_us/contact_us',$data);
		 if($page=='client')
		 {
		 $table='clients';
		 $data['contact']=$this->vmk_model->get_data($table);
		 $this->load->view('pages/contact_us/view_client',$data);
		 }
		else  if($page=='staff')
		 {
		 $table='addnewemployee';
		 $data['contact']=$this->vmk_model->get_data($table);
		 $this->load->view('pages/contact_us/view_staff',$data);
		 }
		 else if($page=='dedicator')
		 {
		 $table='contact_us';
		 $data['contact']=$this->vmk_model->get_data($table);
		 $this->load->view('pages/contact_us/view_dedicator',$data);
		
		 }
		 
	     $this->load->view('templates/footer', $data);
	}
	
	/* marketing */
	public function marketing() {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
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
	 $collection=json_decode($data['permission'][0]['marketing'],TRUE);
	}
	
			if (in_array('marketing',$collection))
			{
		 $data['height']='height';
		  $this->load->view('pages/marketing/marketing_menu',$data);
			}
			else
			{
				$this->load->view('templates/unauthorized');
			}
		  $this->load->view('templates/footer', $data);
	}
	public function travaling($id,$user_name) {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		
		 $this->load->view('templates/header', $data);
		 $data['height']='ss';
		  $this->load->view('pages/marketing/marketing_menu',$data);
		  $data['id']=$id;
		   $data['user_name']=$user_name;
		  $this->load->view('pages/marketing/marketing_travelling',$data);
		  $this->load->view('templates/footer', $data);
	}
	public function marketing1($page,$page1) {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		
		 $this->load->view('templates/header', $data);
		 $data['height']='ss';
		 $this->load->view('pages/marketing/marketing_menu',$data);
		 if($page=='marketing_clients')
		 {
		 $table='marketing_client';
		 $data['contact']=$this->vmk_model->get_data($table);
		$this->load->view('pages/marketing/'.$page1,$data);
		 }
		else  if($page=='marketing_appointments')
		 {
		 $table='marketing_appointments';
		 $data['contact']=$this->vmk_model->get_data($table);
		 $this->load->view('pages/marketing/'.$page1,$data);
		 }
		 else if($page=='marketing_travelling')
		 {
		 $table='marketing_travelling';
		 $data['contact']=$this->vmk_model->get_data($table);
		$this->load->view('pages/marketing/'.$page1,$data);
		
		 }
		 
	     $this->load->view('templates/footer', $data);
	}
	
	public function marketing2($page) {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		
		 $this->load->view('templates/header', $data);
		 $data['height']='ss';
		 $this->load->view('pages/marketing/marketing_menu',$data);
		 if($page=='marketing_clients')
		 {
			 $oname = $this->input->post("oname");
			 $oaddress = $this->input->post("oaddress");
			 $ocon = $this->input->post("ocon");
			 $oemail = $this->input->post("oemail");
			
			 $fname = $this->input->post("fname");
		  $fname = $this->input->post("fname");
       $lname = $this->input->post("lname");
	  $phone = $this->input->post("phone");
	
	    $emailid = $this->input->post("emailid");
	    $addressline1 = $this->input->post("address1");
		 $addressline2 = $this->input->post("address1");
		 $suburban = $this->input->post("sub");
		 $country = $this->input->post("country");
		 $city = $this->input->post("city");
		 $state = $this->input->post("state");
		 $postcode = $this->input->post("postcode");
		$desig = $this->input->post("desig");
		$morg = $this->input->post("morg");
		$mname = $this->input->post("mname");
		$maddress = $this->input->post("maddress");
		$mcon = $this->input->post("mcon");
		$memail = $this->input->post("memail");
	
		$table='marketing_client';
		$data=array(
		
		'organization_name'=>$oname,
		'organization_address'=>$oaddress,
		'organization_contact'=>$ocon,
		'organization_email'=>$oemail,
		'person_first_name'=>$fname,
		'person_last_name'=>$lname,
		'person_email'=>$emailid,
		'person_address_line1'=>$addressline1,
		'person_addressline2'=>$addressline2, 
	     'person_suburban'=>$suburban,
		'person_country'=>$country,
		'person_state'=>$state,
		'person_city'=>$city,
		'person_postcode'=>$postcode,
		'person_phone_no'=>$phone,
		'person_designation'=>$desig,
	    'mediator_organization'=>$morg,
		'mediator_name'=>$mname,
		'mediator_address'=>$maddress,
		'mediator_contact_no'=>$mcon,
		'mediato_email'=>$memail
			);
		$this->vmk_model->insert_data($table,$data);
		redirect('/user_controller/marketing1/marketing_clients/marketing_clients','referesh');
		 }
		else  if($page=='marketing_appointments')
		 {
		 $pname = $this->input->post("pname");
		  $oname = $this->input->post("oname");
		   $date = $this->input->post("date");
   $rapp = $this->input->post("rapp");
	  $time = $this->input->post("time");
	   $time_in = $this->input->post("time_in");
	   $table='marketing_appointments';
		$limit=1;
		$where=array('user_name'=>$username);
		$data['trackno']=$this->vmk_model->no_rows($table,$where);
		if($data['trackno']==0)
		{
			$appno='MA_1';
		}
		else
		{
		$intial=$this->vmk_model->last_record($table,$where,$limit);
		$value=trim($intial[0]['appointment_no']);
		$new_value=explode("_",$value);
		$id=$new_value[1];
		$j=$id+1;
		$appno='MA_'.$j;
		}
		$table='marketing_appointments';
		$data=array(
		
		'person_name'=>$pname,
		'organization_name'=>$oname,
		'date'=>$date,
		'time'=>$time.' '.$time_in,
		'result_of_appointment'=>$rapp,
		'appointment_no'=>$appno,
		'user_name'=>$username
				);
		$this->vmk_model->insert_data($table,$data);
		redirect('/user_controller/marketing1/marketing_travelling/marketing_appointments','referesh');
		 }
		 else if($page=='marketing_travelling')
		 {
		 $sdate = $this->input->post("sdate");
		  $edate = $this->input->post("edate");
		   $appno = $this->input->post("appno");
		  $uname = $this->input->post("uname");
   $oname = $this->input->post("oname");
	
	   $pcontact = $this->input->post("pcontact");
	    $start = $this->input->post("start");
	    $des = $this->input->post("des");
		 $mode = $this->input->post("mode");
		 $expen = $this->input->post("expen");
		
		
		$table='marketing_travelling';
		$data=array(
		
		'starting_date'=>$sdate,
		'ending_date'=>$edate,
		'organization_name'=>$oname,
		'contact_person_number'=>$pcontact,
		'starting_place'=>$start,
		'destination'=>$des,
		'mode_of_transport'=>$mode,
		'expenses'=>$expen,
	   'appointment_no'=>$appno,
		'user_name'=>$uname
				);
		$this->vmk_model->insert_data($table,$data);
		redirect('/user_controller/marketing1/marketing_travelling/marketing_travelling_view','referesh');
		
		 }
		 
	     $this->load->view('templates/footer', $data);
	}
	public function appointement_delete($sno) {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		 $table='marketing_appointments';
		 $where=array('sno'=>$sno);
		$this->vmk_model->delete_data($table,$where);
		 $this->load->view('templates/header', $data);
		  $data['height']='ss';
		  $this->load->view('pages/marketing/marketing_menu',$data);
		   $table='marketing_appointments';
		 $data['contact']=$this->vmk_model->get_data($table);
		   $this->load->view('pages/marketing/marketing_appointments_view',$data);
		  $this->load->view('templates/footer', $data);
	}
	public function appointement_edit($sno) {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
		 $table='marketing_appointments';
		 $where=array('sno'=>$sno);
		$data['edit']=$this->vmk_model->get_where_data($table,$where);
		 $this->load->view('templates/header', $data);
		  $data['height']='ss';
		  $this->load->view('pages/marketing/marketing_menu',$data);
		 $data['sno']=$sno;
		   $this->load->view('pages/marketing/marketing_appointments_edit',$data);
		  $this->load->view('templates/footer', $data);
	}
	public function marketing_appointments_update($sno) {
		$username = $this->username;
		$dept = $this->dept;
         $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		 $data["username"] = $username;
		 $data["usertype"] = $dept;
	
		 $pname = $this->input->post("pname");
		  $oname = $this->input->post("oname");
		   $date = $this->input->post("date");
   $rapp = $this->input->post("rapp");
	  $time = $this->input->post("time");
	   $time_in = $this->input->post("time_in");
	   
		$table='marketing_appointments';
		$where=array('sno'=>$sno);
		 $appno=$this->vmk_model->get_where_data($table,$where);
		$data=array(
		
		'person_name'=>$pname,
		'organization_name'=>$oname,
		'date'=>$date,
		'time'=>$time.' '.$time_in,
		'result_of_appointment'=>$rapp,
		'appointment_no'=>$appno[0]['appointment_no'],
		'user_name'=>$username
		);
		$this->vmk_model->insert_data($table,$data);
		redirect('/user_controller/marketing1/marketing_appointments/marketing_appointments_view','referesh');

	}
}

