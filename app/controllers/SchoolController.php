<?php

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
		$school->save();
		return Redirect::to('/');
	}

}