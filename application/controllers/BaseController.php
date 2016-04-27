<?php

use App\Models\Currencycodes;
use App\Models\Business_user;
use App\Models\People;
use App\Models\Faq;

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	public function  __construct() {

		$this->RANDOM_PASSWORD_LENGTH = 6;

	}

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function is_valid_user_action($action_business_id) {

		$business_user = Business_user::where('id' , $action_business_id)->first();

		if($business_user->id == Auth::user()->business_user_id) {

			return true;

		} else {

			return false;

		}
	}

	public function redirect_home_page() {

		return Redirect::to('people/home');
	}

	//get People prn

	public static function getPeopleRow($people_id) {

		return \DB::table('people')
			->where('id' , $people_id)
			->first();
	}

	//get People profile details

	public static function getPeopleProfileRow($people_id) {

		return \DB::table('people_profile')
			->where('people_id' , $people_id)
			->first();
	}


	//get all the country codes
	public  static function getAllcoutrycodes() {
		return \DB::table('country_codes')
			->get();
	}

	//get all the industry divisions
	public  static function getAllindustrydivisions() {
		return \DB::table('industry_divisions')
			->get();
	}

	//get single country code row
	public  static function getcoutrycode($id) {
		return \DB::table('country_codes')
			->where('id' , $id)
			->get();
	}

	//get single country code column name
	public  static function getcoutrycodename($id) {
		return \DB::table('country_codes')
			->where('id' , $id)
			->pluck('country');
	}

	public  static function getAllcurrencycodes() {
		return \DB::table('currency_codes')
			->get();
	}

	//get all the state province codes and names

	public static function  getAllstateprovince() {
		return \DB::table('state_provinces')
			->get();
	}

	//get single state province code row

	public static function  getstateprovince($id) {
		return \DB::table('state_provinces')
			->where('id', $id)
			->get();
	}

	//get single state province name
	public static function  getstateprovincename($id) {
		return \DB::table('state_provinces')
			->where('id', $id)
			->pluck('name');
	}

	public static function find_currency_code($id) {

		$currency_code = Currencycodes::find($id);

		return $currency_code;

	}

	//get all the country codes
	public  static function getAllhelptext() {
		return \DB::table('helptext')
			->get();
	}

	//get all the social listings
	public  static function getAllsociallist() {
		return \DB::table('people_social')
			->get();
	}

	//get all the docs prefixes
	public  static function getAllPrefixIds() {
		return \DB::table('docs_types')
			->orderBy("prefix")
			->get();
	}

	//get all the docs prefixes
	public  static function getAllBillingCodes() {
		return \DB::table('billing_codes')
			   ->get();
	}




	public static function find_corp_structure($id) {
		$return_arr = array(
			0 => 'Company',
			1 => 'Partnership',
			2 => 'Sole trader',
			3 => 'Trust'
		);

		return $return_arr[$id];
	}

	/**
	 * Function to create bread comes for people page
	 */

	public function bread_cums($controller,$action) {

		$output = '<ul class="page-breadcrumb">';

		$output .= '<li>
                            <i class="fa fa-home"></i>
                            <a href="'.URL::to('/').'/home">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>';

		$output .= '<li>
                            <a href="'.URL::to('/').'/'.$controller.'">'.ucwords($controller).'</a>
                            <i class="fa fa-angle-right"></i>
                        </li>';

		$output .= '<li>
                            '.ucwords($action).'
                        </li>';

		$output .= '</ul>';

		return $output;

	}

	public function search_principal($query) {

		$max = rand(5, 10);
		$results = array();

		for($i = 0; $i <= $max; $i++) {
			$results[] = array(
				"value" => $query . ' - ' . rand(10, 100),
				"desc" => "some description goes here...",
				"img" => "http://lorempixel.com/50/50/?" . (rand(1, 10000) . rand(1, 10000)),
				"tokens" => array($query, $query . rand(1, 10))
			);
		}

		echo json_encode($results);
	}

	public function sort_currency_codes($curency_codes) {

		$output = array();


		foreach($curency_codes as $code) {

			$output[$code->id] = $code->currency_code."-".$code->description;
		}

		return $output;

	}

	public function sort_country_codes($country_codes) {

		$output = array();

		$output[''] = 'SELECT';

		foreach($country_codes as $code) {

			$output[$code->id] = $code->country_code."-".$code->country;
		}

		return $output;

	}

	public function sort_industry_divisions($industry_divisions) {

		$output = array();

		$output[''] = 'SELECT';

		foreach($industry_divisions as $industry) {

			$output[$industry->id] = $industry->description;
		}

		return $output;

	}

	public function sort_state_provinces($state_provinces) {
		$output = array();

		foreach($state_provinces as $code) {

			$output[$code->id] = array($code->country_id,$code->code,$code->name,$code->cn_name);

		}

		return $output;
	}

	public function sort_people_groups($peoplegroups) {

		$output = array();

		foreach($peoplegroups as $group) {

			$output[$group->id] = $group->people_role;

		}

		return $output;
	}

	public function sort_people_titles($peopletitles) {

		$output = array();

		foreach($peopletitles as $title) {

			$output[$title->id] = $title->title_name;

		}

		return $output;
	}

	public function  sort_people_social_list($peoplesocaillist) {

		$output = array();

		foreach($peoplesocaillist as $list) {

			$output[$list->id] = $list->social_name;
		}

		return $output;


	}

	public function  sort_docs_prefix_ids($docs_prefixes) {

		$output = array();

		foreach($docs_prefixes as $list) {

			$output[$list->id] = $list->description.' - '.$list->comment;
		}

		return $output;

	}

	public function  sort_billing_codes($billing_codes) {

		$output = array();

		foreach($billing_codes as $code) {

			$output[$code->id] = $code->billing_code.' - '.$code->billing_name;
		}

		return $output;

	}

	public static function service_contract_status($section='',$status='') {
          $output = array (
		             1 => 'Prospective',
	 	             2 => 'Active',
		             3 => 'Suspended',
		             4 => 'Withdrawn',
		             5 => 'Completed',
		             6 => 'Cancelled'
	      );

		if($section =='index') {
			return $output[$status];
		} else {
			return $output;
		}
	}

	public static function is_active_options() {

		$output = array (
			0 => "Not Active",
			1 => "Active",
			2 => "Archive",
			3 => "Delete"
		);

		return $output;
	}

	//get the people role level, weather it is level 15 business admin or level 11 staff

	public static function get_user_level() {

		$user_role_level = People::find(Auth::user()->people_id)->getUserGroupRowAttribute()->person_category;

		if($user_role_level == 15) {

			return 1;

		} else if($user_role_level == 11) {

			return 0;

		}
	}

	//get the people role level, weather it is level 15 business admin or level 11 staff

	public static function get_user_level_id($people_id) {

		$user_role_level = People::find($people_id)->getUserGroupRowAttribute()->person_category;

		return $user_role_level;

	}

	//get the people eligable for creation of contracts
	/*
	 * People have a group of Prospect 1 or client 9 client(student) 10 or re;eative 16
	 * Those above group are eligable for creation of service contracts
	 */

	public static function get_valid_contract_people($people_id) {

		$user_role_level = People::find($people_id)->getUserGroupRowAttribute()->person_category;

		if($user_role_level == 1 || $user_role_level == 9 || $user_role_level == 10 || $user_role_level == 16) {

			return true;
		} else {

			return false;
		}

	}

	// get the faq icons

	public static function get_menu_icon($id) {

		$output = array(
			      'dashboard' => 'icon-home',
			      'people' => 'icon-users',
			      'contracts' => 'fa fa-tasks',
			      'billable' => 'fa fa-money',
			      'milestones' => 'fa fa-calendar',
			      'documents' => 'fa fa-file',
			      'business' => 'fa fa-building',
			      'visa types' => 'fa fa-plane',
			      'rates' => 'fa fa-question-circle',
			      'tasks' => 'fa fa-tasks',
			      'system settings' => 'icon-settings'
		);

		return $output[$id];

	}

	//get the help text based on the page name and form name

	public static function get_help_text($page_name,$form_name) {

		$help_text_count = Faq::where('page_name' , $page_name)->where('form_name' , $form_name)->count();

		if($help_text_count == 0 ) {

			return 0;

		} else {

			$help_text = Faq::where('page_name' , $page_name)->where('form_name' , $form_name)->first();
			return $help_text->text;
		}
	}

	//craeting a span lable for not applicable table items

	public static function na_label($type) {

		if($type == 'NA') {

			$output = '<span class="btn btn-info tooltip-inner btn-xs" data-toggle="tooltip" data-placement="bottom" title="Creating contract is not applicable to this user group."  href="#">

                                    NA

                                </span>';

		} else if($type == 'NF') {

			$output = '<span class="btn btn-info tooltip-inner btn-xs" data-toggle="tooltip" data-placement="bottom" title="There is no any records in the system"  href="#">

                                    NF

                                </span>';

		}



		return $output;

	}

	//below will get the list of document options

	public static function document_options() {

		$output = array (
			1 => "PRN",
			2 => "BRN",
			3 => "SCN"
		);

		return $output;
	}

	//below will get the list of business user status list

	public static function business_user_status_list() {

		$output = array(

			0 => "prospect",
			1 => "free subsciption",
			2 => "client"

		);

		return $output;

	}

	//get all visa type types

	public  static function getAllvisadistinctfields($field) {
		return \DB::table('visa_type')
			        ->select($field)
			        ->groupBy($field)
			        ->get();
	}

	public function sort_visa_types($visa_fields,$field) {

		$output = array();


		foreach($visa_fields as $visa) {

			$output[$visa->$field] = $visa->$field;
		}

		return $output;

	}

	public function create_random_password() {

		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($chars),0,$this->RANDOM_PASSWORD_LENGTH);

	}

	//function to get the active link
	public static function get_active_li($string) {

		$mystring = $_SERVER['REQUEST_URI'];
		$findme   = $string;
		$pos = strpos($mystring, $findme);

		if($pos !== false) {

			return 'active';

		} else {

			return '';
		}



	}
}
