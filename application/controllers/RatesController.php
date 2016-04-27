<?php

use App\Models\Rates;
use App\Models\People;
use App\Models\People_profile;
use Carbon\Carbon;


class RatesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$rates = Rates::where('business_user_id' , Auth::user()->business_user_id)->orderBy('id', 'DESC')->orderBy('people_id', 'ASC')->get();

		$return_arr = array(
			"rates" => $rates,
			"breadcums" => $this->bread_cums("rates","index")
		);
		return View::make('pages.rates.index')
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
		$user_role = People::find(Auth::user()->people_id)->user_group_row;

		$return_arr = array(
			"ajax" => $ajax,
			"breadcums" => $this->bread_cums("rates","create"),
			"user_role" => $user_role
		);

		return View::make('pages.rates.create', $return_arr);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$new_rate = new Rates;

		$new_rate = $this->rates_input($new_rate);

		$new_rate->save();

		//return $new_billable->id;
		return Redirect::to('rates');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id,$ajax = 0)
	{

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{


	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{


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

	public function rates_input($rate) {

		$rate->business_user_id = Auth::user()->business_user_id;
		$rate->people_id = Input::get('people_id');
		$rate->current_rate = Input::get('current_rate');
		$rate->creation_date = date('Y-m-d');
		return $rate;

	}



}
