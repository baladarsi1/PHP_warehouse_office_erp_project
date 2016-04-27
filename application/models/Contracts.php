<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 3/08/2015
 * Time: 3:34 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Contracts extends Eloquent {

    protected $table = 'service_contract';
    public $timestamps = true;

    protected $appends = ['contract_status', 'contract_visa_subclass' , 'contract_principle_prn' , 'contract_lead_name' ];

    public function getContractStatusAttribute() {

        return \BaseController::service_contract_status('index',$this->sc_status);
    }

    public function getContractVisaSubclassAttribute() {
        $visa_subclass = \DB::table('visa_type')
            ->where('id' , $this->visa_type)
            ->first();

        return $visa_subclass->subclass;
    }

    public function getContractPrinciplePrnAttribute() {

        return \BaseController::getPeopleRow($this->people_id)->prn;
    }

    public function getContractLeadNameAttribute() {
        return \BaseController::getPeopleProfileRow($this->people_id)->name_given1_en;
    }

}