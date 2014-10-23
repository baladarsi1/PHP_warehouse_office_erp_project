<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package  	CodeIgniter
 * @author  	Romaldy Minaya
 * @copyright 	Copyright (c) 2011, PROTOS.
 * @license  	GLP
 * @since  		Version 1.0
 * @version  	1.4
 */

// ------------------------------------------------------------------------

/**
 * File Uploading Extender
 *
 * @package  	CodeIgniter
 * @subpackage 	Libraries
 * @category 	Uploads
 * @author  	Romaldy Minaya
 *

// ------------------------------------------------------------------------

Documentation

This class lets you make the upload process even easier by extending the 
CI_Upload class and adding some funtionality named below:

*1)Upload multiple files in just one shot.
*2)Creates the path where you want the files to be saved automatically.
*3)Creates and index.php file in each folder by passing TRUE to the up() function.
*4)Modify the same preferences that you used to with the original upload class, here is
the link of the documentation http://codeigniter.com/user_guide/libraries/file_uploading.html.

Implementation

*1)Copy this code in the view_file

 <form method="POST" action="" enctype="multipart/form-data">
  <input type="file" name="file_1" size="20" /> 
  <input type="file" name="file_2" size="20" />
  <input type="file" name="file_3" size="20" />
  <input type="submit" name="test" value="TEST" />
  </form>

*2)In your controller file copy the code below

 $this->load->library('upload');

 $config['upload_path']   = './uploads'; //if the files does not exist it'll be created
 $config['allowed_types'] = 'gif|jpg|png|xls|xlsx|php|pdf';
 $config['max_size']   = '4000'; //size in kilobytes
 $config['encrypt_name']  = TRUE;

 $this->upload->initialize($config);

 $uploaded = $this->upload->up(TRUE); //Pass true if you want to create the index.php files
 
 var_dump($uploaded); //prints the result of the operation and analize the data

 */
 
class MY_Upload extends CI_Upload{

    public function __construct(){
	
        parent::__construct();
    }
 
	/**
	* @return void
	* @param void
	* @desc This functions starts the upload process
	*/ 
	public function up($protect = FALSE){

		$uploaded_info	= FALSE;
		$multi_files 	= Array();
		$uni_files 		= Array();

		if($this->upload_path[strlen($this->upload_path)-1] != '/')
			$this->upload_path .= '/';

		#Now we flattern the $_FILES variable from multidimensional array to bidimensional array.
		#	Added 6/9/2012
		//------------------------------------------------------------------------------------------
		foreach($_FILES as $index => $file){
			if(is_array($file['tmp_name'])){
				$temp_file_array = array_map(	
					NULL,$file['name'],$file['type'],$file['tmp_name'],$file['error'],$file['size']
				);
				foreach($temp_file_array as $index2 => $temp_file_array_2){
					$temp_file_array[$index2][] = $index;
				}
				$multi_files += $temp_file_array;
			}else{
				#Here we add the file_input attribute to the array 
				#wich contains the name of the input's file
				$file['file_input'] = $index;
				$uni_files[] = $file;
			}
		}

		#Finalizing the conversion proccess
		$temp_file_array = Array();

		foreach($multi_files as $file){
			$temp_file_array[] = Array( 'name' 		=> $file[0],
										'type' 		=> $file[1],
										'tmp_name' 	=> $file[2],
										'error' 	=> $file[3],
										'size' 		=> $file[4],
										'file_input'=> $file[5]);
		}
		
		#After flattening the array we pass everything to the $_FILES Array
		$_FILES = array_merge($temp_file_array,$uni_files);
		unset($multi_files,$uni_files,$temp_file_array); //Then we clean the memory
		//------------------------------------------------------------------------------------------
		if(isset($_FILES)){
			#Here we check if the path exists if not then create
			if(!file_exists($this->upload_path)){
				@mkdir($this->upload_path,755,TRUE);
			}

			#Here we create the index file in each path's directory
			if($protect){
				$folder = '';
				foreach(explode('/',$this->upload_path)  as $f){
					$folder .= $f.'/';
					$text = "<?php echo 'Directory access is forbidden.'; ?>";

					if(!file_exists($folder.'index.php')){
						$index = $folder.'index.php'; 
						$Handle = fopen($index, 'w');
						fwrite($Handle, trim($text));
						fclose($Handle); 
					}
				}   
			}

			#Here we do the upload process
			foreach($_FILES as $file => $value){
				
				if( $value['size'] > 0 ){
					if (!$this->do_upload($file)){
						$uploaded_info['error'][]  =  	array_merge($this->data(),
															Array(	'error_msg'	=> $this->display_errors(),
																	'file_input'=> $value['file_input']
															)
														);
						$this->error_msg = Array();
					}
					else{
						$uploaded_info['success'][] =  	array_merge($this->data(),
															Array(	'error_msg' => $this->display_errors(),
																	'file_input' => $value['file_input']
															)
														);
						$this->error_msg = Array();
					}
				}
			}  
		}

		#Then return what happened with the files
		return $uploaded_info;
	}
}

/* End of file MY_Upload.php */