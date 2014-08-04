<?php

use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserController extends BaseController implements RemindableInterface {

	use RemindableTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return Redirect::to('/');
	}

	/**
	 * Show the form for creating a new resource.
	 * Only let the user create an assessment if they have at least one course
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('createUser');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$school = School::where('id', '=', Input::get('schoolID'))->first();

		//If the enter school credentials wrong, or their school doesn't exist, redirect them back to the signup page
		if (!(Hash::check(Input::get('passcode'), $school->password) || isset($school))) {
			return Redirect::to('/users/create')
				->with('flash_message', 'We couldn\'t find your school. Try again?')
				->with('alert_class', 'alert-danger')
				->withInput();
		}

		//Validate form input
		$rules = array(
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required',
			'schoolID' => 'required',
			'passcode' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::to('/users/create')
				->withInput()
				->withErrors($validator);
		}

		//Save the input
		$user = new User;
		$user->school_id = $school->id;
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->save();

		Mail::send('emails.welcome', array(), function($message) {
			$message->to('alishaaukani@gmail.com', 'Alisha Ukani')->subject('Welcome to Quizical!');
		});

		return Redirect::to('/login')->with('flash_message', 'Your account has been successfully created.')->with('alert_class', 'alert-success');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$user = User::where('id', '=', $id)->first();
		//If the specified user doesn't exist
		if (!isset($user)) {
			return Redirect::to('/')->with('flash_message', 'That user doesn\'t exist.')->with('alert_class', 'alert-danger');
		} 
		//If the specified user doesn't work at the same school as the current user
		else if ($user->school_id != Auth::user()->school_id) {
			return Redirect::to('/')->with('flash_message', 'You don\'t have permission to view this user\'s profile.')->with('alert_class', 'alert-danger');
		} 
		//If the specified user is not the current user
		else if ($user != Auth::user()) {
			$courses = $courses = Course::where('user_id', '=', $user->id)->orderBy('start_year', 'DESC')->orderBy('block')->get();
			return View::make('readCourses')->with('courses', $courses)->with('user', $user);
		} 
		//The specified user is the current user
		else {
			return View::make('readUser')->with('user', Auth::user())->with('courses', Course::where('user_id', '=', Auth::user()->id)->get())->with('school', School::where('id', '=', Auth::user()->school_id)->firstOrFail());
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$user = User::where('id', '=', $id)->first();
		if (!isset($user) || $user != Auth::user()) {
			return Redirect::to('/')
				->with('flash_message', 'You can\'t edit this user\'s profile!')
				->with('alert_class', 'alert-danger');
		} else {
			return View::make('updateUser')
				->with('user', Auth::user());
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$user = User::where('id', '=', $id)->firstOrFail();

		//Validation
		$rules = array(
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required',
			'newPassword' => 'required_with:oldPassword',
			'passcode' => 'required_with:schoolID'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::to('/users/'.$id.'/edit')
				->withInput()
				->withErrors($validator);
		}

		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');

		//If the user wants to change their password
		if (Input::get('oldPassword') != "") {
			if (Hash::check(Input::get('oldPassword'), $user->password)) {
				$user->password = Hash::make(Input::get('newPassword'));
			} else {
				return Redirect::to('/users/'.$id.'/edit')
					->withInput()
					->with('flash_message', 'Your current password doesn\'t match your actual password. Try again?')
					->with('alert_class', 'alert-danger');
			}
		}

		//If the user wants to change their school
		if (Input::get('schoolID') != "") {
			$newSchool = School::where('id', '=', Input::get('schoolID'))->first();
			if (!(Hash::check(Input::get('passcode'), $newSchool->password) || isset($newSchool))) {
				return Redirect::to('/users/create')
					->with('flash_message', 'We couldn\'t find your new school. Try again?')
					->with('alert_class', 'alert-danger')
					->withInput();
			} else {
				$user->school_id = $newSchool->id;
			}
		}

		$user->save();

		return Redirect::to('/users/'.$id)
			->with('flash_message', 'Your profile has been successfully updated')
			->with('alert_class', 'alert-success');
	}

}