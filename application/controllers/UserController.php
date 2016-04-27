<?php

use App\Models\Sales;
use App\Models\People;
use App\Models\People_category_holdings;
use App\Models\People_email;

class UserController extends \BaseController {


	public function  __construct() {

		$this->RANDOM_PASSWORD_LENGTH = 6;

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::where('business_user_id' , Auth::user()->business_user_id)->get();
		$return_arr = array(
			    "users" => $users,
			    "help_text" => $this->getAllhelptext(),
			    "breadcums" => $this->bread_cums("users","index"));
		return View::make('pages.admin.users.index')
			->with($return_arr);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$return_arr = array(
			"breadcums" => $this->bread_cums("admin/users","create"),
			"help_text" => $this->getAllhelptext()
		);
		return View::make('pages.admin.users.create', $return_arr);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate the info, create rules for the inputs
		$rules = array(
			'people_id'    => 'required|exists:people,id', // make sure the email is an actual email and unique in the user
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form

		if ($validator->fails()) {
			return Redirect::to('admin/users/create')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password'));
		} else {

			$password = $this->create_random_password();

			$user = new User;
			$user->people_id = Input::get('people_id');
			$user->business_user_id = Auth::user()->business_user_id;
			$user->email = People_email::where('people_id' , Input::get('people_id'))->first()->email_1
			;
			$user->password = Hash::make($password);
			$user->is_active = Input::get('is_active');

			$user->save();

			$name_arr = explode('@',$user->email);
			$name = $name_arr[0];
			$email = $user->email;

			Mail::send('emails.new_user', array('password' => $password , 'name' => $name), function($message) use($email,$name)
			{
				$message->to($email,$name)->subject('Welcome email from Project Visa');
			});

			return Redirect::to('admin/users');

		}


	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
		$find_user = User::find($id);

		// show the edit form and pass the nerd

		$return_arr = array(
			"breadcums" => $this->bread_cums("system settings > system users","edit"),
			"find_user" => $find_user,
			"help_text" => $this->getAllhelptext(),
		);

		return View::make('pages.admin.users.edit', $return_arr);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// validate the info, create rules for the inputs
		$rules = array(
			'email'    => 'required|email|exists:users', // make sure the email is an actual email and unique in the user
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form

		if ($validator->fails()) {
			return Redirect::to('admin/users/'.$id.'/edit')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password'));
		} else {
			$find_user = User::find($id);

			$find_user->is_active = Input::get('is_active');

			$find_user->save();

			return Redirect::to('admin/users');
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

	public function showLogin()
	{
		// show the form
		return View::make('login');
	}

	public function doLogin()
	{

// validate the info, create rules for the inputs
		$rules = array(
			'email'    => 'required|email', // make sure the email is an actual email
			'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
		);

// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

// if the validator fails, redirect back to the form

		if ($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password'));


		} else {

			// create our user data for the authentication
			$userdata = array(
				'email'     => Input::get('email'),
				'password'  => Input::get('password')
			);

			// attempt to do the login
			if (Auth::attempt($userdata)) {

				$business_user_path =   public_path().'/images/business_user/'.Auth::user()->business_user_id;
				// check and create plant main path
				if(!File::exists($business_user_path)) {
					File::makeDirectory($business_user_path, $mode = 0777, true, true);
				}

				//After signin successfull get the category, if the user cat login is 0, which is system admin redirect to system admin home page

				$people_category_holding = People_category_holdings::where('people_id' , Auth::user()->people_id)->first();

				if($people_category_holding->person_category == 0) {

					return Redirect::to('/systemadmin');

				} else {

					return Redirect::to('/home');

				}


			} else {
				return Redirect::to('login')
					   ->withErrors('Username and Password are Incorrect!');
			}

		}
	}

	public function userTransactions() {
		$data['transactions'] = Sales::where('public_member', '=', Auth::user()->id)->get();
		$data["html_section"] = 6;
		$data["weight_matches"] = 0;
		$data["section"] = "customer_transactions";
		return View::make('pages.member_history',$data);
	}

	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to('login'); // redirect the user to the login screen
	}

	public function search_users() {

		$query = $_REQUEST["query"];
		//$output = $this->search_principal($query);

		$find_users = People_category_holdings::
			          join('people' , 'people_category_holdings.people_id' , '=' , 'people.id')
			          ->join('people_profile' , 'people_category_holdings.people_id' , '=' , 'people_profile.people_id')
			          ->where('people.business_user_id' ,  Auth::user()->business_user_id)
			          ->where('people_category_holdings.person_category', 11)
		              ->where('people_category_holdings.people_id', 'LIKE', '%'.$query.'%')
			          ->select(
						          'people_category_holdings.people_id AS people_id' ,
						           'people_profile.name_given1_en',
						          'people_profile.name_family_en'
					  )
			          ->get();

		$results = array();

		//for($i = 0; $i <= count($find_people); $i++) {
		foreach($find_users as $user) {

			$results[] = array(
				"id" => "".$user->people_id."",
				"display" => "".$user->people_id."",
				"value" => "".$user->people_id."",
				"desc" => "".$user->name_given1_en . ' - ' .$user->name_family_en .""
			);
		}

		echo json_encode($results);

	}

}
