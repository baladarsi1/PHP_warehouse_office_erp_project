<?php
use App\Models\Business_user;
use App\Models\People;
use App\Models\People_profile;
use App\Models\People_email;
use App\Models\People_passport;
use App\Models\People_reference;
use App\Models\People_education;
use App\Models\Degree_type;
use App\Models\People_experience;
use App\Models\Addresses;
use App\Models\People_category_holdings;
use App\Models\Businesses;
use App\Models\Peoplebusiness;
use App\Models\People_category;
use App\Models\People_relationship;
use App\Models\People_social;
use App\Models\Contracts;
use Carbon\Carbon;

class PeopleController extends \BaseController {


	//get all people by input the business user id

	public function index()
	{

		$people = People::where('business_user_id' , Auth::user()->business_user_id)->get();
		$return_arr = array("people" => $people,"breadcums" => $this->bread_cums("people","index"));
		return View::make('pages.people.index')->with($return_arr);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$return_arr = array(

			    "breadcums" => $this->bread_cums("people","create"),
			    "peoplegroups" => $this->sort_people_groups(People_category::where('role_level' , 2)->get()),
			    "peoplerelationships" => People_relationship::get(),

		);
		return View::make('pages.people.create', $return_arr);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{


		$new_people = new People;
		$new_people->business_user_id = Auth::user()->business_user_id;

		//get the user group input parameters

		$people_role = Input::get('people_role');
		$principle = Input::get('principle');
		$search_principle_input_id = Input::get('search_principle_id');
		$principle_child = Input::get('principle_child');

		$messages = array(
			'name_family_en.required' => 'Please enter your family name',
			'name_given1_en.required' => 'Please enter your given name'
		);

		if($principle == "Yes") {

			// validate the info, create rules for the inputs
			$rules = array(

				'people_role' => 'required',
				'name_family_en'    => 'required',
				'name_given1_en'    => 'required',
				'email_1' => 'required|email|unique:people_email'

			);


		} else if($principle == "No"){

			// validate the info, create rules for the inputs
			$rules = array(

				'search_principle_id' => 'required|exists:people,prn',
				'name_family_en'    => 'required',
				'name_given1_en'    => 'required'

			);

			$messages['search_principle_id.exists'] =  'Please enter valid Principle PRN';

		}


		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules , $messages);

		// if the validator fails, redirect back to the form

		if ($validator->fails()) {
			return Redirect::to('people/create')
				->withErrors($validator) // send back all errors to the login form
			    ->withInput()
				->withInput(Input::except('password'));
		} else {
			// If New principle then if condition yes create as new PRN
			//If not new principle get the parent prn and update child connection

			if($principle == "Yes") {
				$new_people->prn_suffix = 1;
				$new_people->save();
				$this->update_prn($new_people->id,$new_people->id,$new_people->prn_suffix);

				/*
                 * After creating account id and updating category holdings
                 * System need to update the holdings
				 * If new principle get the role from form and update the role id
                */

				$insert_people_holdings = $this->insert_people_category_holdings($new_people->id,$people_role);

			} else {
				$new_people->prn_suffix = $principle_child;
				$new_people->save();

				$search_principle_id = substr($search_principle_input_id, 0, 4);

				$this->update_prn($new_people->id,$search_principle_id,$new_people->prn_suffix);

				/*
                 * After creating account id and updating category holdings
                 * System need to update the holdings
				 * If not new principle then update role as relative group id is 16
                */

				$insert_people_holdings = $this->insert_people_category_holdings($new_people->id,16);
			}




			/*
             * After creating account id and people holding
             * Create a dummy people profile row for the search purpose
             */

			$people_profile_row = $this->set_people_profile_attributes($new_people->id);
			$people_profile_row->name_family_en = Input::get('name_family_en');
			$people_profile_row->name_given1_en = Input::get('name_given1_en');
			$people_profile_row->mobile_1_number = Input::get('mobile_1_number');
			$people_profile_row->save();

			/*
             * After creating account id and people holding
             * Create a dummy people email row for the search purpose
             */

			$people_email_row = new People_email;
			$people_email_row->email_1 = Input::get('email_1');
			$people_email_row->person_category = $people_role;
			$people_email_row->save();

			return Redirect::to('people/'.$new_people->id.'/edit');
		}



	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show($id,$ajax = 0)
	{
		if($this->is_valid_user_action(People::find($id)->business_user_id) == true) {

			// get the nerd
			$find_people = People::find($id);



			$return_arr = array(
				"ajax_load" => $ajax,
				"breadcums" => $this->bread_cums("people","profile"),
				"peoplegroups" => $this->sort_people_groups(People::getAllpeoplegroups()),
				"peoplerelationships" => People::getAllpeoplerelationships(),
				"peopletitles" => People::getAllpeopletitles(),
				"countrycodes" => $this->sort_country_codes($this->getAllcoutrycodes()),
				"currencycodes" => $this->sort_currency_codes($this->getAllcurrencycodes()),
				"stateprovinces" => $this->sort_state_provinces($this->getAllstateprovince()),
				"find_people" => $find_people,
				"people_business" => $this->get_people_business_id($id),
				"people_address" => $this->get_people_address($id),
				"prn_tree" => People::getPrntree($id),
				"people_cat_holdings" => $this->get_people_cat_holdings($id),
				"help_text" => $this->getAllhelptext(),
				"social_list" => $this->sort_people_social_list($this->getAllsociallist())
			);



			return View::make('pages.people.show', $return_arr);

		} else {

			return Redirect::to('/home');

		}


	}




	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		if($this->is_valid_user_action(People::find($id)->business_user_id) == true) {

			// get the nerd
			$find_people = People::find($id);

			// show the edit form and pass the nerd

			$return_arr = array(

				"breadcums" => $this->bread_cums("people","profile"),
				"find_people" => People::find($id),
				"people_profile" => $this->set_people_profile_attributes($id),
				"people_email" => $this->set_people_email_attributes($id),
				"people_address" => $this->set_people_address_attributes($id),
				"people_passport" => $this->set_people_passport_attributes($id),
				"people_reference" => $this->set_people_reference_attributes($id),
				"people_education" => $this->set_people_education_attributes($id),
				"people_experience" => $this->set_people_experience_attributes($id),
				"peoplegroups" => $this->sort_people_groups(People::getAllpeoplegroups()),
				"peoplerelationships" => People::getAllpeoplerelationships(),
				"peopletitles" => $this->sort_people_titles(People::getAllpeopletitles()),
				"countrycodes" => $this->sort_country_codes($this->getAllcoutrycodes()),
				"currencycodes" => $this->sort_currency_codes($this->getAllcurrencycodes()),
				"stateprovinces" => $this->sort_state_provinces($this->getAllstateprovince()),
				"people_business" => $this->get_people_business_id($id),
				"people_cat_holdings" => $this->get_people_cat_holdings($id),
				"help_text" => $this->getAllhelptext(),
				"social_list" => $this->sort_people_social_list($this->getAllsociallist())

			);

			return View::make('pages.people.edit', $return_arr);

		} else {

			return Redirect::to('/home');

		}

	}

