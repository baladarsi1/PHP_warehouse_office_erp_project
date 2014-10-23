<?php
class Vmk_model extends CI_Model {

	public function __construct()//database calling
	{
		$this->load->database();
	}
	
	public function get_data($table)
	{
		$query = $this->db->get($table);
	 	return $query->result_array();
	}
	public function get_condition($table)
	{
		$this->db->where('ease_paid !=', 1);
		$query = $this->db->get_where($table);
	 	return $query->result_array();
	}
	public function retrive_data($table)
	{
		$this->db->where('type !=', 'Clients');
		$query = $this->db->get_where($table);
	 	return $query->result_array();
	}
	public function insert_data($table,$data)
	{
		 $query = $this->db->insert($table,$data);
	}
	
	public function get_where_data($table,$where)
	{
		$query = $this->db->get_where($table,$where);
	 	return $query->result_array();
	}

public function delete_data($table,$where)
{
		
$this->db->delete($table,$where);
		
}
public function update_data($table,$data,$where)
{
$this->db->update($table,$data,$where);
}
public function update_data1($table,$data)
{
$this->db->update($table,$data);
}

public function no_rows($table,$data)
	{
	    $query = $this->db->get_where($table,$data);
	    return $query->num_rows();
}
public function no_rows1($table)
	{
	    $query = $this->db->get($table);
	    return $query->num_rows();
}

public function rows_count($table,$where)
{
	    $query = $this->db->get_where($table,$where);
	    return $query->num_rows();
}

public function get_last_record($table,$where,$limit)
	{
	    $query = $this->db->order_by('sno','DESC');
		$query = $this->db->limit($limit);
		$query = $this->db->where($where);
		$query = $this->db->get($table);
	    return $query->result_array();
}
public function get_where_data_ss($table,$where,$one,$two)

{
	 $this->db->where('e_username',$where);
			$query = $this->db->get($table);
		
	$this->db->where('e_date >=',$one);
	$this->db->where('e_date <=',$two);
		return $query->result_array(); 
		}
public function get_last_record_leaves($table,$where)
	{
  $this->db->group_by("vmk_id");
  $query = $this->db->get_where($table,$where);
  return $query->result_array();
}
public function get_last_record1($table,$where,$limit)
	{
	    $query = $this->db->order_by('sno','DESC');
		$query = $this->db->limit($limit);
		$query = $this->db->where($where);
		$query = $this->db->get($table);
	    return $query->result_array();
}
public function last_record($table,$where,$limit)
 {
     $query = $this->db->order_by('sno','DESC');
  $query = $this->db->limit($limit);
  $query = $this->db->where($where);
  $query = $this->db->get($table);
     return $query->result_array();
 }
 public function last_record_event($table,$limit)
 {
     $query = $this->db->order_by('sno','DESC');
  $query = $this->db->limit($limit);

  $query = $this->db->get($table);
     return $query->result_array();
 }
 
 /*public function last_record_track_1($table,$where,$limit)
 {
     $query = $this->db->order_by('id','DESC');
  $query = $this->db->limit($limit);
  $query = $this->db->where($where);
  $query = $this->db->get($table);
     return $query->result_array();
 }
 public function last_record_track_2($table,$where,$limit)
 {
     $query = $this->db->order_by('client_user_id','DESC');
  $query = $this->db->limit($limit);
  $query = $this->db->where($where);
  $query = $this->db->get($table);
     return $query->result_array();
 }*/
  public function last($table,$limit)
 {
     $query = $this->db->order_by('sno','DESC');
  $query = $this->db->limit($limit);

  $query = $this->db->get($table);
     return $query->result_array();
 }
 public function GetAutocomplete($options = array())
{
     $this->db->select('id');
     $this->db->like('id', $options['keyword'], 'after');
     $query = $this->db->get('projects');
  return $query->result();
}
 public function GetAutocomplete1($options = array())
{
     $this->db->select('client_user_id');
     $this->db->like('client_user_id', $options['keyword'], 'after');
     $query = $this->db->get('clients');
  return $query->result();
}
public function GetAutocomplete_project_name($options = array())
{
     $this->db->select('name');
     $this->db->like('name', $options['keyword'], 'after');
     $query = $this->db->get('projects');
  return $query->result();
}
public function GetAutocomplete_domain_name($options = array())
{
     $this->db->select('main_domain');
     $this->db->like('main_domain', $options['keyword'], 'after');
     $query = $this->db->get('clients');
  return $query->result();
}
public function GetAutocomplete_user_id($options = array())
{
     $this->db->select('Employee_id');
     $this->db->like('Employee_id', $options['keyword'], 'after');
     $query = $this->db->get('addnewemployee');
  return $query->result();
}
public function GetAutocomplete_employee_name($options = array())
{
     $this->db->select('name');
     $this->db->like('name', $options['keyword'], 'after');
     $query = $this->db->get('vmk_members_roles');
  return $query->result();
}
public function gets($table,$names)
 {

  $this->db->where_in('type', $names);
  $query = $this->db->get($table);
     return $query->result_array();
 }
public function get_data_limit($table,$limit)
{
	
  $query = $this->db->limit($limit);
 
  $query = $this->db->get($table);
     return $query->result_array();
}
public function get_data_limit1($table,$where,$limit)
{
	
  $query = $this->db->limit($limit);
  $query = $this->db->get_where($table,$where);
     return $query->result_array();
}
public function get_where_data1($table,$where)
	{
		 $query=$this->db->where("e_date > " . $min . " AND e_date <= " . $max);
		$query = $this->db->get_where($table,$where);
	 	return $query->result_array();
	}
	public function get_datas($table,$id,$from,$to)
{
$this->db->where('e_date >=', $from);
$this->db->where('e_date <=', $to);
	$query=$this->db->where('e_id',$id);
      $query=$this->db->get($table);
  return $query->result_array();
}
public function get_where_data_order($table,$where, $order_by)
 {
     $query = $this->db->order_by('sno','DESC');
  
  $query = $this->db->get_where($table,$where);
     return $query->result_array();
 
 }
 public function get_data_order($table,$order_by)
	{
		  $query = $this->db->order_by('sno','DESC');
		$query = $this->db->get($table);
	 	return $query->result_array();
	}
	 public function get_data_limit_order($table,$limit,$order_by)
	{
		$query = $this->db->limit($limit);
		  $query = $this->db->order_by('sno','DESC');
		$query = $this->db->get($table);
	 	return $query->result_array();
	}
}

