<?php

use \Hackzilla\PasswordGenerator\Generator\PasswordGenerator;

class SchoolController extends BaseController {

	public function getIndex() {
		return Redirect::to('/');
	}

	public function getCreate() {
		return View::make('createSchool');
	}

	public function postCreate() {
		//Get basic information from form
		$school = new School;
		$school->name = Input::get('name');
		$school->city = Input::get('city');
		$school->state = Input::get('state');
		$school->country = Input::get('country');

		//Generate a unique passcode for teachers to use
		$generator = new PasswordGenerator();
		$generator->setOptions(PasswordGenerator::OPTION_UPPER_CASE | PasswordGenerator::OPTION_LOWER_CASE | PasswordGenerator::OPTION_NUMBERS);
		$generator->setLength(10);
		$school->passcode = $generator->generatePassword();

		//Add the school to the database
		$school->save();

		$message = 'Your school has been successfully created. Please write down the ID and passcode to give to your teachers. <br>ID: '.$school->id.'<br>Passcode: '.$school->passcode;
		return Redirect::to('/')->with('flash_message', $message);
	}

}