	/*
	 * People profile section setting intialising for both show and edit people address tab
	 */

	public function set_people_profile_attributes($people_id) {

		//get the people profile section
		$people_profile_count = People_profile::where('people_id', $people_id)->count();

		//if empty result from the people profile table
		//load all the fields and set as null values
		//this is require to keep blade process as it is

		$people_profile_arr = array('title','name_family_en','name_given1_en' ,'name_given2_en' , 'sex' , 'people_tfn','dibp_case_officer_number',
			'tel_1_country', 'tel_1_area', 'tel_1_number' , 'tel_2_country','tel_2_area','tel_2_number','mobile_1_country','mobile_1_area', 'mobile_1_number',
			'mobile_2_country', 'mobile_2_area' , 'mobile_2_number' , 'fax_1_country' , 'fax_1_area' , 'fax_1_number', 'fax_2_country' , 'fax_2_area' , 'phone_other',
			'website_personal' , 'email_2' , 'email_3' , 'social_name' , 'social_value' , 'people_comment');

		if($people_profile_count == 0) {

			$people_profile = new People_profile;

		} else {

			$people_profile = People_profile::where('people_id', $people_id)->first();

		}

		$people_profile->people_id = $people_id;

		if(!isset($people_profile->people_id)) {

			foreach($people_profile_arr as $profile_field) {

				$people_profile->$profile_field = null;

			}

		}

		return $people_profile;

	}

	/*
	 * People profile section setting initialising for both show and edit people email tab
	 */

	public function set_people_email_attributes($people_id) {

		//get the people email section from the users table
		$people_user_email_count = User::where('people_id' , $people_id)->count();

		//get the people email section
		$people_email_count = People_email::where('people_id', $people_id)->count();

		if($people_user_email_count == 1) {

			$people_user_email = User::where('people_id' , $people_id)->first();

			$user_email = $people_user_email->email;

		} else if($people_email_count == 1) {

			$people_email = People_email::where('people_id', $people_id)->first();

			$user_email = $people_email->email_1;

		} else {

			$user_email = null;
		}

		return $user_email;

	}

	/*
	 * People address section setting intialising for both show and edit people address tab
	 */

	public function set_people_address_attributes($people_id) {

		//get the people address section
		$people_address_count = Addresses::where('people_id', $people_id)->count();

		//if empty result from the people address table
		//load all the fields and set as null values
		//this is require to keep blade process as it is

		$people_address_arr = array('unit_suite_room','level','street_number' ,'po_box' , 'street_name_en' , 'suburb_en','city_en', 'state_province', 'postcode_en', 'country_en' , 'address_comment' );

		if($people_address_count == 0) {

			$people_address = new Addresses;

		} else {

			$people_address = Addresses::where('people_id', $people_id)->first();

		}

		if(!isset($people_address->people_id)) {

			foreach($people_address_arr as $address_field) {

				$people_address->$address_field = null;

			}

		}

		return $people_address;

	}

	/*
	 * People passport section setting intialising for both show and edit people address tab
	 */

	public function set_people_passport_attributes($people_id) {

		//get the people address section
		$people_passport_count = People_passport::where('people_id', $people_id)->count();

		//if empty result from the people passport table
		//load all the fields and set as null values
		//this is require to keep blade process as it is

		$people_passport_arr = array('birth_country','birth_place','birth_date' ,'passport_number' , 'passport_issue_country' , 'passport_issue_location','passport_issue_date','passport_expiry_date','id_number');

		if($people_passport_count == 0) {

			$people_passport = new People_passport;

		} else {

			$people_passport = People_passport::where('people_id', $people_id)->first();

		}

		if(!isset($people_passport->people_id)) {

			foreach($people_passport_arr as $passport_field) {

				$people_passport->$passport_field = null;

			}

		}

		return $people_passport;

	}

	/*
	 * People reference section setting intialising for both show and edit people address tab
	 */

	public function set_people_reference_attributes($people_id) {

		//get the people reference section
		$people_reference_count = People_reference::where('people_id', $people_id)->count();

		//if empty result from the people reference table
		//load all the fields and set as null values
		//this is require to keep blade process as it is

		$people_reference_arr = array('referred_by','referral_in_brn','referral_out_brn' ,'agency_in_brn');

		if($people_reference_count == 0) {

			$people_reference = new People_reference;

		} else {

			$people_reference = People_reference::where('people_id', $people_id)->first();

		}

		if(!isset($people_reference->people_id)) {

			foreach($people_reference_arr as $reference_field) {

				$people_reference->$reference_field = null;

			}

		}

		return $people_reference;

	}

	/*
	 * People education section setting intialising for both show and edit people address tab
	 */

