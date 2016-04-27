<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $appends = ['user_group','status','name_given1_en', 'name_family_en'];

	//Get the user group always refer to the user


	public function getUserGroupAttribute() {

		$user_group = \DB::table('people_category_holdings')
				->where('people_id' , $this->people_id)
				->first();

		$group = \DB::table('people_category')
				->where('id' , $user_group->person_category)
				->first();

		return $group->people_role;

	}

	public function getStatusAttribute() {

		if($this->is_active == 1) {
			return "Active";
		} else {
			return "Not Active";
		}

	}

	//Get the business admin given name
	public function getNameGiven1EnAttribute() {

		$user_profile_count = \DB::table('people_profile')
			->join('people' , 'people_profile.people_id', '=', 'people.id')
			->where('people.id' , $this->people_id)
			->select('people_profile.name_given1_en')
			->count();

		if($user_profile_count == 0) {

			return "";

		} else {

			$user_profile = \DB::table('people_profile')
				->join('people' , 'people_profile.people_id', '=', 'people.id')
				->where('people.id' , $this->people_id)
				->select('people_profile.name_given1_en')
				->first();

			return $user_profile->name_given1_en;

		}

	}

	//Get the business admin family name
	public function getNameFamilyEnAttribute() {

		$user_profile_count = \DB::table('people_profile')
			->join('people' , 'people_profile.people_id', '=', 'people.id')
			->where('people.id' , $this->people_id)
			->select('people_profile.name_family_en')
			->count();

		if($user_profile_count == 0) {

			return "";

		} else {

			$user_profile = \DB::table('people_profile')
				->join('people' , 'people_profile.people_id', '=', 'people.id')
				->where('people.id' , $this->people_id)
				->select('people_profile.name_family_en')
				->first();

			return $user_profile->name_family_en;

		}

	}



}
