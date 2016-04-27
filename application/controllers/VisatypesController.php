<?php

use App\Models\Visatypes;
use App\Models\Visa_price;

class VisatypesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$visatypes = Visatypes::orderBy('type', 'ASC')->orderBy('group', 'ASC')->get();
		$return_arr = array(
			"visatypes" => $visatypes,
			"breadcums" => $this->bread_cums("visa types","index")
		);
		return View::make('pages.visatypes.index')
			->with($return_arr);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($ajax = 0)
	{

		$return_arr = array(
			"ajax" => $ajax,
			"visa_types" => $this->sort_visa_types($this->getAllvisadistinctfields('type'), 'type'),
			"visa_groups" => $this->sort_visa_types($this->getAllvisadistinctfields('group'), 'group'),
			"visa_class" => $this->sort_visa_types($this->getAllvisadistinctfields('class'), 'class'),
			"breadcums" => $this->bread_cums("visa types","create"),
		);
		return View::make('pages.visatypes.create', $return_arr);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$new_visatype = new Visatypes;
		$new_visatype = $this->visatype_input($new_visatype);
		$new_visatype->save();

		return Redirect::to('visatypes');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$single_visatype = Visatypes::find($id);

		$return_arr = array(
			"ajax_load" => 0,
			"breadcums" => $this->bread_cums("visa types","create"),
			"single_visatype" => $single_visatype
		);
		return View::make('pages.visatypes.show', $return_arr);
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
		$single_visatype = Visatypes::find($id);

		// show the edit form and pass the nerd

		$return_arr = array(
			"ajax_load" => 0,
			"breadcums" => $this->bread_cums("visa types","edit"),
			"single_visatype" => $single_visatype
		);

		return View::make('pages.visatypes.edit', $return_arr);
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
		 * Check the visa price is already set or not
		 * If visa price is not set update the input price
		 */

		$visa_price_count = Visa_price::where("business_user_id" , Auth::user()->business_user_id)->where('visa_id' , $id)->count();

		if($visa_price_count == 0) {

			$business_user_visa_price = new Visa_price;

		} else {

			$business_user_visa_price = Visa_price::where("business_user_id" , Auth::user()->business_user_id)->where('visa_id' , $id)->first();

		}

		$business_user_visa_price->business_user_id = Auth::user()->business_user_id;
		$business_user_visa_price->visa_id = $id;
		$business_user_visa_price->price = Input::get('price');

		$business_user_visa_price->save();

		return Redirect::to('visatypes');
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

	public function search_visa($proc,$type='',$group='',$class='',$title_1='',$subclass='',$title_2='') {

		if($proc == "type") {

			$find_visa_type = Visatypes::distinct()->select('type')->get();

			$output = array();

			foreach($find_visa_type as $type) {
				array_push($output,$type->type);
			}

		} else if($proc == "group") {

			$find_visa_type = Visatypes::distinct()->select('group')
				              ->where('type',$type)
				              ->get();

			$output = array();

			foreach($find_visa_type as $group) {
				array_push($output,$group->group);
			}

		} else if($proc == "class") {

			$find_visa_type = Visatypes::distinct()->select('class')
				->where('type',$type)
				->where('group',$group)
				->get();

			$output = array();

			foreach($find_visa_type as $class) {
				array_push($output,$class->class);
			}

		} else if($proc == "title_1") {

			$find_visa_type = Visatypes::distinct()->select('title_1')
				->where('type',$type)
				->where('group',$group)
				->where('class',$class)
				->get();

			$output = array();

			foreach($find_visa_type as $title_1) {
				array_push($output,$title_1->title_1);
			}

		} else if($proc == "subclass") {

			$find_visa_type = Visatypes::distinct()->select('subclass')
				->where('type',$type)
				->where('group',$group)
				->where('class',$class)
				->where('title_1',$title_1)
				->get();

			$output = array();

			foreach($find_visa_type as $subclass) {
				array_push($output,$subclass->subclass);
			}

		} else if($proc == "title_2") {

			$find_visa_type = Visatypes::distinct()->select('title_2')
				->where('type',$type)
				->where('group',$group)
				->where('class',$class)
				->where('title_1',$title_1)
				->where('subclass',$subclass)
				->get();

			$output = array();

			foreach($find_visa_type as $title_2) {
				array_push($output,$title_2->title_2);
			}

		}

		return json_encode($output);

	}

	public function get_visa_id() {

		$visa_search_type =  Input::get('visa_search_type');
		$visa_search_group =  Input::get('visa_search_group');
		$visa_search_class = Input::get('visa_search_class');
		$visa_search_title_1 = Input::get('visa_search_title_1');
		$visa_search_subclass = Input::get('visa_search_subclass');
		$visa_search_title_2 = Input::get('visa_search_title_2');

        $find_visa_id = Visatypes::select('id','price')
			->where('type' , $visa_search_type)
			->where('group', $visa_search_group)
			->where('class', $visa_search_class)
			->where('title_1' , $visa_search_title_1)
			->where('subclass', $visa_search_subclass)
			->where('title_2', $visa_search_title_2)
			->get();

		if(count($find_visa_id) == 0) {
			return 0;
		} else {

			$visa_business_user_price_count = Visa_price::where("business_user_id" , Auth::user()->business_user_id)->where('visa_id' , $find_visa_id [0]->id)->count();

			if($visa_business_user_price_count == 0) {

				return json_encode(
					array(
						'error' => 1,
						'visa_id' => $find_visa_id [0]->id,
					)
				);


			} else {

				return json_encode(
					array(
						'error' => 0,
						'visa_id' => $find_visa_id [0]->id,
						'visa_price' => $find_visa_id [0]->price
					)
				);


			}

		}

	}

	public function visatype_input($new_visatype) {

		$new_visatype->type = Input::get('type');
		$new_visatype->group = Input::get('group');
		$new_visatype->class = Input::get('class');
		$new_visatype->title_1 = Input::get('title_1');
		$new_visatype->subclass = Input::get('subclass');
		$new_visatype->title_2 = Input::get('title_2');
		$new_visatype->price = Input::get('price');


		return $new_visatype;
	}



	public function visa_subclass($id) {

		return Visatypes::find($id);
	}

	//get the business user visa price

	public static function get_visa_price($visa_id) {

        $visa_price_count = Visa_price::where("business_user_id" , Auth::user()->business_user_id)->where('visa_id' , $visa_id)->count();

		if($visa_price_count == 0) {

			return "";

		} else {

			return Visa_price::where("business_user_id" , Auth::user()->business_user_id)->where('visa_id' , $visa_id)->first()->price;

		}


	}




}
