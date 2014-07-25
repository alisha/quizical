<?php

class UserController extends BaseController {

	public function getNew() {
		return View::make('createUser');
	}

	public function postNew() {
		$school = School::where('passcode', '=', Input::get('passcode'))->firstOrFail();
		$user = new User;
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->school_id = $school->id;
		$user->save();
		return Redirect::to('/')->with('flash_message', 'Your account has been successfully created.');
	}

}