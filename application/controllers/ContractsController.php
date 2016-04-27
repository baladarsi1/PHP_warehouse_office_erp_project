<?php

use App\Models\Contracts;
use App\Models\Businesses;
use App\Models\Visatypes;
use Carbon\Carbon;


class ContractsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contracts = Contracts::where('business_user_id' , Auth::user()->business_user_id)->get();
		$return_arr = array(
			"contracts" => $contracts,
			"breadcums" => $this->bread_cums("contracts","index")
		);
		return View::make('pages.contracts.index')
			->with($return_arr);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($people_id,$ajax = 0)
	{

		$return_arr = array(
			"people_id" => $people_id,
			"ajax" => $ajax,
			"breadcums" => $this->bread_cums("Contracts","create"),
			"sc_status" => $this->service_contract_status()
		);
		return View::make('pages.contracts.create', $return_arr);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$people_id = Input::get('people_id');

		// validate the info, create rules for the inputs
		$rules = array(
			'sc_date'    => 'required', // make sure the email is an actual email and unique in the user
			'sc_visa_price'    => 'required|numeric',
			'visa_type' => 'required',
			'sc_lead' => 'required|numeric'

		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form

		if ($validator->fails()) {
			return Redirect::to('contracts/create/'.$people_id.'/0')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password'));
		} else {

			$new_contracts = new Contracts;

			$new_contracts = $this->contracts_input($new_contracts);

			$new_contracts->save();

			//return $new_contracts->id;
			return Redirect::to('contracts');
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
		$single_contract = Contracts::find($id);

		$return_arr = array(
			"ajax_load" => $ajax,
			"breadcums" => $this->bread_cums("contracts","details"),
			"single_contract" => $single_contract
		);
		return View::make('pages.contracts.show', $return_arr);
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
		$single_contract = Contracts::find($id);

		// show the edit form and pass the nerd

		$return_arr = array(
			"ajax_load" => 0,
			"breadcums" => $this->bread_cums("contracts","edit"),
			"single_contract" => $single_contract,
			"countrycodes" => $this->sort_country_codes($this->getAllcoutrycodes()),
			"currencycodes" => $this->sort_currency_codes($this->getAllcurrencycodes()),
			"sc_status" => $this->service_contract_status()
		);
		return View::make('pages.contracts.edit', $return_arr);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{


		$single_contract = Contracts::find($id);

		$single_contract = $this->contracts_input($single_contract);

		$single_contract->save();

		return Redirect::to('contracts');

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

	public function contracts_input($new_contract) {


		$new_contract->people_id = Input::get('people_id');
		$new_contract->business_user_id = Auth::user()->business_user_id;
		$new_contract->sc_date =  Carbon::createFromFormat('d-m-Y',Input::get('sc_date'));
		$new_contract->sc_status = Input::get('sc_status');
		$new_contract->sc_lead = Input::get('sc_lead');
		$new_contract->sc_visa_price = Input::get('sc_visa_price');
		$new_contract->visa_type = Input::get('visa_type');

		if(Input::get('visa_lodgement_date') == null) {

			$new_contract->visa_lodgement_date =  null;


		} else {

			$new_contract->visa_lodgement_date =  Carbon::createFromFormat('d-m-Y',Input::get('visa_lodgement_date'));

		}

		if(Input::get('visa_issue_date') == null) {

			$new_contract->visa_issue_date =  null;


		} else {

			$new_contract->visa_issue_date =  Carbon::createFromFormat('d-m-Y',Input::get('visa_issue_date'));

		}

		if(Input::get('visa_expiry_date') == null) {

			$new_contract->visa_expiry_date =  null;

		} else {

			$new_contract->visa_expiry_date =  Carbon::createFromFormat('d-m-Y',Input::get('visa_expiry_date'));

		}

		if(Input::get('dibp_application_id') == null) {

			$new_contract->dibp_application_id =  null;

		} else {

			$new_contract->dibp_application_id =  Input::get('dibp_application_id');

		}

		if(Input::get('dibp_file_number') == null) {

			$new_contract->dibp_file_number =  null;

		} else {

			$new_contract->dibp_file_number =  Input::get('dibp_file_number');

		}

		if(Input::get('dibp_people_id') == null) {

			$new_contract->dibp_people_id =  null;

		} else {

			$new_contract->dibp_people_id =  Input::get('dibp_people_id');

		}

		if(Input::get('sc_free_text') == null) {

			$new_contract->sc_free_text =  null;

		} else {

			$new_contract->sc_free_text =  Input::get('sc_free_text');

		}

		return $new_contract;

	}

	public function corp_structure() {
		$return_arr = array(
			0 => 'Company',
			1 => 'Partnership',
			2 => 'Sole',
			3 => 'trader',
			4 => 'Trust'
		);

		return $return_arr;
	}

	/*
    * Search auto complete field for searching of main principle in the list
    */

	public function search_contract() {
		$query = $_REQUEST["query"];
		$find_contracts = Contracts::where('business_user_id' , Auth::user()->business_user_id)->where('id', 'LIKE', '%'.$query.'%')->get();
		$results = array();
		foreach($find_contracts as $contract) {

			$visa_row = Visatypes::find($contract->visa_type);
			$visa_des = $visa_row->type.' - '.$visa_row->group.' - '.$visa_row->class.' - '.$visa_row->title_1.' - '.$visa_row->subclass.' - '.$visa_row->title_2;

			$results[] = array(
				"id" => "".$contract->id."",
				"value" => "".$contract->id."",
				"visa_desc" => $visa_des,
				"people_id" => $contract->people_id,
				"sc_lead" => $contract->sc_lead
			);
		}

		echo json_encode($results);
	}

	public static function get_visa_name($visa_type) {

		$visa_row = Visatypes::find($visa_type);

		$visa_des  = "<a class='btn btn-info tooltip-inner btn-xs' data-toggle='tooltip' data-placement='bottom' title='Sub Class' href='#'>".$visa_row->subclass.'</a>';
		$visa_des .= " ";
		$visa_des .= "<a class='btn btn-info tooltip-inner btn-xs' data-toggle='tooltip' data-placement='bottom' title='Type' href='#'>".$visa_row->type.'</a>';
		$visa_des .= " ";
		$visa_des .= "<a class='btn btn-info tooltip-inner btn-xs' data-toggle='tooltip' data-placement='bottom' title='Group' href='#'>".$visa_row->group.'</a>';
		$visa_des .= " ";
		$visa_des .= "<a class='btn btn-info tooltip-inner btn-xs' data-toggle='tooltip' data-placement='bottom' title='Class' href='#'>".$visa_row->class.'</a>';
		$visa_des .= " ";
		$visa_des .= "<a class='btn btn-info tooltip-inner btn-xs' data-toggle='tooltip' data-placement='bottom' title='Title 1' href='#'>".$visa_row->title_1.'</a>';
		$visa_des .= " ";
		$visa_des .= "<a class='btn btn-info tooltip-inner btn-xs' data-toggle='tooltip' data-placement='bottom' title='Title 2' href='#'>".$visa_row->title_2.'</a>';

		return $visa_des;

	}

	/*
	 * This is ajax json request to get the people contracts list
	 */

	public function get_people_contracts($people_id) {

		$people_contracts = Contracts::where('people_id' , $people_id)->get();

		$results = array();

		foreach($people_contracts as $contract) {

			$results[] = array(
				"id" => $contract->id,
				"start_date" => date('d-m-Y', strtotime($contract->sc_date)),
				"status" => $this->service_contract_status('index' , $contract->sc_status)
			);

		}

		echo json_encode($results);
	}




}
