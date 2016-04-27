<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 3/08/2015
 * Time: 3:34 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Businesses extends Eloquent {

    protected $table = 'businesses';
    public $timestamps = false;

    protected $appends = ['business_type'];

    //get the user profile row refer to the user

    public function getBusinessTypeAttribute()
    {

        $user_business_type_count = \DB::table('industry_divisions')
            ->where('id', $this->bus_type)
            ->count();

        if ($user_business_type_count == 0) {

            return "";

        } else {

            $user_business_type_row = \DB::table('industry_divisions')
                ->where('id', $this->bus_type)
                ->first();

            return $user_business_type_row->description;

        }
    }


}