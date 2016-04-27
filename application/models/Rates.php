<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 3/08/2015
 * Time: 3:34 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Rates extends Eloquent {

    protected $table = 'current_hourly_rate';
    public $timestamps = true;

}