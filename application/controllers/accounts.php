<?php
class accounts extends CI_Controller {

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

public function index()
{    
	 $dept = $this->session->userdata('usertype');
	     $data["usertype"] = $dept;
		  $username = $this->session->userdata('username'); 
		 $data["username"] = $username;
		
	$data['min_height']='min_height';
	$this->load->view('templates/header',$data);
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
	
	 $collection=json_decode($data['permission'][0]['accounts'],TRUE);
	}
	
	
			if (in_array('accounts',$collection))
			{
	
	$this->load->view('pages/accounts/accounts',$data);
			}
			else
			{
				 $this->load->view('templates/unauthorized'); 	
			}
	$this->load->view('templates/footer');
	
}
	
public function view($page)
{
	 
	$data['username']=$this->username;
	$data['usertype']=$this->dept;
	
	
	if($page=='paybill')
	{
		$table='expenses';
		$data['expenses']=$this->vmk_model->get_condition($table);
		//print_r($data['zero_bill']);
	}
	else if($page=='payinvoice')
	{
		$table='invoices';
		$data['invoices']=$this->vmk_model->get_condition($table);
	}
	else if($page=='show_exp')
	{
		$table='expenses';
		$data['expenses']=$this->vmk_model->get_data($table);
		if($data['expenses'] == NULL)
		{
			$data['expenses'] = array('title' =>'no record display');
		}
	}
	else if($page=='show_invoice')
	{
		$table='invoices';
		$data['invoice']=$this->vmk_model->get_data($table);
		if($data['invoice'] == NULL)
		{
			$data['invoice'] = array('title' =>'no record display');
		}
				
	}
	$this->load->view('templates/header',$data);
	$data['min_height']='no';
	$this->load->view('pages/accounts/accounts',$data);
	$this->load->view('pages/accounts/'.$page,$data);
	$this->load->view('templates/footer');
}

public function add_bill()
{

  $item=$this->input->post('bill_type');
  $invoice_no=$this->input->post('invoice_no');
	//echo $item.'<br/>';
	$desc=$this->input->post('desc');
	//echo $desc.'<br/>';
	$amount_type=$this->input->post('amount_type');
	//echo $amount_type.'<br/>';
	$amount=$this->input->post('total_amount');
	//echo $amount.'<br/>';
	$title=$this->input->post('bill_title');
	//echo $title.'<br/>';
    $table='expenses';
		$limit=1;
		$where=array('amount_type'=>$amount_type);
		$data['trackno']=$this->vmk_model->no_rows($table,$where);
		if($data['trackno']==0)
		{
	if($amount_type=='$')
	{
		$bill_id='AUS_MEL_EXP_1';
	}
	else
	{
	 	$bill_id='IND_HYD_EXP_1';
	}
		}
		else
		{
	$table='expenses';
	$limit=1;
	$where=array('amount_type'=>$amount_type);
	$intial=$this->vmk_model->get_last_record($table,$where,$limit);
	$value=trim($intial[0]['bill_id']);
	//echo $value.'<br/>';
	$new_value=explode("_",$value);
	//echo $new_value[3];
	$id=$new_value[3];
	if($amount_type=='$')
	{
		$bill_id='AUS_MEL_EXP_'.($id+1);
	}
	else
	{
	 	$bill_id='IND_HYD_EXP_'.($id+1);
	}
	//echo $bill_id;
	
		}
		$date=date('Y-m-d');
	$table='expenses';
	$data=array("bill_id" => $bill_id,
				"bill_title" => $title,
				"invoice_no" => $invoice_no,
				"bill_desc" => $desc,
				"bill_type" => $item,
				"bill_date" => $date,
				"amount_type" => $amount_type,
				"total_amount" => $amount,
				);
				//print_r($data);
	$this->vmk_model->insert_data($table,$data);
	redirect('/accounts' , 'refresh');
	
}

