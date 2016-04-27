<?php

use App\Models\Contracts;
use App\Models\Billable;
use App\Models\Businesses;
use App\Models\Visatypes;
use App\Models\People;
use App\Models\Rates;
use Carbon\Carbon;


class BillableController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$billables = Billable::
			          join('people' , 'service_contract_billable.people_id' , '=' , 'people.id')
			         ->where('people.business_user_id' ,  Auth::user()->business_user_id)
		             ->get();

		$return_arr = array(
			"billables" => $billables,
			"breadcums" => $this->bread_cums("billable","index")
		);
		return View::make('pages.billable.index')
			->with($return_arr);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function billable_scn($scn)
	{

		$billables = Billable::
		join('people' , 'service_contract_billable.people_id' , '=' , 'people.id')
			->where('people.business_user_id' ,  Auth::user()->business_user_id)
			->where('service_contract_billable.service_contract_id' ,  $scn)
			->get();

		$return_arr = array(
			"billables" => $billables,
			"breadcums" => $this->bread_cums("billable","index")
		);
		return View::make('pages.billable.index')
			->with($return_arr);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($ajax = 0)
	{

		$user_role = People::find(Auth::user()->people_id)->user_group_row;

		if($user_role->person_category == 11 || $user_role->person_category == 15) {

			$return_arr = array(
				"ajax" => $ajax,
				"breadcums" => $this->bread_cums("billable","create"),
				"billing_codes" => $this->sort_billing_codes($this->getAllBillingCodes()),
				"current_rates" => $this->get_current_rates(),
				"current_rate" => $this->get_current_rate(),
				"user_role" => $user_role
			);

		} else {

			$return_arr = array(
				"ajax" => $ajax,
				"breadcums" => $this->bread_cums("billable","create"),
				"current_rate" => 'N/A',
				"user_role" => $user_role
			);

		}

		return View::make('pages.billable.create', $return_arr);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create_scn($scn = 0)
	{

		$user_role = People::find(Auth::user()->people_id)->user_group_row;

		if($user_role->person_category == 11 || $user_role->person_category == 15) {

			$return_arr = array(
				"ajax" => 0,
				"breadcums" => $this->bread_cums("billable","create"),
				"billing_codes" => $this->sort_billing_codes($this->getAllBillingCodes()),
				"current_rates" => $this->get_current_rates(),
				"current_rate" => $this->get_current_rate(),
				"user_role" => $user_role,
				"scn_id" => $scn
			);

		} else {

			$return_arr = array(
				"ajax" => 0,
				"breadcums" => $this->bread_cums("billable","create"),
				"current_rate" => 'N/A',
				"user_role" => $user_role,
				"scn_id" => $scn
			);

		}

		return View::make('pages.billable.create', $return_arr);
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
			'service_contract_id' => 'required|numeric|exists:service_contract,id',
			'date_worked_on'    => 'required'
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form

		if ($validator->fails()) {
			return Redirect::to('billable/create')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password'));
		} else {

			$new_billable = new Billable;

			$new_billable = $this->billable_input($new_billable);

			$new_billable->save();

			//return $new_billable->id;
			return Redirect::to('billable');
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
		$single_contract = Billable::find($id);

		$return_arr = array(
			"ajax_load" => $ajax,
			"breadcums" => $this->bread_cums("billable","create"),
			"single_contract" => $single_contract
		);
		return View::make('pages.billable.show', $return_arr);
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
		$single_contract = Billable::find($id);

		// show the edit form and pass the nerd

		$return_arr = array(
			"ajax_load" => 0,
			"breadcums" => $this->bread_cums("billable","edit"),
			"single_contract" => $single_contract,
			"countrycodes" => $this->sort_country_codes($this->getAllcoutrycodes()),
			"currencycodes" => $this->sort_currency_codes($this->getAllcurrencycodes()),
			"corp_structure" => $this->corp_structure()
		);
		return View::make('pages.billable.edit', $return_arr);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$single_billable = Billable::find($id);

		$single_billable = $this->billable_input($single_billable);

		$single_billable->save();

		return Redirect::to('billable');

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

	public function billable_input($billable) {

		$billable->service_contract_id = Input::get('service_contract_id');
		$billable->people_id = Input::get('people_id');
		$billable->date_worked_on = Carbon::createFromFormat('d-m-Y',Input::get('date_worked_on'));
		$billable->current_hourly_rate_id = Input::get('current_hourly_rate_id');
		$billable->pre_charged_time_incremental = Input::get('pre_charged_time_incremental');
		$billable->billing_code = Input::get('billing_code');
		$billable->associated_C02 = Input::get('associated_C02');
		$billable->associated_C03 = Input::get('associated_C03');
		$billable->associated_C04 = Input::get('associated_C04');
		$billable->associated_C05 = Input::get('associated_C05');
		$billable->associated_C06 = Input::get('associated_C06');
		$billable->associated_C07 = Input::get('associated_C07');
		$billable->associated_C08 = Input::get('associated_C08');
		$billable->associated_C09 = Input::get('associated_C09');

		return $billable;
	}

	public function get_current_rates() {

		$get_current_rates = Rates::where('people_id' , Auth::user()->people_id)
			                 ->orderby('id', 'desc')
		                     ->get();

		$output = array();

		foreach($get_current_rates as $rate) {

			$output[$rate['id']] = $rate['current_rate'];
		}

		return $output;

	}

	public function get_current_rate() {

		$get_current_rate_count = Rates::where('people_id' , Auth::user()->people_id)
			                ->orderby('id', 'desc')
			                ->count();

		if(count($get_current_rate_count) == 0) {
			return null;
		} else {

			$get_current_rate = Rates::where('people_id' , Auth::user()->people_id)
				->orderby('id', 'desc')
				->first();

			return $get_current_rate->id;
		}


	}

	public static function get_rate_amount($rate_id) {

		$get_current_rate = Rates::find($rate_id);
		return $get_current_rate->current_rate;

	}


	public static function get_log_id() {

		$log_user_arr = People::where('id' , Auth::user()->people_id)->first();

		return $log_user_arr->id;
	}


	public static function get_associated_bill_code($bill_code) {

		$bill_name =  \DB::table('billing_codes')
				->where('billing_code' , $bill_code)
				->first();

		return $bill_name->billing_name;
	}

	public static function get_all_bill_coes(){
		$bill_codes = \DB::table('billing_codes')
			->get();

		return $bill_codes;
	}

	public static function get_all_bill_codes_html() {

		$output ="";

		$bill_codes = \DB::table('billing_codes')
			->get();

		foreach($bill_codes as $code) {
			$output .= $code->billing_code_display.'-'.$code->billing_name.'<br />';
		}

		return $output;
	}

}
