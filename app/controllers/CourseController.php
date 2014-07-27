<?php

class CourseController extends BaseController {

	/* Non-CRUD Methods */

	//Save input for a course, given the course object and form data
	//Used to create and update courses
	public function saveInput($course) {
		$user_id = Auth::user()->id;

		$course->name = Input::get('name');
		$course->block = Input::get('block');
		$course->start_year = Input::get('start_year');
		$course->number_of_freshmen = Input::get('number_of_freshmen');
		$course->number_of_sophomores = Input::get('number_of_sophomores');
		$course->number_of_juniors = Input::get('number_of_juniors');
		$course->number_of_seniors = Input::get('number_of_seniors');
		$course->department = Input::get('department');
		$course->level = Input::get('level');
		$course->user_id = $user_id;
		$course->save();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$courses = Course::where('user_id', '=', Auth::user()->id)->get();
		return View::make('readCourses')->with('courses', $courses);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('createCourse');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$course = new Course;
		App::make('CourseController')->saveInput($course);
		return Redirect::to('/courses')->with('flash_message', 'Your course has been successfully created.');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$course = Course::where('id', '=', $id)->first();
		
		if (!is_object($course)) {
			return Redirect::to('/courses')->with('flash_message', 'Sorry, that course doesn\'t exist');
		} else if ($course->user_id != Auth::user()->id) {
			return Redirect::to('/courses')->with('flash_message', 'You do not have permission to view this course.');
		} else {
			return View::make('readOneCourse')->with('course', $course);
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$course = Course::where('id', '=', $id)->first();

		//Make sure the specified course exists
		if (!isset($course)) {
			return Redirect::to('/')->with('flash_message', 'Sorry, that course doesn\'t exist');
		}
		//Make sure the course belongs to the teacher
		else if ($course->user_id != Auth::user()->id) {
			return Redirect::to('/')->with('flash_message', 'You do not have permission to edit this course.');
		} else {
			return View::make('updateCourse')->with('course', $course);
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$course = Course::findOrFail(Input::get('id'));
		App::make('CourseController')->saveInput($course);
		$path = '/courses/'.$course->id;
		return Redirect::to($path)->with('flash_message', 'Your course has been successfully updated.');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$course = Course::findOrFail($id);
		Course::destroy($course->id);
		$allCourses = Course::where('user_id', '=', Auth::user()->id)->get();
		return Redirect::to('courses/')->with(array('flash_message' => 'Your course has been deleted.', 'courses' => $allCourses));
	}

}