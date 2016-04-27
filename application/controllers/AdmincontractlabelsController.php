<?php

use App\Models\Service_contracts_extras_lables;
use App\Models\Billing_codes;


class AdmincontractlabelsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$billing_codes = Billing_codes::all();
		$business_user_service_labels = Service_contracts_extras_lables::where('business_user_id' , Auth::user()->business_user_id)->get();
		$return_arr = array(
			"business_user_service_labels" => $business_user_service_labels,
			'billing_codes' => $billing_codes,
			"breadcums" => $this->bread_cums("service contract labels","index")
		);
		return View::make('pages.admin.service_contract_labels.index')
			->with($return_arr);
	}


	public function edit($billing_id)
	{
		// get the nerd
		$billing_code = Billing_codes::find($billing_id);

		// show the edit form and pass the nerd

		$return_arr = array(
			"ajax_load" => 0,
			"breadcums" => $this->bread_cums("service contract labels","edit"),
			"billing_code" => $billing_code
		);

		return View::make('pages.admin.service_contract_labels.edit', $return_arr);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		/*
		 * Check the extra title is already set or not
		 * If extra title  is not set update or add new extra title
		 */

		$contract_label_count = Service_contracts_extras_lables::where("business_user_id" , Auth::user()->business_user_id)->where('extras_id' , $id)->count();

		if($contract_label_count == 0) {

			$contract_label = new Service_contracts_extras_lables;

		} else {

			$contract_label = Service_contracts_extras_lables::where("business_user_id" , Auth::user()->business_user_id)->where('extras_id' , $id)->first();

		}

		$contract_label->business_user_id = Auth::user()->business_user_id;
		$contract_label->extras_id = $id;
		$contract_label->extras_title = Input::get('extras_title');

		$contract_label->save();

		return Redirect::to('admin/service_contract_labels');
	}

}
