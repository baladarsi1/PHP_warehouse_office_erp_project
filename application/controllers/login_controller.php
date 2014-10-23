<?php

class login_controller extends CI_Controller {

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
	
	public function user_check()//controller or user input,step1:user enter the name,password and type(here input give to db using post
	{
	 $username = $this->input->post("uname");
	 $pwd = $this->input->post("pwd");
     $dep = $this->input->post("dep");
	
	  $data = array(
	  'username'=>$username,
	  'password'=>$pwd,
	  'type'=>$dep
	  );
	  $table='users';
$data['noofrows'] = $this->vmk_model->no_rows($table,$data);//this model checks the given input authorized r not(only calling) 

     if($data['noofrows']==0)//verification authorizerd r not
	 {
		$data["message"]="* PLEASE LOGIN AGAIN";
		$this->load->view('pages/login_form/loginhome', $data);
	 }
	 else
	 {
		 $this->session->set_userdata('username', $username);
		  $username = $this->session->userdata('username');  
		  $this->session->set_userdata('usertype', $dep);//usertype is userdefined is set to $dep  
		  $dept = $this->session->userdata('usertype'); //$dept is a user defined variable 
		  $data["username"] = $username;
		 $data["usertype"] = $dept;
	redirect('user_controller/home/all','referesh');
	 }
	}
	public function delete_sess()
	{
		
		$this->session->sess_destroy();
		$data["message"]="* LOGOUT SUCCESSFULLY ";
		$this->load->view('pages/login_form/loginhome', $data);
		
	}
	
}