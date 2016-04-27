<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 3/08/2015
 * Time: 3:34 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Business_user extends Eloquent {

    protected $table = 'business_user';
    public $timestamps = false;

    protected $appends = ['name_given1_en', 'name_family_en','tel_1_number','mobile_1_number','email','admin_people_id'];

    //Get the business admin given name
    public function getNameGiven1EnAttribute() {

        $user_profile_count = \DB::table('people_profile')
                       ->join('people' , 'people_profile.people_id', '=', 'people.id')
                       ->join('people_category_holdings' , 'people_profile.people_id', '=', 'people_category_holdings.people_id')
                       ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
                       ->where('people.business_user_id' , $this->id)
                       ->where('people_category_holdings.person_category' , 15)
                       ->select('people_profile.name_given1_en')
                       ->count();

        if($user_profile_count == 0) {

            return "";

        } else {

            $user_profile = \DB::table('people_profile')
                ->join('people' , 'people_profile.people_id', '=', 'people.id')
                ->join('people_category_holdings' , 'people_profile.people_id', '=', 'people_category_holdings.people_id')
                ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
                ->where('people.business_user_id' , $this->id)
                ->where('people_category_holdings.person_category' , 15)
                ->select('people_profile.name_given1_en')
                ->first();

            return $user_profile->name_given1_en;

        }

    }

    //Get the business admin family name
    public function getNameFamilyEnAttribute() {

        $user_profile_count = \DB::table('people_profile')
            ->join('people' , 'people_profile.people_id', '=', 'people.id')
            ->join('people_category_holdings' , 'people_profile.people_id', '=', 'people_category_holdings.people_id')
            ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
            ->where('people.business_user_id' , $this->id)
            ->where('people_category_holdings.person_category' , 15)
            ->select('people_profile.name_family_en')
            ->count();

        if($user_profile_count == 0) {

            return "";

        } else {

            $user_profile = \DB::table('people_profile')
                ->join('people' , 'people_profile.people_id', '=', 'people.id')
                ->join('people_category_holdings' , 'people_profile.people_id', '=', 'people_category_holdings.people_id')
                ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
                ->where('people.business_user_id' , $this->id)
                ->where('people_category_holdings.person_category' , 15)
                ->select('people_profile.name_family_en')
                ->first();

            return $user_profile->name_family_en;

        }

    }

    //Get the business admin phone number
    public function getTell1NumberAttribute() {

        $user_profile_count = \DB::table('people_profile')
            ->join('people' , 'people_profile.people_id', '=', 'people.id')
            ->join('people_category_holdings' , 'people_profile.people_id', '=', 'people_category_holdings.people_id')
            ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
            ->where('people.business_user_id' , $this->id)
            ->where('people_category_holdings.person_category' , 15)
            ->select('people_profile.tel_1_number')
            ->count();

        if($user_profile_count == 0) {

            return "";

        } else {

            $user_profile = \DB::table('people_profile')
                ->join('people' , 'people_profile.people_id', '=', 'people.id')
                ->join('people_category_holdings' , 'people_profile.people_id', '=', 'people_category_holdings.people_id')
                ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
                ->where('people.business_user_id' , $this->id)
                ->where('people_category_holdings.person_category' , 15)
                ->select('people_profile.tel_1_number')
                ->first();

            return $user_profile->tel_1_number;

        }

    }

    //Get the business admin phone number
    public function getMobile1NumberAttribute() {

        $user_profile_count = \DB::table('people_profile')
            ->join('people' , 'people_profile.people_id', '=', 'people.id')
            ->join('people_category_holdings' , 'people_profile.people_id', '=', 'people_category_holdings.people_id')
            ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
            ->where('people.business_user_id' , $this->id)
            ->where('people_category_holdings.person_category' , 15)
            ->select('people_profile.mobile_1_number')
            ->count();

        if($user_profile_count == 0) {

            return "";

        } else {

            $user_profile = \DB::table('people_profile')
                ->join('people' , 'people_profile.people_id', '=', 'people.id')
                ->join('people_category_holdings' , 'people_profile.people_id', '=', 'people_category_holdings.people_id')
                ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
                ->where('people.business_user_id' , $this->id)
                ->where('people_category_holdings.person_category' , 15)
                ->select('people_profile.mobile_1_number')
                ->first();

            return $user_profile->mobile_1_number;

        }

    }

    //Get the business admin mobile
    public function getEmailAttribute() {

        $user_profile_count = \DB::table('users')
            ->join('people' , 'users.people_id', '=', 'people.id')
            ->join('people_category_holdings' , 'users.people_id', '=', 'people_category_holdings.people_id')
            ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
            ->where('people.business_user_id' , $this->id)
            ->where('people_category_holdings.person_category' , 15)
            ->select('users.email')
            ->count();

        if($user_profile_count == 0) {

            return "";

        } else {

            $user_profile = \DB::table('users')
                ->join('people' , 'users.people_id', '=', 'people.id')
                ->join('people_category_holdings' , 'users.people_id', '=', 'people_category_holdings.people_id')
                ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
                ->where('people.business_user_id' , $this->id)
                ->where('people_category_holdings.person_category' , 15)
                ->select('users.email')
                ->first();

            return $user_profile->email;

        }

    }

    //Get the business admin admin people id
    public function getAdminPeopleIdAttribute() {

        $user_profile_count = \DB::table('users')
            ->join('people' , 'users.people_id', '=', 'people.id')
            ->join('people_category_holdings' , 'users.people_id', '=', 'people_category_holdings.people_id')
            ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
            ->where('people.business_user_id' , $this->id)
            ->where('people_category_holdings.person_category' , 15)
            ->select('users.people_id')
            ->count();

        if($user_profile_count == 0) {

            return "";

        } else {

            $user_profile = \DB::table('users')
                ->join('people' , 'users.people_id', '=', 'people.id')
                ->join('people_category_holdings' , 'users.people_id', '=', 'people_category_holdings.people_id')
                ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
                ->where('people.business_user_id' , $this->id)
                ->where('people_category_holdings.person_category' , 15)
                ->select('users.people_id')
                ->first();

            return $user_profile->people_id;

        }

    }

}

