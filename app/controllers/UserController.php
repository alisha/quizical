<?php

class UserController extends BaseController {

	//Validation rules
	public static $rules = array(
		'first_name' => 'required',
		'last_name' => 'required',
		'email' => 'required|email|unique:users,email',
		'password' => 'required',
		'schoolID' => 'required',
		'passcode' => 'required'
	);

	public function getCreate() {
		return View::make('createUser');
	}

	public function postCreate() {
		//Validation
		$school = School::where('passcode', '=', Input::get('passcode'))->where('id', '=', Input::get('schoolID'))->first();
		$validator = Validator::make(Input::all(), self::$rules);

		if (!isset($school)) {
			return Redirect::to('/users/create')
				->with('flash_message', 'We couldn\'t find your school. Try again?')
				->with('alert_class', 'alert-danger')
				->withInput();
		} else if ($validator->fails()) {
			return Redirect::to('/users/create')
				->withInput()
				->withErrors($validator);
		}

		$user = new User;
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->school_id = $school->id;
		$user->save();
		return Redirect::to('/login')->with('flash_message', 'Your account has been successfully created.')->with('alert_class', 'alert-success');
	}

}