public function show_data($bill_id)
{
	
	$data['username']=$this->username;
	$data['usertype']=$this->dept;
	
	$table='expenses';
	$where=array('bill_id' => $bill_id);
	$data['bill_data']=$this->vmk_model->get_where_data($table,$where);
	//print_r($data['bill_data']);
	$this->load->view('templates/header',$data);
	$data['min_height']='no';
	$this->load->view('pages/accounts/accounts',$data);
	$this->load->view('pages/accounts/pay_details',$data);
	$this->load->view('templates/footer');
}	

public function bill_modify($bill_id)
{
	$data['username']=$this->username;
	$data['usertype']=$this->dept;
	
	$total_bal=$this->input->post('pay');	
	//echo $total_bal;
	$paid_old=$this->input->post('paid_amount');
	//echo $paid_old;
	$total_amount=$this->input->post('total_amount');
	//echo $total_amount;
	$paid_amount=($paid_old+$total_bal);
	//echo $paid_amount;
	$old_paid=$this->input->post('old_paid');
	//echo $old_paid;
	$sno=$this->input->post('sno');
	$i=$this->input->post('array_index');
	if($total_amount<$total_bal)
	{
		
		redirect('/accounts/show_data/'.$bill_id, 'refresh');
	}
	else
	{
	
	if($total_amount==$paid_amount)
	{
		$ease_paid=1;
	
	}
	else if($total_amount>$paid_amount)
	{
		$ease_paid=2;
	}
	else
	{
		$ease_paid=0;
	}
	//echo $ease_paid;
	if($old_paid == '')
	{
		$table='expenses';
		$date=date('Y-m-d');
		$paid=array('1'=>array('a' => $paid_amount,'b' => $date));
		//print_r($paid);
		$new_paid=json_encode($paid);
	
		$table='expenses';
	$where=array('sno' => $sno);
	$data=array("paid_amount" => $new_paid,
				"ease_paid" => $ease_paid
					);
		$this->vmk_model->update_data($table,$data,$where);
	}
else
	{
	$date=date('Y-m-d');
	$table='expenses';
	$where=array('bill_id' => $bill_id);
	$pay_data=$this->vmk_model->get_where_data($table,$where);
	$pay1=$pay_data[0]['paid_amount'];
	//echo $suresh;
	$pay2=json_decode($pay1,true);
	//print_r($naresh);
	$pay3=array('a' => $total_bal,'b' => $date);
	//print_r($sri);
	array_push($pay2,$pay3);
	//print_r($naresh);
	$pay4=json_encode($pay2);
	//echo $nandini;
	$table='expenses';
	$where=array('bill_id' => $bill_id);
	$data=array("paid_amount" => $pay4,
				"ease_paid" => $ease_paid
				);
	$this->vmk_model->update_data($table,$data,$where);
	}
	redirect('/clear_bill' , 'refresh');
	}
}
public function print_bill($bill_id)
{
	$data['username']=$this->username;
	$data['usertype']=$this->dept;
	
	$table='expenses';
	$where=array('bill_id' => $bill_id);
	$data['bill_data']=$this->vmk_model->get_where_data($table,$where);
	//print_r($data['bill_data']);
	$this->load->view('templates/header',$data);
	$data['min_height']='no';
	$this->load->view('pages/accounts/accounts',$data);
	$this->load->view('pages/accounts/print_bill',$data);
	$this->load->view('templates/footer');
}	



		/* invoices begin */
