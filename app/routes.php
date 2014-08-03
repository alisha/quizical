<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {
	$assessments = [];
	if (Auth::check()) {
		$teachers = User::where('school_id', '=', Auth::user()->school_id)->get();
		foreach ($teachers as $teacher) {
			foreach (Course::where('user_id', '=', $teacher->id)->get() as $course) {
				foreach (Assessment::where('course_id', '=', $course->id)->get() as $assessment) {
					$value = '<li><a href="/assessments/'.$assessment->id.'">'.$assessment->name.'</a> for <a href="/courses/'.$course->id.'">'.$course->name.'</a> (Block '.$course->block.')</li>';
					if (array_key_exists(date('Y-m-d', strtotime($assessment->date)), $assessments)) {
						array_push($assessments[date('Y-m-d', strtotime($assessment->date))], $value);
					} else {
						$assessments[date('Y-m-d', strtotime($assessment->date))] = array($value);
					}
				}
			}
		}
	}
	return View::make('index')->with('assessments', $assessments);
});

Route::get('/login',
	array(
		'before' => 'guest',
		function() {
			return View::make('login');
		}
	)
);

Route::post('/login',
	array(
		'before' => 'csrf',
		function() {
			$credentials = Input::only('email', 'password');
			$remember = Input::get('remember_me');

			if (Auth::attempt($credentials, $remember)) {
				return Redirect::intended('/')
					->with('flash_message', 'Welcome back!');
			} else {
				return Redirect::to('/login')
					->with('flash_message', 'That didn\'t seem to work - try again?')
					->with('alert_class', 'alert-danger')
					->withInput();
			}
		}
	)
);

Route::get('/logout', function() {
	Auth::logout();
	return Redirect::to('/')
		->with('flash_message', 'You\'ve been logged out.');
});

Route::controller('schools', 'SchoolController');

Route::resource('users', 'UserController');

Route::group(array('before' => 'auth'), function() {
	Route::resource('courses', 'CourseController');

	Route::resource('assessments', 'AssessmentController');
});

Route::controller('password', 'RemindersController');
