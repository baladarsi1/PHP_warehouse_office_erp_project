<?php

use App\Models\Businesses;
use App\Models\Currencycodes;
use Carbon\Carbon;

class BusinessController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index()
	{
		$businesses = Businesses::where('business_user_id' , Auth::user()->business_user_id)->get();
		$return_arr = array(
			"businesses" => $businesses,
			"breadcums" => $this->bread_cums("business","index")
		);
		return View::make('pages.business.index')
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
			"countrycodes" => $this->sort_country_codes($this->getAllcoutrycodes()),
			"currencycodes" => $this->sort_currency_codes($this->getAllcurrencycodes()),
			"stateprovinces" => $this->sort_state_provinces($this->getAllstateprovince()),
			"industrydivisions" => $this->sort_industry_divisions($this->getAllindustrydivisions()),
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
			"industrydivisions" => $this->sort_industry_divisions($this->getAllindustrydivisions()),
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
		$new_business->country_en = Input::get('country_en');

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

	public function corp_structure() {
		$return_arr = array(
			0 => 'Company',
			1 => 'Partnership',
			2 => 'Sole trader',
			3 => 'Trust'
		);

		return $return_arr;
	}

	static public function get_currency_code($id) {
		$find_currency = Currencycodes::find($id);
		return $find_currency->currency_code;
	}

	static public function get_default_currency() {

		return 8;
	}




}