public function add_invoice()
{	
	$desc=$this->input->post('desc');
	//echo $desc.'<br/>';
	$amount_type=$this->input->post('amount_type');
	//echo $amount_type.'<br/>';
	$amount=$this->input->post('total_amount');
	//echo $amount.'<br/>';
	$title=$this->input->post('invoice_title');
	//echo $title.'<br/>';
	$invoice_no=$this->input->post('invoice_no');
	$domain=$this->input->post('domain');
	
	$pro_id=$this->input->post('project_id');
	$table='invoices';
		$limit=1;
		$where=array('amount_type'=>$amount_type);
		$data['trackno']=$this->vmk_model->no_rows($table,$where);
		if($data['trackno']==0)
		{
			if($amount_type=='$')
	{
		$invoice_id='AUS_MEL_INC_1';
	}
	else
	{
	 	$invoice_id='IND_HYD_INC_1';
	}
		}
		else
		{
	$table='invoices';
	$limit=1;
	$where=array('amount_type'=>$amount_type);
	
	$intial=$this->vmk_model->get_last_record1($table,$where,$limit);
	$value=trim($intial[0]['invoice_id']);
	//echo $value.'<br/>';
	$new_value=explode("_",$value);
	//echo $new_value[3];
	$id=$new_value[3];
	if($amount_type=='$')
	{
		$invoice_id='AUS_MEL_INC_'.($id+1);
	}
	else
	{
	 	$invoice_id='IND_HYD_INC_'.($id+1);
	}
	//echo $invoice_id;
		}
	$date=date('Y-m-d');
	$table='invoices';
	$data=array("invoice_id" => $invoice_id,
				"invoice_title" => $title,
				"invoice_no" => $invoice_no,
				"invoice_desc" => $desc,
				"invoice_date" => $date,
				"amount_type" => $amount_type,
				"total_amount" => $amount,
				"domain_name" => $domain,
				"project_id" => $pro_id
				);
				//print_r($data);
	$this->vmk_model->insert_data($table,$data);
	
	redirect('/accounts' , 'refresh');
	
}

public function show_data_invoice($invoice_id)
{
	
	$data['username']=$this->username;
	$data['usertype']=$this->dept;
	
	$table='invoices';
	$where=array('invoice_id' => $invoice_id);
	$data['invoice_data']=$this->vmk_model->get_where_data($table,$where);
	//print_r($data['bill_data']);
	$this->load->view('templates/header',$data);
	$data['min_height']='no';
	$this->load->view('pages/accounts/accounts',$data);
	$this->load->view('pages/accounts/pay_invoice_details',$data);
	$this->load->view('templates/footer');
}	

public function invoice_modify($invoice_id)
{
	$data['username']=$this->username;
	$data['usertype']=$this->dept;
	
	$total_bal=$this->input->post('pay');	
	//echo $total_bal;
	$paid_old=$this->input->post('paid_amount');
	//echo $paid_old;
	$total_amount=$this->input->post('total_amount');
	//echo $total_amount;
	$paid_amount=($paid_old+$total_bal);
	//echo $paid_amount;
	$old_paid=$this->input->post('old_paid');
	//echo $old_paid;
	$amount_type=$this->input->post('amount_type');
	$sno=$this->input->post('sno');
	$i=$this->input->post('array_index');
	if($total_amount<$total_bal)
	{
	 redirect('/accounts/show_data_invoice/'.$invoice_id, 'refresh');
	}
	else
	{
	if($total_amount==$paid_amount)
	{
		$ease_paid=1;
		$table = 'incomes';
		$date=date('Y-m-d');
		$data = array(
				"ref_id" => $invoice_id,
				"income_type" => 'invoices',
				"date" => $date,
				"total_amount" => $total_amount,
				"amount_type" => $amount_type
				);		
     $this->vmk_model->insert_data($table,$data);
	
	}
	else if($total_amount>$paid_amount)
	{
		$ease_paid=2;
	}
	
	else
	{
		$ease_paid=0;
	}
	//echo $ease_paid;
	if($old_paid == '')
	{
		$table='invoices';
		$date=date('Y-m-d');
		$paid=array('1'=>array('a' => $paid_amount,'b' => $date));
		//print_r($paid);
		$new_paid=json_encode($paid);
	
		$table='invoices';
	$where=array('sno' => $sno);
	$data=array("paid_amount" => $new_paid,
				"ease_paid" => $ease_paid
					);
		$this->vmk_model->update_data($table,$data,$where);
	}
else
	{
	$date=date('Y-m-d');
	$table='invoices';
	$where=array('invoice_id' => $invoice_id);
	$pay_data=$this->vmk_model->get_where_data($table,$where);
	$pay1=$pay_data[0]['paid_amount'];
	//echo $suresh;
	$pay2=json_decode($pay1,true);
	//print_r($naresh);
	$pay3=array('a' => $total_bal,'b' => $date);
	//print_r($sri);
	array_push($pay2,$pay3);
	//print_r($naresh);
	$pay4=json_encode($pay2);
	//echo $nandini;
	$table='invoices';
	$where=array('invoice_id' => $invoice_id);
	$data=array("paid_amount" => $pay4,
				"ease_paid" => $ease_paid
				);
	$this->vmk_model->update_data($table,$data,$where);
	}
	redirect('/clear_invoice' , 'refresh');
	}
}


