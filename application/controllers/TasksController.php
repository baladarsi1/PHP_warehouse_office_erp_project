<?php

use App\Models\Tasks;
use App\Models\TasksResponses;
use App\Models\Business_user;
use App\Models\People;
use App\Models\People_profile;
use Carbon\Carbon;

class TasksController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tasks = Tasks::where('business_user_id' , Auth::user()->business_user_id)->get();
		$return_arr = array(
			"tasks" => $tasks,
			"breadcums" => $this->bread_cums("tasks","index")
		);
		return View::make('pages.tasks.index')
			->with($return_arr);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function search($prn)
	{
		$tasks = Tasks::where('business_user_id' , Auth::user()->business_user_id)->where('prn' , $prn)->get();
		$return_arr = array(
			"tasks" => $tasks,
			"breadcums" => $this->bread_cums("tasks","index")
		);
		return View::make('pages.tasks.index')
			->with($return_arr);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($ajax = 0)
	{
		//
		$return_arr = array(
			"ajax" => $ajax,
			"edit_mode" => false,
			"breadcums" => $this->bread_cums("tasks","create"),
		);
		return View::make('pages.tasks.create', $return_arr);
	}

	/**
	 * Show the form for creating a edit new resource.
	 *
	 * @return Response
	 */
	public function create_edit($id)
	{

		// get the nerd
		$single_task= Tasks::find($id);

		$return_arr = array(
			"ajax" => 0,
			"single_task" => $single_task,
			"edit_mode" => false,
			"breadcums" => $this->bread_cums("milestones","create"),
		);
		return View::make('pages.tasks.create_edit', $return_arr);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		if(Input::has('task_id')) {

			$new_task = Tasks::find(Input::get('task_id'));

		} else {

			$new_task = new Tasks;

		}

	    $new_task = $this->task_input($new_task);
		$new_task->save();

		return Redirect::to('tasks');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$single_task = Tasks::find($id);

		$return_arr = array(
			"ajax_load" => 0,
			"breadcums" => $this->bread_cums("tasks","create"),
			"single_task" => $single_task
		);
		return View::make('pages.tasks.show', $return_arr);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the nerd
		$single_task = Tasks::find($id);

		// get the tasks responses
		$task_responses = TasksResponses::where('task_id' , $id)->get();

		// show the edit form and pass the nerd

		$return_arr = array(
			"ajax_load" => 0,
			"edit_mode" => true,
			"edit_public" => false,
			"breadcums" => $this->bread_cums("tasks","edit"),
			"single_task" => $single_task,
			"task_responses" => $task_responses
		);

		return View::make('pages.tasks.edit', $return_arr);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function public_edit($unique_id)
	{
		//explode the unique if
		$unique_id_array = explode("_", $unique_id);

		//get the url is valid unique task id
		$check_valid_unique_count = Tasks::where('id' , $unique_id_array[0])->where('unique_id_string' , $unique_id_array[1])->count();

		if($check_valid_unique_count == 0) {

			echo "This link is either not valid or expires";

		} else {

			// get the nerd
			$single_task = Tasks::find($unique_id_array[0]);

			// get the tasks responses
			$task_responses = TasksResponses::where('task_id' , $unique_id_array[0])->get();

			// show the edit form and pass the nerd

			$return_arr = array(
				"ajax_load" => 0,
				"edit_mode" => true,
				"edit_public" => true,
				"breadcums" => $this->bread_cums("tasks","edit"),
				"single_task" => $single_task,
				"task_responses" => $task_responses
			);

			return View::make('pages.tasks.edit', $return_arr);

		}

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//get the main task id
		$task_row = Tasks::find($id);

		$task_response = new TasksResponses;

		$task_response->response = Input::get('response');
		$task_response->task_id = $id;

		// Find the response from the business user or th client
		// IF the logged in user get count from the business user table

		if(isset(Auth::user()->business_user_id)) {

			$business_user_count = Business_user::where('id' , Auth::user()->business_user_id)->count();

		} else {

			$business_user_count = 0;

		}


		if($business_user_count == 0) {

			$task_response->user_type = 2;
			$task_response->save();

			//Once the task updated from client send email to business user

			$task_link = url('/').'/tasks/public_edit/'.$id.'_'.$task_row->unique_id_string;

			$task_profile_row = $this->get_task_name_email($id);

			$this->send_task_response_to_business_user($task_link,$task_profile_row);


			return Redirect::to('tasks/public_edit/'.$id.'_'.$task_row->unique_id_string);


		} else {

			$task_response->user_type = 1;
			$task_response->save();

			//once the task updated from business user send email to client

			$task_link = url('/').'/tasks/public_edit/'.$id.'_'.$task_row->unique_id_string;

			$task_profile_row = $this->get_task_name_email($id);

			$this->send_task_response_to_client($task_link,$task_profile_row);

			return Redirect::to('tasks/'.$id.'/edit#tab_task_response');

		}


	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function task_input($new_task) {

		$new_task->business_user_id = Auth::user()->business_user_id;
		$new_task->subject = Input::get('subject');
		$new_task->body = Input::get('body');
		$new_task->task_date = Carbon::createFromFormat('d-m-Y',date('d-m-Y'));
		$new_task->prn = Input::get('prn');
		$new_task->sc_id = Input::get('sc_id');

		if(Input::get('finished_date') == null) {

			$new_task->finished_date =  null;


		} else {

			$new_task->finished_date =  Carbon::createFromFormat('d-m-Y',Input::get('finished_date'));

		}

		if(Input::get('task_action') == 'save') {

			$new_task->status = 1;

		} else if(Input::get('task_action') == 'publish') {

			$new_task->status = 2;
			$new_task->unique_id_string = uniqid();

		}

		return $new_task;

	}

	public function send_task_response_to_client($task_link,$task_profile_row) {

		$email = $task_profile_row->email_1;
		$name = $task_profile_row->name_given1_en;

		Mail::send('emails.task_to_client', array('task_link' => $task_link , 'name' => $task_profile_row->name_family_en), function($message) use($email,$name)
		{
			$message->to($email,$name)->subject('Welcome email from Project Visa');
		});


	}

	public function send_task_response_to_business_user($task_link,$task_profile_row) {

		$email = $task_profile_row->email_1;
		$name = $task_profile_row->name_given1_en;

		Mail::send('emails.task_to_business_user', array('task_link' => $task_link , 'name' => $name), function($message) use($email,$name)
		{
			$message->to($email,$name)->subject('Welcome email from Project Visa');
		});


	}

	/*
	 * This is ajax json request to get the task conversation
	 */

	public function get_task_conversation($task_id) {



		// get the tasks responses
		$task_responses = Responses::where('task_id' , $task_id)->get();

		$results = array();

		foreach($task_responses as $response) {

			$results[] = array(

				"user_type" => $response->user_type,
				"response" => $response->response

			);

		}

		echo json_encode($results);
	}

	/*
	 * Get the mile stone people email address
	 */

	public function get_task_name_email($milestone_id) {

		$milestone_row = Tasks::find($milestone_id);

        $people_row = People::where('prn', $milestone_row->prn)->first();

		$people_profile_row = People_profile::where('people_id' , $people_row->id)->first();

		return $people_profile_row;

	}

}
