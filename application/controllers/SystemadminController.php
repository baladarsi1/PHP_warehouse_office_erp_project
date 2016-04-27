<?php
use App\Models\Businesses;
use App\Models\Currencycodes;
use App\Models\Business_user;
use App\Models\Business_prospects;
use App\Models\People;
use App\Models\People_profile;
use App\Models\People_category_holdings;
use App\Models\Subscription_rates;
use App\Models\Subscription_sales;
use App\Models\Subscription_types;
use Carbon\Carbon;

class SystemadminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index()
	{

		$return_arr = array(
			"business_users" => Business_user::get(),
			"business_prospects" => Business_prospects::get(),
			"breadcums" => $this->bread_cums("business prospects and clients","index")
		);
		return View::make('pages.system_admin.index')
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
			"breadcums" => $this->bread_cums("business","create"),
			"countrycodes" => $this->getAllcoutrycodes(),
			"currencycodes" => $this->sort_currency_codes($this->getAllcurrencycodes()),
			"stateprovinces" => $this->sort_state_provinces($this->getAllstateprovince()),
			"corp_structure" => $this->corp_structure()
		);
		return View::make('pages.business.create', $return_arr);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$new_business = new Businesses;

        $new_business = $this->business_input($new_business);

		$new_business->save();

		if (Input::has('direct_submit'))
		{
			return Redirect::to('business');

		} else {
			return $new_business->id;
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
		$single_business = Businesses::find($id);

		$return_arr = array(
			"ajax_load" => $ajax,
			"breadcums" => $this->bread_cums("business","create"),
			"single_business" => $single_business
		);
		return View::make('pages.business.show', $return_arr);
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
		$single_business = Businesses::find($id);

		// show the edit form and pass the nerd

		$return_arr = array(
			"ajax_load" => 0,
			"breadcums" => $this->bread_cums("business","edit"),
			"single_business" => $single_business,
			"countrycodes" => $this->sort_country_codes($this->getAllcoutrycodes()),
			"currencycodes" => $this->sort_currency_codes($this->getAllcurrencycodes()),
			"corp_structure" => $this->corp_structure()
		);
		return View::make('pages.business.edit', $return_arr);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$single_business = Businesses::find($id);

		$single_business = $this->business_input($single_business);

		$single_business->save();

		return Redirect::to('business');

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$update_business = Businesses::find($id);
		$update_business->status = 0;
		$update_business->save();
		return Redirect::to('business');
	}

	public function business_input($new_business) {

		$new_business->business_user_id = Auth::user()->business_user_id;
		$new_business->bus_name_en = Input::get('bus_name_en');
		$new_business->bus_type = Input::get('bus_type');
		$new_business->bus_licence = Input::get('bus_licence');
		$new_business->bus_abn = Input::get('bus_abn');
		$new_business->bus_acn = Input::get('bus_acn');
		$new_business->bus_tfn = Input::get('bus_tfn');
		$new_business->incoming_referral = Input::get('incoming_referral');
		$new_business->outgoing_referral = Input::get('outgoing_referral');
		$new_business->agent = Input::get('agent');

		if(Input::get('bus_est_date') == null) {

			$new_business->bus_est_date = null;

		} else {

			$new_business->bus_est_date = Carbon::createFromFormat('d-m-Y',Input::get('bus_est_date'));

		}

		$new_business->bus_capital = Input::get('bus_capital');
		$new_business->currency = Input::get('currency');

		if(Input::get('bus_start_date') == null) {

			$new_business->bus_start_date = null;

		} else {

			$new_business->bus_start_date = Carbon::createFromFormat('d-m-Y',Input::get('bus_start_date'));

		}

		$new_business->corp_structure = Input::get('corp_structure');
		$new_business->website_bus = Input::get('website_bus');
		$new_business->bus_free_form_text = Input::get('bus_free_form_text');

		return $new_business;
	}


	//update the business user notes
	public function save_business_user_notes() {

		$userid = Input::get('userid');
		$table = Input::get('table');
		$business_user_txt = Input::get('business_user_txt');

		if($table == 'prospects') {

			$user = Business_prospects::find($userid);

		} else if($table == 'clients') {

			$user = Business_user::find($userid);

		}

		$user->notes = $business_user_txt;
		$user->save();

		return $user->id;

	}

	//convert prospect to client
	public function convert_prospect_to_client() {

		$business_id = Input::get('business_id');

		/*
		 * Get the business details from the business prospected
		 */

		$business_prospect_details = Business_prospects::find($business_id);

		/*
		 * Insert business prospects into business user
		 */

		$business_user = new Business_user;

		$business_user->business_name = $business_prospect_details->business_name;
		$business_user->website = $business_prospect_details->website;
		$business_user->address_1 = $business_prospect_details->address_1;
		$business_user->address_2 = $business_prospect_details->address_2;
		$business_user->suburb = $business_prospect_details->suburb;
		$business_user->state = $business_prospect_details->state;
		$business_user->is_active = $business_prospect_details->is_active;
		$business_user->marn = $business_prospect_details->marn;
		$business_user->business_status = 1;
		$business_user->notes = $business_prospect_details->business_name;

		$business_user->save();

		$business_user_id = $business_user->id;

		/*
		 * After getting the business user id
		 * update the current subscription id
		 */

		$business_user = Business_user::find($business_user_id);

		$business_user->subscription_current_id = $this->get_current_rate($business_user_id);

		$business_user->save();


		/*
		 * After transfer the data from business prospect to business user
		 * Insert the basic data into people and get the people id
		 */

		$people = new People;

		$people->business_user_id = $business_user_id;
		$people->prn_suffix = 1;
		$people->status = 1;

		$people->save();

		/*
		 * After created new people update the people prn
		 */

		$people_created = People::find($people->id);

		$people_created->prn = $people->id.$people->id;

		$people_created->save();

		/*
		 * After updating the prn create people profile section
		 */

		$people_profile = new People_profile;

		$people_profile->people_id = $people_created->id;
		$people_profile->name_given1_en =  $business_prospect_details->name_given1_en;
		$people_profile->name_family_en =  $business_prospect_details->name_family_en;
		$people_profile->tel_1_number =  $business_prospect_details->tel_1_number;
		$people_profile->mobile_1_number =  $business_prospect_details->mobile_1_number;

		$people_profile->save();

		/*
		 * After updating people profile insert into people category holdings
		 */

		$people_category_holding = new People_category_holdings;

		$people_category_holding->people_id = $people_created->id;
		$people_category_holding->person_category = 15;

		$people_category_holding->save();

		/*
		 * After saving people holding final step
		 * Insert new user and generate the password
		 */

		$password = $this->create_random_password();

		$user = new User;
		$user->people_id = $people_created->id;
		$user->business_user_id = $business_user_id;
		$user->email = $business_prospect_details->email;
		$user->password = Hash::make($password);
		$user->is_active = 1;

		$user->save();

		$name_arr = explode('@',$user->email);
		$name = $name_arr[0];
		$email = $user->email;


		Mail::send('emails.new_user', array('password' => $password , 'name' => $name), function($message) use($email,$name)
		{
			$message->to($email,$name)->subject('Welcome email from Project Visa');
		});


		$business_prospect_details->delete();

	    echo $people_created->id;

		echo '<br />';

		echo $user->email;

		echo '<br />';

		echo $password;

	}

	//get the current subscription
	public function get_current_subscription() {

		 $current_rate = Subscription_rates::
		                   where('current_from' , '<=' , Carbon::now())
		                 ->where('current_to' , '>=' , Carbon::now())
			             ->first();

		return $current_rate->id;

	}

	//get the current rate
	public function get_current_rate($business_user_id) {

		$subscription_type = 1;

		$subscription_sale = new Subscription_sales;

		$subscription_sale->business_user_id = $business_user_id;
		$subscription_sale->start_date = Carbon::now();
		$subscription_sale->end_date = Carbon::now()->addMonth();

		if($subscription_type == 1) {

			$subscription_sale->sale_amount = 0;

		}

		$subscription_sale->subscription_type = $subscription_type;
		$subscription_sale->pay_pay_trn = 0;

		$subscription_sale->save();

		return $subscription_sale->id;

	}

	//resend the password to business user
	public function business_user_resend_password() {

		$business_user_id = Input::get('business_user_id');
		$business_user_admin_people_id = Input::get('business_user_admin_people_id');

		$user = User::where('business_user_id' , $business_user_id)->where('people_id' , $business_user_admin_people_id)->first();

		$password = $this->create_random_password();

		$user->password = Hash::make($password);

		$user->save();

		$name_arr = explode('@',$user->email);
		$name = $name_arr[0];
		$email = $user->email;


		Mail::send('emails.business_user_resend_password', array('password' => $password , 'name' => $name), function($message) use($email,$name)
		{
			$message->to($email,$name)->subject('Password reset from Project Visa');
		});


        return "Password is successfully reset. The new password is ".$password;



	}

	//get the business user current subscription starting date
	static public function current_subscription_start_date($subscription_id) {

		$subscription_sale = Subscription_sales::find($subscription_id);

		if(isset($subscription_sale->start_date)) {

			return date('d-m-Y', strtotime($subscription_sale->start_date));

		} else {

			return "";

		}

	}

	//get the business user current subscription ending date
	static public function current_subscription_end_date($subscription_id) {

		$subscription_sale = Subscription_sales::find($subscription_id);

		if(isset($subscription_sale->end_date)) {

			return date('d-m-Y', strtotime($subscription_sale->end_date));

		} else {

			return "";

		}

	}

	//get the business user current subscription sale
	static public function current_subscription_sale_amount($subscription_id) {

		$subscription_sale = Subscription_sales::find($subscription_id);

		if(isset($subscription_sale->sale_amount)) {

			return $subscription_sale->sale_amount;

		} else {

			return "";

		}

	}




}
