<?php

use App\Models\Contracts;
use App\Models\Billable;
use App\Models\Service_contracts_extras_lables;
use App\Models\Billing_codes;
use App\Models\Faq;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function DashboardReport() {

		/*
		 * People rate is in people rate table
		 * join people rate with contract billable
		 */

		$bill_hours_with_rate = DB::table('service_contract_billable')
			                      ->join('service_contract', 'service_contract_billable.service_contract_id' , '=' , 'service_contract.id')
			                      ->join('business_user', 'service_contract.business_user_id' , '=' , 'business_user.id')
			                      ->join('current_hourly_rate','service_contract_billable.current_hourly_rate_id', '=' , 'current_hourly_rate.id')
			                      ->where('business_user.id' , '=', Auth::user()->business_user_id)
			                      ->select('service_contract_billable.service_contract_id',
									  'service_contract_billable.pre_charged_time_incremental',
									  'service_contract_billable.associated_C02',
									  'service_contract_billable.associated_C03',
									  'service_contract_billable.associated_C04',
									  'service_contract_billable.associated_C05',
									  'service_contract_billable.associated_C06',
									  'service_contract_billable.associated_C07',
									  'service_contract_billable.associated_C08',
									  'service_contract_billable.associated_C09',
									  'current_hourly_rate.current_rate','current_hourly_rate.id'
								  )
			                      ->orderby('service_contract_billable.service_contract_id')
			                      ->get();

		/*
		 * Group all the billable hours base as contract id
		 * create master array with SCN as key
		 */


		$contract_arr = array();

		foreach($bill_hours_with_rate as $billable) {
			if(isset($contract_arr[$billable->service_contract_id])) {
				$new_push_arr = array(
					'pre_charged_time_incremental' => $billable->pre_charged_time_incremental,
					'associated_C02' => $billable->associated_C02,
					'associated_C03' => $billable->associated_C03,
					'associated_C04' => $billable->associated_C04,
					'associated_C05' => $billable->associated_C05,
					'associated_C06' => $billable->associated_C06,
					'associated_C07' => $billable->associated_C07,
					'associated_C08' => $billable->associated_C08,
					'associated_C09' => $billable->associated_C09,
					'current_rate' => $billable->current_rate
				);
				array_push($contract_arr[$billable->service_contract_id],$new_push_arr);
			} else {
				$contract_arr[$billable->service_contract_id] [0] ['pre_charged_time_incremental'] = $billable->pre_charged_time_incremental;
				$contract_arr[$billable->service_contract_id] [0] ['associated_C02'] = $billable->associated_C02;
				$contract_arr[$billable->service_contract_id] [0] ['associated_C03'] = $billable->associated_C03;
				$contract_arr[$billable->service_contract_id] [0] ['associated_C04'] = $billable->associated_C04;
				$contract_arr[$billable->service_contract_id] [0] ['associated_C05'] = $billable->associated_C05;
				$contract_arr[$billable->service_contract_id] [0] ['associated_C06'] = $billable->associated_C06;
				$contract_arr[$billable->service_contract_id] [0] ['associated_C07'] = $billable->associated_C07;
				$contract_arr[$billable->service_contract_id] [0] ['associated_C08'] = $billable->associated_C08;
				$contract_arr[$billable->service_contract_id] [0] ['associated_C09'] = $billable->associated_C09;
				$contract_arr[$billable->service_contract_id] [0] ['current_rate'] = $billable->current_rate;
			}
		}

		/*
		 * Calculate all contract bill hours into final array
		 * with each scn as single row in output
		 */

		$output = array();
		foreach($contract_arr as $key => $value) {

			$single_arr = array(
				'scn' => $key,
				'scn_visa_price' => 0,
				'contract_hours' => 0,
				'contract_spend_amount' => 0,
				'contract_associated_C02' => 0,
				'contract_associated_C03' => 0,
				'contract_associated_C04' => 0,
				'contract_associated_C05' => 0,
				'contract_associated_C06' => 0,
				'contract_associated_C07' => 0,
				'contract_associated_C08' => 0,
				'contract_associated_C09' => 0,
				'contract_total_amount' => 0,
				'contract_profit' => 0,

				);

			foreach($contract_arr [$key] as $single) {
				$single_arr ['contract_hours'] = $single_arr ['contract_hours'] + $single ['pre_charged_time_incremental'];
				$single_arr ['contract_spend_amount'] = $single_arr ['contract_spend_amount'] + ($single ['pre_charged_time_incremental'] * $single ['current_rate']);
				$single_arr ['contract_associated_C02'] = $single_arr ['contract_associated_C02'] + $single ['associated_C02'];
				$single_arr ['contract_associated_C03'] = $single_arr ['contract_associated_C03'] + $single ['associated_C03'];
				$single_arr ['contract_associated_C04'] = $single_arr ['contract_associated_C04'] + $single ['associated_C04'];
				$single_arr ['contract_associated_C05'] = $single_arr ['contract_associated_C05'] + $single ['associated_C05'];
				$single_arr ['contract_associated_C06'] = $single_arr ['contract_associated_C06'] + $single ['associated_C06'];
				$single_arr ['contract_associated_C07'] = $single_arr ['contract_associated_C07'] + $single ['associated_C07'];
				$single_arr ['contract_associated_C08'] = $single_arr ['contract_associated_C08'] + $single ['associated_C08'];
				$single_arr ['contract_associated_C09'] = $single_arr ['contract_associated_C09'] + $single ['associated_C09'];
			}

			//get the visa price by using scn Key id

			$single_arr ['scn_visa_price'] = Contracts::find($key)->sc_visa_price;

			//get the visa type by using scn Key id

			$single_arr ['scn_row'] = Contracts::find($key);

			//update contract row with total amounts

			$single_arr ['contract_total_amount'] += $single_arr ['contract_spend_amount'];
			$single_arr ['contract_total_amount'] += $single_arr ['contract_associated_C02'];
			$single_arr ['contract_total_amount'] += $single_arr ['contract_associated_C03'];
			$single_arr ['contract_total_amount'] += $single_arr ['contract_associated_C04'];
			$single_arr ['contract_total_amount'] += $single_arr ['contract_associated_C05'];
			$single_arr ['contract_total_amount'] += $single_arr ['contract_associated_C06'];
			$single_arr ['contract_total_amount'] += $single_arr ['contract_associated_C07'];
			$single_arr ['contract_total_amount'] += $single_arr ['contract_associated_C08'];
			$single_arr ['contract_total_amount'] += $single_arr ['contract_associated_C09'];

			$single_arr ['contract_profit'] = $single_arr['scn_visa_price'] - $single_arr['contract_total_amount'];

			array_push($output,$single_arr);

		}

		$return_arr = array(
			"contracts_report" => $output,
			"breadcums" => $this->bread_cums("admin","home")
		);
		return View::make('pages.admin.dashboard.index')
			->with($return_arr);



	}
	
	public function ThemeSettings() {

		$user = User::find(Auth::user()->id);

		$user->theme_color = Input::get('theme_color');
		$user->theme_layout = Input::get('layoutOption');
		$user->sidebar_style = Input::get('sidebarStyleOption');
		$user->sidebar_position = Input::get('sidebarPosOption');
		$user->sidebar_menu = Input::get('sidebarMenuOption');

		$user->save();

	}

	public static function get_extra_lable_name($ac_id) {

		$ac_count = Service_contracts_extras_lables::where('business_user_id' , Auth::user()->business_user_id)->where("extras_id" , $ac_id)->count();

		if($ac_count == 0) {

			$output = array(
				           'count' => $ac_count,
				           'result_row' => Billing_codes::find($ac_id)
			           );
			return $output;

		} else {

			$ac = Service_contracts_extras_lables::where('business_user_id' , Auth::user()->business_user_id)->where("extras_id" , $ac_id)->first();

			$output = array(
				'count' => $ac_count,
				'result_row' => $ac
			);

			return $output;

		}
	}

	//get the faq from help text table

	public function faq() {

		$faqs = Faq::all();

		$output = array();


		foreach($faqs as $faq) {
		    if(isset($output [$faq->page_name])) {

				$new_push_arr = array(
					'form_name' => $faq->form_name,
					'title' => $faq->title,
					'text' => $faq->text
				);

				array_push($output [$faq->page_name] , $new_push_arr);

			} else {

				$output [$faq->page_name] [0] ['form_name'] = $faq->form_name;
				$output [$faq->page_name] [0] ['title'] = $faq->title;
				$output [$faq->page_name] [0] ['text'] = $faq->text;

			}
		}

		$return_arr = array(
			"faqs" => $output,
			"breadcums" => $this->bread_cums("faq","View")
		);
		return View::make('pages.faq.index')
			->with($return_arr);

	}


}