	public function set_people_education_attributes($people_id) {

		//get the people profile section
		$people_education_count = People_education::where('people_id', $people_id)->count();

		//if empty result from the people profile table
		//load all the fields and set as null values
		//this is require to keep blade process as it is

		$people_education_arr = array('year_started','year_ended','qualification_type' ,'qualification_name');

		if($people_education_count == 0) {

			$people_education = new People_education;

		} else {

			$people_education = People_education::where('people_id', $people_id)->first();

		}

		$people_education->people_id = $people_id;

		if(!isset($people_education->people_id)) {

			foreach($people_education_arr as $education_field) {

				$people_education_arr->$education_field = null;

			}

		}

		return $people_education;

	}

	/*
	 * People experience section setting initialising for both show and edit people address tab
	 */

	public function set_people_experience_attributes($people_id) {

		//get the people experience section
		$people_experience_count = People_experience::where('people_id', $people_id)->count();

		//if empty result from the people profile table
		//load all the fields and set as null values
		//this is require to keep blade process as it is

		$people_experience_arr = array('year_started','year_ended','company_name' ,'position');

		if($people_experience_count == 0) {

			$people_experience = new People_experience;

		} else {

			$people_experience = People_experience::where('people_id', $people_id)->first();

		}

		$people_experience->people_id = $people_id;

		if(!isset($people_experience->people_id)) {

			foreach($people_experience_arr as $experience_field) {

				$people_experience_arr->$experience_field = null;

			}

		}

		return $people_experience;

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 * $update_people update the people profile details
	 *  $update_address update the people address details
	 */

	public function update($id)
	{

		if($this->is_valid_user_action(People::find($id)->business_user_id) == true) {

			$active_tab = Input::get('people_active_tab');

			if($active_tab == 'tab-group') {

				$this->update_people_group($id);

			} else if($active_tab == "tab-profile") {

				// validate the info, create rules for the inputs
				$rules = array(
					'name_family_en'    => 'required', // make sure the email is an actual email and unique in the user
					'name_given1_en'    => 'required',
				);

				// run the validation rules on the inputs from the form
				$validator = Validator::make(Input::all(), $rules);

				// if the validator fails, redirect back to the form

				if ($validator->fails()) {
					return Redirect::to('people/'.$id.'/edit#'.$active_tab)
						->withErrors($validator) // send back all errors to the login form
						->withInput(Input::except('password'));
				} else {
					$this->update_people_profile($id);
				}

			} else if($active_tab == "tab-address") {

				// validate the info, create rules for the inputs
				$rules = array(
					'country_en'    => 'required|numeric'
				);

				// run the validation rules on the inputs from the form
				$validator = Validator::make(Input::all(), $rules);

				// if the validator fails, redirect back to the form

				if ($validator->fails()) {
					return Redirect::to('people/'.$id.'/edit#'.$active_tab)
						->withErrors($validator) // send back all errors to the login form
						->withInput(Input::except('password'));
				} else {

					$this->update_people_address($id);
				}

			} else if($active_tab == "tab-education") {

				// validate the info, create rules for the inputs
				$rules = array(
					'year_started' => 'required',
					'year_ended' => 'required',
					'qualification_name' => 'required',
					'qualification_type'    => 'required|numeric'
				);

				// run the validation rules on the inputs from the form
				$validator = Validator::make(Input::all(), $rules);

				// if the validator fails, redirect back to the form

				if ($validator->fails()) {
					return Redirect::to('people/'.$id.'/edit#'.$active_tab)
						->withErrors($validator) // send back all errors to the login form
						->withInput(Input::except('password'));
				} else {

					$this->update_people_education($id);
				}

			} else if($active_tab == "tab-experience") {

				// validate the info, create rules for the inputs
				$rules = array(
					'year_started' => 'required',
					'year_ended' => 'required',
					'company_name' => 'required',
					'position'    => 'required'
				);

				// run the validation rules on the inputs from the form
				$validator = Validator::make(Input::all(), $rules);

				// if the validator fails, redirect back to the form

				if ($validator->fails()) {
					return Redirect::to('people/'.$id.'/edit#'.$active_tab)
						->withErrors($validator) // send back all errors to the login form
						->withInput(Input::except('password'));
				} else {

					$this->update_people_experience($id);
				}

			} else if($active_tab == "tab-identification") {

				// validate the info, create rules for the inputs
				$rules = array(
					'birth_country'    => 'required|numeric',
					'birth_place' => 'required',
					'birth_date' => 'required',
					'passport_number' => 'required',
					'passport_issue_country' => 'required|numeric',
					'passport_issue_location' => 'required',
					'passport_issue_date' => 'required',
					'passport_expiry_date' => 'required'

				);

				// run the validation rules on the inputs from the form
				$validator = Validator::make(Input::all(), $rules);

				// if the validator fails, redirect back to the form

				if ($validator->fails()) {
					return Redirect::to('people/'.$id.'/edit#'.$active_tab)
						->withErrors($validator) // send back all errors to the login form
						->withInput(Input::except('password'));
				} else {

					$this->update_people_passport($id);
				}


			} else if($active_tab == "tab-referral") {

				// validate the info, create rules for the inputs
				$rules = array(
					'referred_by'    => 'required|exists:people,prn', // make sure the email is an actual email and unique in the user
					'referral_in_brn'    => 'required|exists:businesses,id',
					'referral_out_brn'    => 'required|exists:businesses,id',
					'agency_in_brn'    => 'required|exists:businesses,id'
				);

				// run the validation rules on the inputs from the form
				$validator = Validator::make(Input::all(), $rules);

				// if the validator fails, redirect back to the form

				if ($validator->fails()) {
					return Redirect::to('people/'.$id.'/edit#'.$active_tab)
						->withErrors($validator) // send back all errors to the login form
						->withInput(Input::except('password'));
				} else {

					$this->update_people_referral($id);
				}

			} else {

				return Redirect::to('people/'.$id);

			}

			return Redirect::to('people/'.$id.'/edit#'.$active_tab);

		} else {

			return Redirect::to('/home');

		}



	}

	//update people group section
	public function update_people_group($people_id) {

		$get_people_category = $this->get_people_cat_holdings($people_id);

		$update_people_category = People_category_holdings::find($get_people_category['id']);

		$update_people_category->person_category = Input::get('people_role');

		$update_people_category->save();

	}

    //update people profile section
	public function update_people_profile($people_id) {

		//get the people profile section
		$people_profile_count = People_profile::where('people_id', $people_id)->count();

		if($people_profile_count == 0) {

			$people_profile = new People_profile;

		} else {

			$people_profile = People_profile::where('people_id', $people_id)->first();

		}

		//get the profile section input parameters

		$people_profile->title = Input::get('title');
		$people_profile->people_id = $people_id;
		$people_profile->name_given1_en = Input::get('name_given1_en');
		$people_profile->name_given2_en = Input::get('name_given2_en');
		$people_profile->name_family_en = Input::get('name_family_en');
		$people_profile->sex = Input::get('gender');
		$people_profile->tel_1_country = Input::get('tel_1_country');
		$people_profile->tel_1_area = Input::get('tel_1_area');
		$people_profile->tel_1_number = Input::get('tel_1_number');
		$people_profile->tel_2_country = Input::get('tel_2_country');
		$people_profile->tel_2_area = Input::get('tel_2_area');
		$people_profile->tel_2_number = Input::get('tel_2_number');
		$people_profile->mobile_1_country = Input::get('mobile_1_country');
		$people_profile->mobile_1_area = Input::get('mobile_1_area');
		$people_profile->mobile_1_number = Input::get('mobile_1_number');
		$people_profile->mobile_2_country = Input::get('mobile_2_country');
		$people_profile->mobile_2_area = Input::get('mobile_2_area');
		$people_profile->mobile_2_number = Input::get('mobile_2_number');
		$people_profile->fax_1_country = Input::get('fax_1_country');
		$people_profile->fax_1_area = Input::get('fax_1_area');
		$people_profile->fax_1_number = Input::get('fax_1_number');
		$people_profile->fax_2_country = Input::get('fax_2_country');
		$people_profile->fax_2_area = Input::get('fax_2_area');
		$people_profile->fax_2_number = Input::get('fax_2_number');
		$people_profile->social_name = Input::get('social_name');
		$people_profile->social_value = Input::get('social_value');
		$people_profile->email_2 = Input::get('email_2');
		$people_profile->email_3 = Input::get('email_3');
		$people_profile->people_comment = Input::get('people_comment');

		$people_profile->save();

		$this->insert_update_people_business_holdings($people_id);

		$this->insert_update_people_email($people_id);

	}

	//update people address section
	public function update_people_address($people_id) {

		//get the people address section
		$people_address_count = Addresses::where('people_id', $people_id)->count();

		if($people_address_count == 0) {

			$people_address = new Addresses;

		} else {

			$people_address = Addresses::where('people_id', $people_id)->first();

		}

		//get the profile section input parameters
		$people_address->people_id = $people_id;
		$people_address->unit_suite_room = Input::get('unit_suite_room');
		$people_address->level = Input::get('level');
		$people_address->street_number = Input::get('street_number');
		$people_address->po_box = Input::get('po_box');
		$people_address->street_name_en = Input::get('street_name_en');
		$people_address->suburb_en = Input::get('suburb_en');
		$people_address->city_en = Input::get('city_en');
		$people_address->state_province = Input::get('state_province');
		$people_address->postcode_en = Input::get('postcode_en');
		$people_address->country_en = Input::get('country_en');
		$people_address->address_comment = Input::get('address_comment');

		$people_address->save();

	}

	//update people address section
	public function update_people_education($people_id) {



	}

	//update people address section
	public function update_people_experience($people_id) {

		//get the people education section
		$people_experience_count = People_experience::where('people_id', $people_id)->count();

		if($people_experience_count == 0) {

			$people_experience = new People_experience;

		} else {

			$people_experience = People_experience::where('people_id', $people_id)->first();

		}

		//get the experience section input parameters
		$people_experience->people_id = $people_id;
		$people_experience->year_started = Carbon::createFromFormat('d-m-Y',Input::get('year_started'));
		$people_experience->year_ended = Carbon::createFromFormat('d-m-Y',Input::get('year_ended'));
		$people_experience->company_name = Input::get('company_name');
		$people_experience->position = Input::get('position');

		$people_experience->save();

	}

	//update people passport section
	public function update_people_passport($people_id) {

		//get the people address section
		$people_passport_count = People_passport::where('people_id', $people_id)->count();

		if($people_passport_count == 0) {

			$people_passport = new People_passport;

		} else {

			$people_passport = People_passport::where('people_id', $people_id)->first();

		}

		$people_passport->people_id = $people_id;
		$people_passport->birth_country = Input::get('birth_country');
		$people_passport->birth_place = Input::get('birth_place');
		$people_passport->birth_date = Carbon::createFromFormat('d-m-Y',Input::get('birth_date'));
		$people_passport->passport_number = Input::get('passport_number');
		$people_passport->passport_issue_country = Input::get('passport_issue_country');
		$people_passport->passport_issue_location = Input::get('passport_issue_location');
		$people_passport->passport_issue_date = Carbon::createFromFormat('d-m-Y',Input::get('passport_issue_date'));
		$people_passport->passport_expiry_date = Carbon::createFromFormat('d-m-Y',Input::get('passport_expiry_date'));

		$people_passport->save();

	}

	//update people referral section
	public function update_people_referral($people_id) {

		//get the people address section
		$people_referral_count = People_reference::where('people_id', $people_id)->count();

		if($people_referral_count == 0) {

			$people_referral = new People_reference;

		} else {

			$people_referral = People_reference::where('people_id', $people_id)->first();

		}

		//get the referral section input parameters

		$people_referral->people_id = $people_id;
		$people_referral->referred_by = Input::get('referred_by');
		$people_referral->agency_in_brn = Input::get('agency_in_brn');
		$people_referral->referral_in_brn = Input::get('referral_in_brn');
		$people_referral->referral_out_brn = Input::get('referral_out_brn');

		$people_referral->save();

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$people = People::find($id);
		$people->status = 0;
		$people->save();
		return Redirect::to('people');
	}


    /*
     * Search auto complete field for searching of main principle in the list
     */

	public function search_people() {
	    $search_tag = $_REQUEST["query"];
		//$output = $this->search_principal($query);

		//$find_people = People::where('business_user_id', Auth::user()->business_user_id)->where('id', 'LIKE', '%'.$query.'%')->get();

		$find_people =     People_profile::
		                   join('people' , 'people_profile.people_id' , '=', 'people.id')
			             ->join('business_user', 'people.business_user_id' , '=' , 'business_user.id')
						 ->join('people_category_holdings', 'people_profile.people_id' , '=', 'people_category_holdings.people_id')
						 ->where('people.business_user_id' , '=', Auth::user()->business_user_id)
						 ->where(function ($query) {
								  $query->where('people_category_holdings.person_category' , '=' , 1)
										->orWhere('people_category_holdings.person_category' , '=' ,9)
										->orWhere('people_category_holdings.person_category' , '=' ,10)
										->orWhere('people_category_holdings.person_category' , '=' ,13);
							})
						 ->where(function ($query) {
								  $query->where('people_profile.name_given1_en' ,  'LIKE', '%'.$_REQUEST["query"].'%')
										->orWhere('people_profile.name_family_en' ,  'LIKE', '%'.$_REQUEST["query"].'%')
										->orWhere('people.prn' ,  'LIKE', '%'.$_REQUEST["query"].'%');

						})

						->select('people_profile.people_id As id','people_profile.name_given1_en','people_profile.name_family_en','people.prn as prn')
						->get();



		$results = array();



		//for($i = 0; $i <= count($find_people); $i++) {
		foreach($find_people as $people) {
			$results[] = array(
				"id" => "".$people->prn."",
				"display" => $people->name_given1_en.""."-".$people->name_family_en."",
				"value" => $people->prn."",
				"contracts_count" => Contracts::where('people_id' , $people->id)->count(),
				"contracts_list" => Contracts::where('people_id' , $people->id)->get(),
				"desc" => $people->name_given1_en.""."-".$people->name_family_en.""
			);
		}

		echo json_encode($results);

	}


	/*
	 * After insert the account number get the id and update prn
	 * @param $id is newly crated account id
	 * @param prn is the parent priciple account id
	 * @param suffix is the priciple or parent
	 * @function() if suffix 1 update prn as account id, if suffix not 1 update prn as principleid{accountid}
	 * @return true or false upon finish
	 */

	public function update_prn($id,$prn,$suffix) {

		$people_find = People::find($id);

		if($suffix == 1) {

			//$people_find->prn = strtoupper($this->business_user_name()).(1000+$this->business_user_people_count());

			$people_find->prn = $id.$id;

		} else {

			//$people_find->prn = People::find($prn)->prn;

			$people_find->prn = $id.$prn;

		}

		if($people_find->save()) {

			return true;

		} else {

			return false;

		}

	}

	/*
	 * After insert the account number
	 * System need to update the address
	 * @param $people_id is the account id of newly created
	 * @retun address id
	 */

	public function insert_address($people_id) {

		$address = new Addresses;
		$address->people_id = $people_id;

		//get the address section input parameters

		$address->unit_suite_room = Input::get('unit_suite_room');
		$address->level = Input::get('level');
		$address->street_number = Input::get('street_number');
		$address->po_box = Input::get('po_box');
		$address->street_name_en = Input::get('street_name_en');
		$address->suburb_en = Input::get('suburb_en');
		$address->city_en = Input::get('city_en');
		$address->state_province = Input::get('state_province');
		$address->postcode_en = Input::get('postcode_en');
		$address->country_en = Input::get('country_en');
		$address->address_comment = Input::get('address_comment');


		$address->save();

		return $address->id;
	}

	/*
	 * After insert the account number
	 * System need to update people category holding
	 * @param $people_id is the account id of newly created
	 * @retun holding id
	 */

	public function insert_people_category_holdings($people_id,$holoding_id) {

		$people_holding = new People_category_holdings;

		$people_holding->people_id = $people_id;
		$people_holding->person_category = $holoding_id;

		$people_holding->save();

		return $people_holding->id;


	}

	/*
	 * After insert the account number
	 * System need to update people business holding
	 * @param $people_id is the account id of newly created
	 * @retun holding id
	 */

	public function insert_update_people_business_holdings($people_id)
	{

		if (Input::get('people_business') != null) {

			$find_business_people_count = Peoplebusiness::where('people_id', $people_id)->count();

			if ($find_business_people_count == 0) {

				$people_business = new Peoplebusiness;

			} else {

				$people_business = Peoplebusiness::where('people_id', $people_id)->first();

			}

			$people_business->people_id = $people_id;
			$people_business->business_id = Input::get('people_business');

			$people_business->save();


			return $people_business->id;

	    }

	}

	/*
	 * After update people profile
	 * System need to update people email
	 * @param $people_id is the account id of newly created
	 * @retun people email
	 */

	public function insert_update_people_email($people_id)
	{

		//get the people email section from the users table
		$people_user_email_count = User::where('people_id' , $people_id)->count();

		//get the people email section
		$people_email_count = People_email::where('people_id', $people_id)->count();

		if($people_user_email_count == 1) {

			$people_user_email_row = User::where('people_id' , $people_id)->first();

			$people_user_email_row->email = Input::get('email_1');

			$people_user_email_row->save();

		} else if($people_email_count == 1) {

			$people_email_row = People_email::where('people_id', $people_id)->first();

			$people_email_row->email_1 = Input::get('email_1');

			$people_email_row->save();

		} else {

			$people_email_row = new People_email;

			$people_email_row->email_1 = Input::get('email_1');
			$people_email_row->people_id = $people_id;
			$people_email_row->person_category = BaseController::get_user_level_id($people_id);

			$people_email_row->save();
		}

	}


	/*
    * Search auto complete field for searching of busibess in the list
    */

	public function search_business() {
		$query = $_REQUEST["query"];
		//$output = $this->search_principal($query);

		$find_business = Businesses::where('business_user_id', Auth::user()->business_user_id)
			                         ->where(function ($query) {
										 $query->where('id', 'LIKE', '%' . $_REQUEST["query"] . '%')
											 ->orWhere('bus_name_en', 'LIKE', '%' . $_REQUEST["query"] . '%');
									 })
			                         ->get();


		$results = array();

		//for($i = 0; $i <= count($find_people); $i++) {
		foreach($find_business as $business) {
			$results[] = array(
				"id" => "".$business->id."",
				"display" => "".$business->id."",
				"value" => "".$business->id."",
				"desc" => "".$business->bus_name_en .""
			);
		}

		echo json_encode($results);

	}

	/*
	 * Get the people business id
	 * form people business holding table
	 */

	public function get_people_business_id($people_id) {

		$business_id = null;

		$find_business_people_count = Peoplebusiness::where('people_id', $people_id)->count();

		if($find_business_people_count == 0) {

			return array('count' => 0);

		} else {

			$find_business_people = Peoplebusiness::
			                        join('businesses', 'people_business.business_id' , '=', 'businesses.id')
			                        ->where('people_business.people_id', $people_id)
				                    ->select('businesses.id AS business_id','businesses.bus_name_en AS name')
				                    ->first();

			return array('count' => $find_business_people_count, 'id' => $find_business_people->business_id , 'name' => $find_business_people->name);
		}

	}

	/*
	 * Get the people address
	 * form address  table
	 */

	public function get_people_address($people_id) {
		//$find_business = Peoplebusiness::where('people_id',$people_id);

		$find_address = Addresses::where(
			['people_id' => $people_id])
			->get();

		if(count($find_address) == 0) {
			return $find_address;
		} else {
			return $find_address [0];
		}

	}


	/*
    * Search auto complete field for searching of busibess in the list
    */

	public function search_street() {
		$query = $_REQUEST["query"];
		//$output = $this->search_principal($query);

		$find_streets = Addresses::where('business_user_id', Auth::user()->business_user_id)->where('street_name_en', 'LIKE', '%'.$query.'%')->get();



		$results = array();



		//for($i = 0; $i <= count($find_people); $i++) {
		foreach($find_streets as $street) {
			$results[] = array(
				"id" => $street->id,
				"street_name_en" => $street->street_name_en,
				"suburb_en" => $street->suburb_en,
				'postcode_en' => $street->postcode_en

			);
		}

		echo json_encode($results);

	}

	/*
	 * Get the people cat holding
	 * form  table
	 */

	public function get_people_cat_holdings($people_id) {
		//$find_business = Peoplebusiness::where('people_id',$people_id);

		$find_holding_count = People_category_holdings::where('people_id' , $people_id)->count();

		if($find_holding_count == 0) {

			return 0;

		} else {

			$find_holding = People_category_holdings::where('people_id' , $people_id)->first();

			return $find_holding->person_category;

		}




	}

	public static function get_people_category($id) {

		$find_category = People_category::find($id);

		return $find_category->people_role;
	}

	public static function get_people_relationship($id) {

		$find_relation = People_relationship::find($id);

		return $find_relation->relation_name;
	}

	public static function get_people_social_name($id) {

		$find_social_name = People_social::find($id);

		return $find_social_name->social_name;

	}


	/*
     * Search auto complete field for searching of main principle in the list
     */

	public function search_people_by_name() {
		$query = $_REQUEST["query"];
		//$output = $this->search_principal($query);

		$find_people = People_profile::
		               join('people' , 'people_profile.people_id' , '=', 'people.id')
			         ->join('people_category_holdings', 'people_profile.people_id' , '=', 'people_category_holdings.people_id')
			         ->where('people.business_user_id' , '=', Auth::user()->business_user_id)
			         ->where(function ($query) {
						$query->where('people_category_holdings.person_category' , '=' , 1)
							->orWhere('people_category_holdings.person_category' , '=' ,9)
							->orWhere('people_category_holdings.person_category' , '=' ,10)
							->orWhere('people_category_holdings.person_category' , '=' ,13);
			           })
			         ->where(function ($query) {
				         $query->where('people_profile.name_given1_en' ,  'LIKE', '%'.$_REQUEST["query"].'%')
					           ->orWhere('people_profile.name_family_en' ,  'LIKE', '%'.$_REQUEST["query"].'%');


			           })
			         ->select('people_profile.people_id As id','people_profile.name_given1_en','people_profile.name_family_en','people.prn as prn')
			         ->get();


		$results = array();



		//for($i = 0; $i <= count($find_people); $i++) {
		foreach($find_people as $people) {

			    $results[] = array(
					"id" => "".$people->id."",
					"display" => "".$people->id."",
					"value" => "".$people->id."",
					"desc" =>  "".$people->prn.""." - "."".$people->name_given1_en . ' - ' .$people->name_family_en
				);



		}

		echo json_encode($results);

	}

	/*
     * Search auto complete field for searching of main principle in the list
     */

	public function search_staff() {
		$query = $_REQUEST["query"];
		//$output = $this->search_principal($query);

		$find_people = People_profile::
		               join('people' , 'people_profile.people_id' , '=', 'people_id')
			           ->join('people_category_holdings', 'people_profile.people_id' , '=', 'people_category_holdings.people_id')
			           ->where('people.business_user_id' ,  Auth::user()->business_user_id)
			           ->where('people_category_holdings.person_category' ,  11)
		               ->where('people_profile.name_given1_en', 'LIKE', '%'.$query.'%')
			           ->select('people_profile.people_id as id','people_profile.name_given1_en','people_profile.name_family_en')
			           ->get();



		$results = array();



		//for($i = 0; $i <= count($find_people); $i++) {
		foreach($find_people as $people) {

				$results[] = array(
					"id" => "".$people->id."",
					"display" => "".$people->id."",
					"value" => "".$people->id."",
					"desc" =>  "".$people->id.""." - "."".$people->name_given1_en . ' - ' .$people->name_family_en .""
				);


		}

		echo json_encode($results);

	}

	/*
	 * Get the business user is people count
	 */

	public function business_user_people_count() {

		return People::where('business_user_id' , Auth::user()->business_user_id)->count();

	}

	/*
	 * Get the business user business name, just first 2 letters of the name
	 */

	public function business_user_name() {


		return substr(Business_user::find(Auth::user()->business_user_id)->business_name, 0, 2);

	}

	/*
     * get the all business user staff list
     */

	public static function business_user_staff($sort = 'id') {

		$find_people = People_profile::
		      join('people' , 'people_profile.people_id' , '=', 'people.id')
			->join('people_category_holdings', 'people.id' , '=', 'people_category_holdings.people_id')
			->where('people.business_user_id', '=' , Auth::user()->business_user_id)
			->where('people_category_holdings.person_category', '=' ,  11)
			->select('people.prn','people_profile.people_id','people_profile.name_given1_en','people_profile.name_family_en')
			->get();



		$results = array();

		foreach($find_people as $people) {

			if($sort == 'id') {

				$results[$people->people_id] = $people->people_id."-".$people->name_given1_en."-".$people->name_family_en;

			} else if($sort == 'prn') {

				$results[$people->prn] = $people->prn."-".$people->name_given1_en."-".$people->name_family_en;

			}


		}

		return $results;

	}

	/*
     * get the all business user staff with no user accounts
     */

	public static function business_user_no_login_staff() {

		$find_people = People_profile::
		      join('people' , 'people_profile.people_id' , '=', 'people.id')
			->join('people_category_holdings', 'people.id' , '=', 'people_category_holdings.people_id')
			->where('people.business_user_id', '=' , Auth::user()->business_user_id)
			->where('people_category_holdings.person_category', '=' ,  11)
			->select('people.prn','people_profile.people_id','people_profile.name_given1_en','people_profile.name_family_en')
			->get();



		$results = array();

		foreach($find_people as $people) {

			if(User::where('people_id')->count() == 0) {

				$results[$people->people_id] = $people->people_id."-".$people->name_given1_en."-".$people->name_family_en;

			}


		}

		return $results;

	}

	/*
     * get the all business user staff list
     */

	public static function business_user_rate_staff() {

		$find_people = People_profile::
		join('people' , 'people_profile.people_id' , '=', 'people_id')
			->join('people_category_holdings', 'people_profile.people_id' , '=', 'people_category_holdings.people_id')
			->where('people.business_user_id' ,  Auth::user()->business_user_id)
			->where(function ($query) {
				$query->where('people_category_holdings.person_category' , '=' , 11)
					->orWhere('people_category_holdings.person_category' , '=' ,15);
			})
			->select('people_profile.people_id as id','people_profile.name_given1_en','people_profile.name_family_en')
			->get();

		$results = array();

		foreach($find_people as $people) {

			$results[$people->id] = $people->id."-".$people->name_given_1."-".$people->name_family_en;

		}

		return $results;

	}

	/*
     * get the all business user staff list
     */

	public static function business_user_dibp() {

		$find_people = People_profile::
		join('people' , 'people_profile.people_id' , '=', 'people_id')
			->join('people_category_holdings', 'people_profile.people_id' , '=', 'people_category_holdings.people_id')
			->where('people.business_user_id' ,  Auth::user()->business_user_id)
			->where('people_category_holdings.person_category' ,  5)
			->select('people_profile.people_id as id','people_profile.name_given1_en','people_profile.name_family_en')
			->get();

		$results = array();

		foreach($find_people as $people) {

			$results[$people->id] = $people->id."-".$people->name_given_1."-".$people->name_family_en;

		}

		return $results;

	}

	/*
	 * This is ajax json request to get the people contracts list
	 */

	public function get_prn_tree($prn) {

		$search_last_digits = substr($prn, 4, 8);

		$people_relations = People::
		                    join('people_profile', 'people.id' , '=' , 'people_profile.people_id')
			              ->join('people_relationship' , 'people.prn_suffix' , '=' , 'people_relationship.id')
		                  ->where('people.prn' ,  'LIKE', '%'.$search_last_digits.'%')
			              ->select('people.prn as prn','people_profile.name_given1_en as given_name','people_profile.name_family_en as family_name','people_relationship.relation_name')
			              ->get();

		$results = array();

		foreach($people_relations as $relation) {

			$results[] = array(
				"prn" => $relation->prn,
				"family_name" => $relation->family_name,
				"given_name" => $relation->given_name,
				"relation_name" => $relation->relation_name
			);

		}

		echo json_encode($results);
	}

	/*
	 *below function will give combination of prn , first and last name
	 */

	public static function get_people_display_info($people_id) {

		$people_info = People_profile::
		               join('people' , 'people_profile.people_id' , '=' , 'people_id')
			        ->where('people_profile.people_id' , $people_id)
			        ->select('people.prn as prn' , 'people_profile.name_family_en as family_name' , 'people_profile.name_given1_en as given_name')
			        ->first();

		return $people_info->prn." - ".$people_info->family_name." - ".$people_info->given_name;

	}

	public static function get_people_prn_name_display_info($people_id) {

		$people_row = People::find($people_id);

		$people_profile = People_profile::where("people_id" , $people_id)->first();

		return $people_row->prn.'-'.$people_profile->name_given1_en;

	}

	public static function get_people_prn_display_info($people_id) {

		$people_row = People::find($people_id);

		return $people_row->prn;

	}

	/*
     * get the all business user staff list
     */

	public static function people_education_degree_types() {

		$degrees = Degree_type::get();


		$results = array();

		foreach($degrees as $degree) {

			$results[$degree->id] = $degree->degree_name;

		}

		return $results;

	}

	/*
	 * get the all people education rows
	 */

	public function all_people_education($people_id) {

		$output = "";

		$all_people_education = People_education::where('people_id' ,$people_id)->get();

		foreach($all_people_education as $education) {


			$output .= "<tr people_education_id='".$education['id']."' year_started='".date('d-m-Y', strtotime($education['year_started']))."' year_ended='".date('d-m-Y', strtotime($education['year_ended']))."' qualification_type='".$education['qualification_type']."' qualification_name='".$education['qualification_name']."'>
                          <td class='data_table_align'><a href='#' class='edit_people_education'>".date('d-m-Y', strtotime($education['year_started']))."</a></td>
                          <td class='data_table_align'><a href='#' class='edit_people_education'>".date('d-m-Y', strtotime($education['year_ended']))."</a></td>
                          <td class='data_table_align'><a href='#' class='edit_people_education'>".Degree_type::find($education['qualification_type'])->degree_name."</td>
                          <td class='data_table_align'><a href='#' class='edit_people_education'>".$education['qualification_name']."</td>
                         </tr>";

		}


		return $output;

	}


	/*
	 * Load all business partner contacts
	 */

	public function get_all_business_partner_contacts() {

		return $this->all_people_education(Input::get('people_id'));

	}

	/*
	 * creating people education
	 */

	public function create_people_education() {

		$people_id = Input::get('people_id');

		$return_array = array();

		$people_education = new People_education;

		//get the education section input parameters
		$people_education->people_id = $people_id;
		$people_education->year_started = Carbon::createFromFormat('d-m-Y',Input::get('year_started'));
		$people_education->year_ended = Carbon::createFromFormat('d-m-Y',Input::get('year_ended'));
		$people_education->qualification_type = Input::get('qualification_type');
		$people_education->qualification_name = Input::get('qualification_name');

		$people_education->save();

		$return_array ['error'] = 0;
		$return_array ['result'] = $this->all_people_education($people_id);

		return json_encode($return_array);

	}

	/*
	 * Below function is to save the business partner contact
	 */

	public function save_people_education() {

		$people_education_id = Input::get('people_education_id');

		$people_education = People_education::find($people_education_id);

		//get the education section input parameters
		$people_education->year_started = Carbon::createFromFormat('d-m-Y',Input::get('year_started'));
		$people_education->year_ended = Carbon::createFromFormat('d-m-Y',Input::get('year_ended'));
		$people_education->qualification_type = Input::get('qualification_type');
		$people_education->qualification_name = Input::get('qualification_name');

		$people_education->save();

		$return_array ['error'] = 0;
		$return_array ['result'] = $this->all_people_education($people_education->people_id);

		return json_encode($return_array);

	}

	/*
	 * get the all people experience rows
	 */

	public function all_people_experience($people_id) {

		$output = "";

		$all_people_experience = People_experience::where('people_id' ,$people_id)->get();

		foreach($all_people_experience as $experience) {


			$output .= "<tr people_experience_id='".$experience['id']."' year_started='".date('d-m-Y', strtotime($experience['year_started']))."' year_ended='".date('d-m-Y', strtotime($experience['year_ended']))."' company_name='".$experience['company_name']."' position='".$experience['position']."'>
                          <td class='data_table_align'><a href='#' class='edit_people_experience'>".date('d-m-Y', strtotime($experience['year_started']))."</a></td>
                          <td class='data_table_align'><a href='#' class='edit_people_experience'>".date('d-m-Y', strtotime($experience['year_ended']))."</a></td>
                          <td class='data_table_align'><a href='#' class='edit_people_experience'>".$experience['company_name']."</td>
                          <td class='data_table_align'><a href='#' class='edit_people_experience'>".$experience['position']."</td>
                         </tr>";

		}


		return $output;

	}


	/*
	 * Load all people experience
	 */

	public function get_all_business_partner_experience() {

		return $this->all_people_experience(Input::get('people_id'));

	}

	/*
	 * creating people education
	 */

	public function create_people_experience() {

		$people_id = Input::get('people_id');

		$return_array = array();

		$people_experience = new People_experience;

		//get the experience section input parameters
		$people_experience->people_id = $people_id;
		$people_experience->year_started = Carbon::createFromFormat('d-m-Y',Input::get('year_started'));
		$people_experience->year_ended = Carbon::createFromFormat('d-m-Y',Input::get('year_ended'));
		$people_experience->company_name = Input::get('company_name');
		$people_experience->position = Input::get('position');

		$people_experience->save();

		$return_array ['error'] = 0;
		$return_array ['result'] = $this->all_people_experience($people_id);

		return json_encode($return_array);

	}

	/*
	 * Below function is to save the people experience
	 */

	public function save_people_experience() {

		$people_experience_id = Input::get('people_experience_id');

		$people_experience = People_experience::find($people_experience_id);

		//get the experience section input parameters
		$people_experience->year_started = Carbon::createFromFormat('d-m-Y',Input::get('year_started'));
		$people_experience->year_ended = Carbon::createFromFormat('d-m-Y',Input::get('year_ended'));
		$people_experience->company_name = Input::get('company_name');
		$people_experience->position = Input::get('position');

		$people_experience->save();

		$return_array ['error'] = 0;
		$return_array ['result'] = $this->all_people_experience($people_experience->people_id);

		return json_encode($return_array);

	}





}
