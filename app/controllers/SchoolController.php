<?php

class SchoolController extends BaseController {

	public function getIndex() {
		return Redirect::to('/');
	}

	public function getCreate() {
		return View::make('createSchool');
	}

	public function postCreate() {
		//Validation
		$rules = array(
			'name' => 'required',
			'city' => 'required',
			'country' => 'required',
			'email' => 'required|email|unique:schools,email',
			'password' => 'required'
		);
		$validator = Validator::make(Input::all(), 
			$rules);

		if ($validator->fails()) {
			return Redirect::to('/schools/create')
				->withInput()
				->withErrors($validator);
		}

		//Get basic information from form
		$school = new School;
		$school->name = Input::get('name');
		$school->city = Input::get('city');
		$school->state = Input::get('state');
		$school->country = Input::get('country');
		$school->email = Input::get('email');
		$school->password = Hash::make(Input::get('password'));
		//Add the school to the database
		$school->save();

		$message = 'Your school has been successfully created. Please write down your school ID ('.$school->id.') and give this, along with your password, to your teachers.';
		return Redirect::to('/')->with('flash_message', $message)->with('alert_class', 'alert-success');
	}

}