/* incomes and investment*/

public function new_income()
 { 
    $id = 0;      
    $incometype = $this->input->post('type');  
    $create_date = $this->input->post('created_date');   
    $clear_date = $this->input->post('clear_date');     
    $amount = $this->input->post('amount');
    $amount_type = $this->input->post('amount_type');
      $limit=1;
   $table='incomes';
   $where=array('amount_type' => $amount_type);
   $lastrec= $this->vmk_model->last_record($table,$where,$limit);     
   
   $value = trim($lastrec[0]['ref_id']);
   $new_value=explode("_",$value);
   $id=$new_value[3];
   if($amount_type == '$')
   {
   $ref_id='AUS_MEL_INC_'.($id+1);
   }
   else
   {
    $ref_id='IND_HYD_INC_'.($id+1);
   }
    
      $table = 'incomes';
      $data = array('sno'=> '','ref_id' => $ref_id,'income_type' => $incometype,'create_date' => $create_date, 
      'clear_date' => $clear_date,'total_amount'=>$amount ,'amount_type' => $amount_type);     
      $this->vmk_model->insert_data($table,$data);
         redirect('accounts/view/new_income','refresh') ; 
 }
  public function view_incomes()
  {
   $data['username']=$this->username;
     $data['usertype']=$this->dept;
 
   $table = 'incomes';
    $data['incomes'] = $this->vmk_model->get_data($table);
 
     $this->load->view('templates/header',$data); 
	$data['min_height']='no';
	$this->load->view('pages/accounts/accounts',$data); 
  $this->load->view('pages/accounts/view_incomes',$data);
  $this->load->view('templates/footer');
 }
 public function print_income($income_id)
{
	$data['username']=$this->username;
	$data['usertype']=$this->dept;
	
	$table='incomes';
	$where=array('ref_id' => $income_id);
	$data['income_data']=$this->vmk_model->get_where_data($table,$where);
	//print_r($data['bill_data']);
	$this->load->view('templates/header',$data);
	$data['min_height']='no';
	$this->load->view('pages/accounts/accounts',$data);
	$this->load->view('pages/accounts/print_income',$data);
	$this->load->view('templates/footer');
}	
 
 public function new_investment()
 { 
  
      $config['upload_path']   = './uploads';
      $config['allowed_types'] = 'gif|JPEG|jpg|png|xls|xlsx|php|pdf';
      $config['max_size']   = '4000'; 
      $config['encrypt_name']  = TRUE;
      $this->upload->initialize($config);
      $uploaded = $this->upload->up(TRUE);   
  
      $count = 0;
      $table='investments';
      $image=$uploaded['success'][0]['file_name'];

 
      $date = date('y-m-d');
      $amount = $this->input->post('amount'); 
      $amount_type = $this->input->post('amount_type');  
	 
      $amount_desc = $this->input->post('desc');
      $inverster = $this->input->post('invester');
  $table='investments';
		$limit=1;
		$where=array('amount_type'=>$amount_type);
		$data['trackno']=$this->vmk_model->no_rows($table,$where);
		if($data['trackno']==0)
		{
			if($amount_type=='$')
   {
   $ref_id='AUS_MEL_INV_1';
   }
   else
   {
    $ref_id='IND_HYD_INV_1';
   }
		}
		else
		{
   $limit=1;
   $table='investments';
   $where=array('amount_type'=>$amount_type);;
   $lastrec= $this->vmk_model->last_record($table,$where,$limit);
   $value=trim($lastrec[0]['ref_id']);
   $new_value=explode("_",$value);
   $id=$new_value[3];  
   if($amount_type=='$')
   {
   $ref_id='AUS_MEL_INV_'.($id+1);
   }
   else
   {
    $ref_id='IND_HYD_INV_'.($id+1);
   }
      
		}
        $table='investments';
       
	    $data = array('ref_id' => $ref_id,'invester' => $inverster,'amount' => $amount, 
        'date' => $date,'amount_type'=> $amount_type ,'amount_desc' =>  $amount_desc, 'amount_proof' => $image);     
        $this->vmk_model->insert_data($table,$data);
		
		$table = 'incomes';
		$data = array("sno" => '',
				"ref_id" => $ref_id,
				"income_type" => 'investments',
				"date" => $date,
				"total_amount" => $amount,
				"amount_type" => $amount_type
				);		
     $this->vmk_model->insert_data($table,$data);
	 redirect('accounts/view_investment' ,'refresh');
 }
 
 
 public function view_investment() 
 {
	
     $data['username']=$this->username;
     $data['usertype']=$this->dept;
     $table = 'incomes';
      $data['incomes'] = $this->vmk_model->get_data($table);
  
    $table = 'investments';
    $data['investments'] = $this->vmk_model->get_data($table);
  
     $this->load->view('templates/header',$data);
	$data['min_height']='no';
	$this->load->view('pages/accounts/accounts',$data);
  $this->load->view('pages/accounts/view_investment',$data);
  $this->load->view('templates/footer');
 }
