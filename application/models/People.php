<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 3/08/2015
 * Time: 3:34 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class People extends Eloquent {

    protected $table = 'people';
    public $timestamps = true;

    protected $appends = ['user_group_row', 'user_group','scn_list','brn_list','people_docs' , 'user_profile'];


    //Get the user group always refer to the user

    public function getUserGroupAttribute() {

        $user_group = \DB::table('people_category_holdings')
                      ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
                      ->where('people_category_holdings.people_id' , $this->id)
                      ->select('people_category.people_role')
                      ->first();

        return $user_group->people_role;

    }

    //get the user group row refer to the user

    public function getUserGroupRowAttribute() {

        $user_group = \DB::table('people_category_holdings')
            ->join('people_category' , 'people_category_holdings.person_category', '=', 'people_category.id')
            ->where('people_category_holdings.people_id' , $this->id)
            ->select('people_category_holdings.people_id','people_category_holdings.person_category','people_category.people_role')
            ->first();

        return $user_group;

    }

    //get the user profile row refer to the user

    public function getUserProfileAttribute() {

        $user_profile_count = \DB::table('people_profile')
            ->where('people_id' , $this->id)
            ->count();

        if($user_profile_count == 0) {

            $user_profile = new People();

        } else {

            $user_profile = \DB::table('people_profile')
                ->where('people_id' , $this->id)
                ->first();

        }

        return $user_profile;



    }

    public function getScnListAttribute() {

        $user_scn_list = \DB::table('service_contract')
            ->where('people_id' , $this->id)
            ->get();

        return $user_scn_list;
    }


    public function getBrnListAttribute() {

        $return_array = array();
        $user_brn_list_count = \DB::table('people_business')
            ->where('people_id' , $this->id)
            ->count();

        if($user_brn_list_count == 0) {

            $return_array['count'] = $user_brn_list_count;

        } else {
            $user_brn_list = \DB::table('people_business')
                ->where('people_id' , $this->id)
                ->first();

            $user_brn = \DB::table('businesses')
                ->where('id' , $user_brn_list->business_id)
                ->get();

            $return_array['count'] = $user_brn_list_count;
            $return_array['data'] = $user_brn;
        }

        return $return_array;
    }

    public function getPeopleDocsAttribute() {

        $user_docs_list = \DB::table('service_contract_docs')
            ->where('people_id' , $this->id)
            ->get();

        return $user_docs_list;

    }

    public static function getAllpeople() {
        return \DB::table('people')
            ->join('people_category_holdings', 'people.id', '=', 'people_category_holdings.people_id')
            ->join('people_category', 'people_category_holdings.person_category', '=', 'people_category.id')
            ->select('people.id','people.prn','people.title','people.name_family_en','people.name_given1_en','people.name_given2_en','people_category.people_role' )
            ->orderBy('people.id', 'desc')
            ->where('people.status','=',1)
            ->where('people_category_holdings.person_category','=',9)
            ->get();
    }

    public  static function getAllpeoplegroups() {
          return \DB::table('people_category')
              ->orderby('order_index')
              ->get();
    }

    public  static function getAllpeoplerelationships() {
        return \DB::table('people_relationship')
            ->get();
    }

    public  static function getAllpeopletitles() {
        return \DB::table('people_title')
            ->get();
    }

    public static function getPrntree($prn) {
        return \DB::table('people')
            ->join('people_relationship', 'people.prn_suffix', '=', 'people_relationship.id')
            ->select('people.id','people.prn','people.title','people.name_family_en','people.name_given1_en','people.name_given2_en','people_relationship.relation_name' )
            ->where('people.prn','=',$prn)
            ->get();
    }

    public function scnDataList() {
        return $this->hasMany('App\Models\Contracts' , 'people_id' , 'id');
    }

    public function brnDataList() {
        return $this->hasMany('App\Models\Peoplebusiness' , 'people_id' , 'id');
    }



}