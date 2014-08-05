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
	$data = Input::all();

	if (!(Input::has('department'))) {
		$data['department'] = ['Math', 'Science', 'English', 'History/Social Studies', 'Foreign Languages', 'Guidance and Support', 'Health and Wellness', 'Art', 'Other'];
	}
	if (!(Input::has('level'))) {
		$data['level'] = ['Foundations', 'College Prep', 'Honors', 'Advanced Placement'];
	}
	if (!(Input::has('grade'))) {
		$data['grade'] = ['9', '10', '11', '12'];
	}

	//var_dump($data);
	//die();

	if (Auth::check()) {
		$teachers = User::where('school_id', '=', Auth::user()->school_id)->get();
		foreach ($teachers as $teacher) {
			foreach (Course::where('user_id', '=', $teacher->id)->get() as $course) {
				//Find out what students are in the class
				$hasFreshmen = ($course->number_of_freshmen != 0) ? true : false;
				$hasSophomores = ($course->number_of_sophomores != 0) ? true : false;
				$hasJuniors = ($course->number_of_juniors != 0) ? true : false;
				$hasSeniors = ($course->number_of_seniors != 0) ? true : false;

				//Make sure the course is the right department and level
				if (in_array($course->department, $data['department']) && in_array($course->level, $data['level'])) {
					//Make sure the course has the right students
					if ((in_array('9', $data['grade']) && $hasFreshmen) || (in_array('10', $data['grade']) && $hasSophomores) || (in_array('11', $data['grade']) && $hasJuniors) || (in_array('12', $data['grade']) && $hasSeniors)) {
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
		}
	}
	return View::make('index')->with('assessments', $assessments)->with('data', $data);
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

	Route::post('messages/{id}', 'MessageController@reply');
	Route::resource('messages', 'MessageController');
});

Route::controller('password', 'RemindersController');

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});
