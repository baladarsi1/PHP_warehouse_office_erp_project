<?php

use App\Models\Milestones;
use App\Models\MilestonesResponses;
use App\Models\Business_user;
use App\Models\People;
use App\Models\People_profile;
use Carbon\Carbon;

class MilestonesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$milestones = Milestones::where('business_user_id' , Auth::user()->business_user_id)->get();
		$return_arr = array(
			"milestones" => $milestones,
			"breadcums" => $this->bread_cums("communications","index")
		);
		return View::make('pages.milestones.index')
			->with($return_arr);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function search($prn)
	{
		$milestones = Milestones::where('business_user_id' , Auth::user()->business_user_id)->where('prn' , $prn)->get();
		$return_arr = array(
			"milestones" => $milestones,
			"breadcums" => $this->bread_cums("communications","index")
		);
		return View::make('pages.milestones.index')
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
			"breadcums" => $this->bread_cums("communications","create"),
		);
		return View::make('pages.milestones.create', $return_arr);
	}

	/**
	 * Show the form for creating a edit new resource.
	 *
	 * @return Response
	 */
	public function create_edit($id)
	{

		// get the nerd
		$single_milestone = Milestones::find($id);

		$return_arr = array(
			"ajax" => 0,
			"single_milestone" => $single_milestone,
			"edit_mode" => false,
			"breadcums" => $this->bread_cums("communications","create"),
		);
		return View::make('pages.milestones.create_edit', $return_arr);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		if(Input::has('milestone_id')) {

			$new_milestone = Milestones::find(Input::get('milestone_id'));

		} else {

			$new_milestone = new Milestones;

		}



		$new_milestone = $this->milestone_input($new_milestone);
		$new_milestone->save();

		return Redirect::to('milestones');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$single_milestone = Milestones::find($id);

		$return_arr = array(
			"ajax_load" => 0,
			"breadcums" => $this->bread_cums("communications","create"),
			"single_milestone" => $single_milestone
		);
		return View::make('pages.milestones.show', $return_arr);
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
		$single_milestone = Milestones::find($id);

		// get the milestones responses
		$milestone_responses = MilestonesResponses::where('milestone_id' , $id)->get();

		// show the edit form and pass the nerd

		$return_arr = array(
			"ajax_load" => 0,
			"edit_mode" => true,
			"edit_public" => false,
			"breadcums" => $this->bread_cums("communications","edit"),
			"single_milestone" => $single_milestone,
			"milestone_responses" => $milestone_responses
		);

		return View::make('pages.milestones.edit', $return_arr);
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

		//get the url is valid unique milestone id
		$check_valid_unique_count = Milestones::where('id' , $unique_id_array[0])->where('unique_id_string' , $unique_id_array[1])->count();

		if($check_valid_unique_count == 0) {

			echo "This link is either not valid or expires";

		} else {

			// get the nerd
			$single_milestone = Milestones::find($unique_id_array[0]);

			// get the milestones responses
			$milestone_responses = MilestonesResponses::where('milestone_id' , $unique_id_array[0])->get();

			// show the edit form and pass the nerd

			$return_arr = array(
				"ajax_load" => 0,
				"edit_mode" => true,
				"edit_public" => true,
				"breadcums" => $this->bread_cums("communications","edit"),
				"single_milestone" => $single_milestone,
				"milestone_responses" => $milestone_responses
			);

			return View::make('pages.milestones.edit', $return_arr);

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
		//get the main milestone id
		$milestone_row = Milestones::find($id);

		$milestone_response = new MilestonesResponses;

		$milestone_response->response = Input::get('response');
		$milestone_response->milestone_id = $id;

		// Find the response from the business user or th client
		// IF the logged in user get count from the business user table

		if(isset(Auth::user()->business_user_id)) {

			$business_user_count = Business_user::where('id' , Auth::user()->business_user_id)->count();

		} else {

			$business_user_count = 0;

		}


		if($business_user_count == 0) {

			$milestone_response->user_type = 2;
			$milestone_response->save();

			//Once the milestone updated from client send email to business user

			$milestone_link = url('/').'/milestones/public_edit/'.$id.'_'.$milestone_row->unique_id_string;

			$milestone_profile_row = $this->get_milestone_name_email($id);

			$this->send_milestone_response_to_business_user($milestone_link,$milestone_profile_row);


			return Redirect::to('milestones/public_edit/'.$id.'_'.$milestone_row->unique_id_string);


		} else {

			$milestone_response->user_type = 1;
			$milestone_response->save();

			//once the milestone updated from business user send email to client

			$milestone_link = url('/').'/milestones/public_edit/'.$id.'_'.$milestone_row->unique_id_string;

			$milestone_profile_row = $this->get_milestone_name_email($id);

			$this->send_milestone_response_to_client($milestone_link,$milestone_profile_row);

			return Redirect::to('milestones/'.$id.'/edit#tab_milestone_response');

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

	public function milestone_input($new_milestone) {

		$new_milestone->business_user_id = Auth::user()->business_user_id;
		$new_milestone->subject = Input::get('subject');
		$new_milestone->body = Input::get('body');
		$new_milestone->milestone_date = Carbon::createFromFormat('d-m-Y',date('d-m-Y'));
		$new_milestone->prn = Input::get('prn');
		$new_milestone->sc_id = Input::get('sc_id');

		if(Input::get('finished_date') == null) {

			$new_milestone->finished_date =  null;


		} else {

			$new_milestone->finished_date =  Carbon::createFromFormat('d-m-Y',Input::get('finished_date'));

		}

		if(Input::get('milestone_action') == 'save') {

			$new_milestone->status = 1;

		} else if(Input::get('milestone_action') == 'publish') {

			$new_milestone->status = 2;
			$new_milestone->unique_id_string = uniqid();

		}

		return $new_milestone;

	}

	public function send_milestone_response_to_client($milestone_link,$milestone_profile_row) {

		$email = $milestone_profile_row->email_1;
		$name = $milestone_profile_row->name_given1_en;

		Mail::send('emails.milestone_to_client', array('milestone_link' => $milestone_link , 'name' => $milestone_profile_row->name_family_en), function($message) use($email,$name)
		{
			$message->to($email,$name)->subject('Welcome email from Project Visa');
		});


	}

	public function send_milestone_response_to_business_user($milestone_link,$milestone_profile_row) {

		$email = $milestone_profile_row->email_1;
		$name = $milestone_profile_row->name_given1_en;

		Mail::send('emails.milestone_to_business_user', array('milestone_link' => $milestone_link , 'name' => $name), function($message) use($email,$name)
		{
			$message->to($email,$name)->subject('Welcome email from Project Visa');
		});


	}

	/*
	 * This is ajax json request to get the milestone conversation
	 */

	public function get_milestone_conversation($milestone_id) {



		// get the milestones responses
		$milestone_responses = MilestonesResponses::where('milestone_id' , $milestone_id)->get();

		$results = array();

		foreach($milestone_responses as $response) {

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

	public function get_milestone_name_email($milestone_id) {

		$milestone_row = Milestones::find($milestone_id);

        $people_row = People::where('prn', $milestone_row->prn)->first();

		$people_profile_row = People_profile::where('people_id' , $people_row->id)->first();

		return $people_profile_row;

	}

}
