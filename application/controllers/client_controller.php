<?php

class client_controller extends CI_Controller 
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
		$this->data = array("username" =>$this->username,"usertype" => $this->dept);
		
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
	 //to click an project to open this function  
	public function client_projects()
	{
		
		$username = $this->session->userdata('username');
		$this->username = $username;
		$dept = $this->session->userdata('usertype');
		$this->dept = $dept;
		  $data["usertype"] = $dept; 
		   $data["username"] = $username; 
		$table='projects';
	   $where=array('client_name'=>$username);	
	 $data['project_information'] = $this->vmk_model->get_where_data($table,$where);
	 $this->load->view('templates/header', $data);
	 $this->load->view('pages/projects/project_list', $data); // calling data from form 
	 $this->load->view('templates/footer', $data);
	}
	//client menu
	public function suggestions()
	{
	
	$dept = $this->session->userdata('usertype');
	$data["usertype"] = $dept;
	$username = $this->session->userdata('username'); 
	$data["username"] = $username;
	$this->load->view('templates/header' , $data);
	$data['height']='height';//to write css purpose
	$this->load->view('pages/clients/client_menu', $data);
	
	$this->load->view('templates/footer' , $data);
	}
	//client  Registration form
	public function suggestions1()
	{
	
	$dept = $this->session->userdata('usertype');
	$data["usertype"] = $dept;
	$username = $this->session->userdata('username'); 
	$data["username"] = $username;
	$this->load->view('templates/header' , $data);
		$data['height']='ss';//to write css error remove purpose
	$this->load->view('pages/clients/client_menu', $data);
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
	 $collection=json_decode($data['permission'][0]['clients'],TRUE);
	}
	
			if (in_array('registration',$collection))
			{
	
		
		$this->load->view('pages/clients/clientsuggestionsform', $data);
	}
	else
			{
				$this->load->view('templates/unauthorized'); // calling data from form 
			}
	$this->load->view('templates/footer' , $data);
	}
	//registration form submit either client or management(if client not enter our details management add due to add new project client details enter purpose)
		public function suggestions_form_submit()
	{
		$dept = $this->session->userdata('usertype');
	    $data["usertype"] = $dept;
		$username = $this->session->userdata('username'); 
	    $data["username"] = $username;
		$fname = $this->input->post("fname");
		$lname = $this->input->post("lname");
		
		$mno = $this->input->post("mno");
		$eno = $this->input->post("eno");
		$email = $this->input->post("email");
		$address1 = $this->input->post("address1");
		$address2 = $this->input->post("address2");
		$state = $this->input->post("state");
		$city = $this->input->post("city");
		$sub = $this->input->post("sub");
		$postcode = $this->input->post("postcode");
		$country = $this->input->post("country");
		$maindomain = $this->input->post("maindomain");
		
		
		
		
			
			$table='clients';
		             $limit=1;
				
		            $data['trackno']=$this->vmk_model->no_rows1($table);
					
		     if($data['trackno']==0)
		             {
			           $client_id='VMK'.'1'.'/'.$fname;
					
		             }
		        else
		             {
						 	 $intial=$this->vmk_model->last($table,$limit);
					      $client_id=$intial[0]['client_user_id'];
						 $where=array('client_user_id'=>$client_id);
		                $intial1=$this->vmk_model->last_record($table,$where,$limit);
		                $value=$intial1[0]['client_user_id'];
						$new_value=explode("/",$value);
						$new_value1=explode("VMK",$new_value[0]);
						
						$id=$new_value1[1];
		                $new_id=$id+1;
						$client_id='VMK'.$new_id.'/'.$fname; 
						
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

$data=array(
'sno'=>' ',
'employee_name'=>$client_id,
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

		$table='clients';			 
	
		$data=array('client_user_id'=>$client_id , 'first_name'=>$fname , 'last_name'=>$lname,'mobile_number'=>$mno,'emergency_contact_no'=>$eno,'email'=>$email,'address_line1'=>$address1 , 'address_line2'=>$address2 , 'state'=>$state, 'city'=>$city,'suburb'=>$sub , 'postcode'=>$postcode , 'country'=>$country, 'main_domain'=>$maindomain);
		
		$this->vmk_model->insert_data($table,$data);
		
/*$body ='<div style="font-family:"Trebuchet MS",sans-serif,Arial;">'.'<div>Dear Mr/Mrs'.' '.$fname.'<div style="padding:15px 0;">This is the conformation of your successful registration with VMK software solutions Private Limited as a client and your client Identification number is'.$client_id.'</div><div>Please verify your details<div>'.
'<div> First name:'.$fname.'</div>'.
'<div>Last name:'.$lname.'</div>'.
'<div>Company name:vmk'.'</div>'.
'<div>Domain name:'.$maindomain.'</div>'.
'<div>Contact number:'.$mno.'</div>'.'<div style="padding-top:15px;">If you notice any of your given details are wrongly displayed above, please bring it to our attention contacting us at Info@vmksoftwaresolutions.com'.'</div>
<div  style="padding-top:15px;">If Your Project will registerd after Find your project track as well as any modifications for your project please go through my site and login.</div><div  style="padding-top:10px;">
Your Login Details:</div><div>Username:'.$client_id.'</div><div>Password: '.$fname.'1'.'</div><div>Type: Clients</div><div style="padding-top:20px;"><i>'.'<div>Regards</div>'."<div>".'VMK Management'."</div>".'<div>#8/2/268/1/B/12,</div>'.'<div>Aurora Colony,</div>'.'<div>Banjara Hills,</div>'.'<div>Road No: 3,</div>'.'<div>Hyderabad,</div>'.'<div>Andhra Pradesh,</div>'.'<div>India</div>'.'<div>PIN Code: 500034 </div>'.'<div>Contact Numbers:  +91 40-64644891</div>'.'<div>+91 40-64634891</div>'.'<div>+91 9849674891</div>'.'<div>Email: Info@vmksoftwaresolutions.com</div></div></i></div>';*/

$body ='<div style="font-family:"Trebuchet MS",sans-serif,Arial;">'.'<div>Hi, </div><div style="padding:15px 0;">This is the conformation of a successful registration with VMK software solutions Private Limited. And the client Identification number is'.$client_id.'</div><div>Details are as Below<div>'.
'<div> First name:'.$fname.'</div>'.
'<div>Last name:'.$lname.'</div>'.
'<div>Domain name:'.$maindomain.'</div>'.
'<div>Contact number:'.$mno.'</div></div>';

/*$sub='Your client registration number is'.$client_id;*/
$sub='VMK New Client registration';
    $this->email->clear();
$this->email->to('baladarsi1@gmail.com,v.v.kishorechowdary@gmail.com,mangakiran.v@gmail.com,mettukuru.sreekanth@gmail.com');
		
    /*$this->email->to($email);*/
    $this->email->from('info@vmksoftwaresolutions.com');
    $this->email->subject($sub);
    $this->email->message($body);
    $this->email->send();
	
	$table='users';
	$data=array(
	'sno'=>' ',
	'username'=>$client_id,
	'password'=>$fname.'1',
	'type'=>'Clients',
	'user_id'=>$client_id
	
	);
	$this->vmk_model->insert_data($table,$data);
		$client_id1 = str_replace("/","-",$client_id);//url / taken as to use another parameter then url showing replace / to -
	    redirect('/client_controller/show_client_id/'.$client_id1, 'refresh');
		
	
}
public function show_client_id($id)  //if managent entered the client data then redirect to in this function
	{
		
	$clientid1 = str_replace("-","/",$id);//after cross the url again replace to /
    $clientid = str_replace("%20"," ",$clientid1);//if client name any sapces occured then %20 is space to remove those sapces
	$dept = $this->session->userdata('usertype');
    $data["usertype"] = $dept;
	$username = $this->session->userdata('username'); 
	$data["username"] = $username;
	
	$data['msg1']='"Your Form Is Successfully Submited"'.'<br>'.'The Generated Client Id Is ';	
	$data['msg']='<br>'.'"'.$clientid.'"';	
	$data['message']='';
	$table='users';
	$names = array('VMK_Employee', 'General_Manager', 'Managing_Director');
	$data['user_name'] = $this->vmk_model->gets($table,$names);	
	$this->load->view('templates/header', $data);
	$this->load->view('pages/projects/add_project', $data); // calling data from form 
	$this->load->view('templates/footer', $data);
	}
	
	//management login show all clients datas but client enterd  see those details only
	public function view_suggestions()
	{
		$table='clients';
	$data['entry'] = $this->vmk_model->get_data($table);
	 
	  $page1 = "view_suggestions";
	 $username = $this->session->userdata('username'); 
	 $data["username"] = $username;
	 
		 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
	$data['height']='ss';
	
	$this->load->view('templates/header' , $data);
	$this->load->view('pages/clients/client_menu', $data);
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
	 $collection=json_decode($data['permission'][0]['clients'],TRUE);
	}
	
			if (in_array('client_details',$collection))
			{
				
		
	
	 $table='clients';
	 if($dept=='Clients')//depending on client name to retrive the client detalis
	 {
		 $where=array('client_user_id'=>$username);
	$data['entry'] = $this->vmk_model->get_where_data($table,$where);
	
	 }
	 else{ //else management see all client details
		 $data['entry'] = $this->vmk_model->get_data($table);
	 }
	
	 $this->load->view('pages/clients/'.$page1, $data);
			}
			else
			{
				$this->load->view('templates/unauthorized'); // calling data from form 
			}
	 $this->load->view('templates/footer', $data);
	
		}
}

