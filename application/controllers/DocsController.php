<?php

use App\Models\Docs;
use App\Models\People;
use App\Models\Businesses;
use App\Models\Contracts;

class DocsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$docs = Docs::where('business_user_id' , Auth::user()->business_user_id)->get();
		$return_arr = array(
			"docs" => $docs,
			"breadcums" => $this->bread_cums("docs","index")
		);
		return View::make('pages.docs.index')
			->with($return_arr);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($ref_id=1,$ref_value=0)
	{
		if($ref_value == 0) {
			$ref_val = null;
		} else {
			$ref_val = $ref_value;
		}
		$return_arr = array(
			"ajax"      => 0,
			"ref_id"    => $ref_id,
			"ref_val"   => $ref_val,
			"breadcums" => $this->bread_cums("docs","create"),
			"help_text" => $this->getAllhelptext(),
			"file_prefix_ids" => $this->sort_docs_prefix_ids($this->getAllPrefixIds())
		);
		return View::make('pages.docs.create', $return_arr);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

	public function postUpload(){

        $docs_folder = date('M-Y');

		$titles = $_REQUEST['title'];

		$files = Input::file('files');

		$json = array(
			'files' => array()
		);

		$count = 0;
		foreach( $files as $file ):

			if(Input::get('ref_id') == 1) {

				if(People::where('prn', Input::get('ref_people_val'))->count() == 0) {
					$json['files'][] = array(
						'error' => 'The PRN is not a valid PRN.',
					);

					return Response::json($json);
				}

			} else if(Input::get('ref_id') == 2) {

				if(Businesses::where('id', Input::get('ref_business_val'))->count() == 0) {
					$json['files'][] = array(
						'error' => 'The BRN is not a valid BRN.',
					);

					return Response::json($json);
				}

			} else if(Input::get('ref_id') == 3) {

				if(Contracts::where('id', Input::get('ref_contract_val'))->count() == 0) {
					$json['files'][] = array(
						'error' => 'The SCN is not a valid SCN.',
					);

					return Response::json($json);
				}

			}

			$filename = $file->getClientOriginalName().".".$file->getClientOriginalExtension();

			$unique_name = md5($filename. time());

			$json['files'][] = array(
				'name' => $titles [$count],
				'size' => $file->getSize(),
				'type' => $file->getMimeType(),
				'title' => $titles [$count],
				'url' => url('/').'/public/uploads/files/'.$docs_folder.'/'.$unique_name.'.'.$file->getClientOriginalExtension(),
				'deleteType' => 'DELETE',
				'deleteUrl' => '/deleteFile/'.$filename
			);

			$upload = $file->move( public_path().'/uploads/files/'.$docs_folder.'', $unique_name.'.'.$file->getClientOriginalExtension() );

		    $new_doc = new Docs;


			$new_doc->file_prefix_id = Input::get('file_prefix_id');
			$new_doc->business_user_id = Auth::user()->business_user_id;
			$new_doc->ref_id = Input::get('ref_id');

			if(Input::get('ref_id') == 1) {

				$new_doc->ref_val = Input::get('ref_people_val');

			} else if(Input::get('ref_id') == 2) {

				$new_doc->ref_val = Input::get('ref_business_val');

			} else if(Input::get('ref_id') == 3) {

				$new_doc->ref_val = Input::get('ref_contract_val');

			}


			$new_doc->name = $titles [$count];
			$new_doc->file_name = $unique_name;
			$new_doc->file_ext = $file->getClientOriginalExtension();
			$new_doc->path = $docs_folder;
			$new_doc->save();

			$count = $count + 1;
		endforeach;

		return Response::json($json);

	}

	//get the people documents
	function get_people_documents($prn) {


		$people_docs = Docs::where('ref_id' , 1)->where('ref_val' , $prn)->get();

		$results = array();

		foreach($people_docs as $doc) {

			$results[] = array(
				"id" => $doc->id,
				"name" => $doc->name,
				"prefix" => $doc->doc_prefix,
				"download" => URL::to('/')."/public/uploads/files/".$doc->path."/".$doc->file_name.".".$doc->file_ext
			);

		}

		echo json_encode($results);

	}

	//check the people prn existed
	public function check_prn_exist($prn) {

		$prn_count = People::where('prn', $prn)->count();
		return $prn_count;

	}

	//check the brn existed
	public function check_brn_exist($brn) {

		$brn_count = Businesses::find($brn)->count();

	}


}
