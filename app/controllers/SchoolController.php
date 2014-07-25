<?php

use \Hackzilla\PasswordGenerator\Generator\PasswordGenerator;

class SchoolController extends BaseController {

	public function getIndex() {
		return Redirect::to('/');
	}

	public function getNew() {
		return View::make('createSchool');
	}

	public function postNew() {
		$school = new School;
		$school->name = Input::get('name');
		$school->city = Input::get('city');
		$school->state = Input::get('state');
		$school->country = Input::get('country');

		$generator = new PasswordGenerator();
		$generator->setOptions(PasswordGenerator::OPTION_UPPER_CASE | PasswordGenerator::OPTION_LOWER_CASE | PasswordGenerator::OPTION_NUMBERS);
		$generator->setLength(10);
		$school->passcode = $generator->generatePassword();

		$school->save();

		$message = 'Your school has been successfully created. Please write down this passcode and give it to your teachers: ' + $school->passcode;
		return Redirect::to('/')->with('flash_message', $message);
	}

}