public function myaccount() 
{
   $username = $this->session->userdata('username');
     $data['username']=$this->username;
     $data['usertype']=$this->dept;
     $table = 'investments';
	 $where=array('invester'=>$username);
    $data['myaccount']=$this->vmk_model->get_where_data($table,$where);
     $this->load->view('templates/header',$data);
	$data['min_height']='no';
	$this->load->view('pages/accounts/accounts',$data);
  $this->load->view('pages/accounts/view_myaccount',$data);
  $this->load->view('templates/footer');
 }
public function search_project_id()
	{
		 $term = $this->input->post('term',TRUE);
		 if (strlen($term) < 1) break;
		 $rows = $this->vmk_model->GetAutocomplete(array('keyword' => $term));
		 $json_array = array();
		 foreach ($rows as $row)
		 array_push($json_array, $row->id);
		 echo json_encode($json_array); 
		
	}
	public function search_employee_name()
	{
		 $term = $this->input->post('term',TRUE);
		 if (strlen($term) < 1) break;
		 $rows = $this->vmk_model->GetAutocomplete_employee_name(array('keyword' => $term));
		 $json_array = array();
		 foreach ($rows as $row)
		 array_push($json_array, $row->name);
		 echo json_encode($json_array); 
		
	}
public function wages_submit()
 { 
    $name = $this->input->post('name');  
    $id = $this->input->post('id');   
    $sal_amount = $this->input->post('sal_amount');     
    $start = $this->input->post('start');
	$end = $this->input->post('end');
	$desc = $this->input->post('desc');
	$table = 'salaries';
		$data = array(
				"employee_name" => $name,
				"employee_id" => $id,
				"salary_amount" => $sal_amount,
				"starting_date" => $start,
				"ending_date" => $end,
				"description" => $desc
				);		
     $this->vmk_model->insert_data($table,$data);
	 redirect('accounts/view_wages' ,'refresh');

 }
 public function view_wages()
 {
	  $data['username']=$this->username;
     $data['usertype']=$this->dept;
    
    $table = 'salaries';
    $data['wages'] = $this->vmk_model->get_data($table);
  
     $this->load->view('templates/header',$data);
	$data['min_height']='no';
	$this->load->view('pages/accounts/accounts',$data);
  $this->load->view('pages/accounts/view_wages',$data);
  $this->load->view('templates/footer');
 }
 
}