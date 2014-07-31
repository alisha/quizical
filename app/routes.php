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
	return View::make('index');
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
				return Redirect::intended('/')->with('flash_message', 'Welcome back!');
			} else {
				return Redirect::to('/login')->with('flash_message', 'That didn\'t seem to work - try again?')->with('alert_class', 'alert-danger');
			}
		}
	)
);

Route::get('/logout', function() {
	Auth::logout();
	return Redirect::to('/')->with('flash_message', 'You\'ve been logged out.');
});

Route::controller('schools', 'SchoolController');

Route::controller('users', 'UserController');

Route::group(array('before' => 'auth'), function() {
	Route::resource('courses', 'CourseController');

	Route::resource('assessments', 'AssessmentController');
});
