<?php
class Mycal_model extends CI_Model {
	
	var $conf;
	
	public function __construct()//database calling
	{
		$this->load->database();
		$this->load->helper('url'); //url library helper
		
	
		
	}
	
	
	function get_calendar_data($year, $month, $page1) {
		
		if($page1=='ongoing')
		{
		$query = $this->db->select('date, data, where')->from('calendar')
			->like('date', "$year-$month", 'after')->like('where', "ongoing", 'after')->get();
		}
		else if($page1=='annual')
		{
			$query = $this->db->select('date, data, where')->from('calendar')
			->like('date', "$year-$month", 'after')->like('where', "annual", 'after')->get();
		
		}
		else if($page1=='sick')
		{
				$query = $this->db->select('date, data, where')->from('calendar')
			->like('date', "$year-$month", 'after')->like('where', "sick", 'after')->get();
		}
		else if($page1=='events')
		{
				$query = $this->db->select('date, data, where')->from('calendar')
			->like('date', "$year-$month", 'after')->like('where', "events", 'after')->get();
		}
		else
		{
			$query = $this->db->select('date, data, where')->from('calendar')
			->like('date', "$year-$month", 'after')->get();
		}
		
		$cal_data = array();
		
		foreach ($query->result() as $row) {
			$cal_data[substr($row->date,8,2)] = $row->data;
		}
		
		return $cal_data;
		
	}
	
	function add_calendar_data($date, $data) {
		
		if ($this->db->select('date')->from('calendar')
				->where('date', $date)->count_all_results()) {
			
			$this->db->where('date', $date)
				->update('calendar', array(
				'date' => $date,
				'data' => $data			
			));
			
		} else {
		
			$this->db->insert('calendar', array(
				'date' => $date,
				'data' => $data			
			));
		}
		
	}
	
	function generate ($year, $month,$page1) {
		if($page1=='ongoing'){
		$this->conf = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'index.php/user_controller/home/ongoing'
		);
		}
		else if($page1=='annual')
		{
			$this->conf = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'index.php/user_controller/home/annual'
			);
		}
		else if($page1=='sick')
		{
			$this->conf = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'index.php/user_controller/home/sick'
			);
		}
		else if($page1=='events')
		{
			$this->conf = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'index.php/user_controller/home/events'
			);
		}
		else
		{
			$this->conf = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'index.php/user_controller/home/all'
			);
		}
			
		
		$this->conf['template'] = '
			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}
			
			{heading_row_start}<tr>{/heading_row_start}
					
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td>{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			
			{cal_cell_content}
				<div class="day_num">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}
		';
	
		$this->load->library('calendar', $this->conf);
		$cal_data = $this->get_calendar_data($year, $month,$page1);
		return $this->calendar->generate($year, $month, $cal_data);
		
	}
	
}
