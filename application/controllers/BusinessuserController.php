<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 14/04/2016
 * Time: 11:06 AM
 */

use App\Models\Business_user;
use App\Models\Subscription_rates;
use App\Models\Subscription_types;
use App\Models\Subscription_sales;

class BusinessuserController extends \BaseController {

    public function business_user_profile() {

        $business_user_id = Auth::user()->business_user_id;

        $business_user_row = Business_user::find($business_user_id);

        $return_arr = array(
                          "business_user_row" => $business_user_row,
                          "breadcums" => $this->bread_cums("business profile","profile"),
                          "business_current_subscription" => Subscription_sales::find($business_user_row->subscription_current_id),
                          "business_subscriptions" => Subscription_sales::where('business_user_id' , $business_user_id)->get()
                     );

        return View::make('pages.admin.business_user.index')->with($return_arr);

    }

    public static function business_user_signature() {

        $business_user_id = Auth::user()->business_user_id;

        $business_user_row = Business_user::find($business_user_id);

        if(file_exists(public_path('images/business_user/'.$business_user_row->id.'/logo.png'))) {

            $signature_output = "<img src='".url("/")."/public/images/business_user/".$business_user_row->id."/logo.png' />";

        } else {

            $signature_output = "";

        }

        $signature_output .= "<h5>".$business_user_row->business_name."</h5>";

        $signature_output .= "<p>".$business_user_row->address_1." , ".$business_user_row->address_2."</p>";

        $signature_output .= "<p>".$business_user_row->suburb." , ".$business_user_row->state."</p>";

        $signature_output .= "MARN NO : <b>".$business_user_row->marn."</b>";

        return $signature_output;

    }

    public static function subscription_name($subscription_id) {

          return Subscription_types::find($subscription_id)->name;

    }

}