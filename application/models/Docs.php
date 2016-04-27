<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 3/08/2015
 * Time: 3:34 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Docs extends Eloquent {

    protected $table = 'service_contract_docs';
    public $timestamps = true;

    protected $appends = ['doc_prefix'];

    public function getDocPrefixAttribute() {

        $doc_prefix = \DB::table('docs_types')
            ->where('prefix' , $this->file_prefix_id)
            ->first();

        return $doc_prefix->description;
    }

}