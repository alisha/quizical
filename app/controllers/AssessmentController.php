<?php

class AssessmentController extends BaseController {

	//Validation rules
	public static $rules = array(
		'name' => 'required',
		'date' => 'required',
		'type' => 'required',
		'course_id' => 'required'
	);

	/* Non-CRUD Methods */

	//Save input for an assessment, given the assessment object and form data
	//Used to create and update assessments
	public function saveInput($assessment) {
		$assessment->name = Input::get('name');
		$assessment->description = Input::get('description');
		$assessment->date = Input::get('date');
		$assessment->type = Input::get('type');
		$assessment->course_id = Input::get('course_id');
		$assessment->save();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return Redirect::to('/courses');
	}

	/**
	 * Show the form for creating a new resource.
	 * Only let the user create an assessment if they have at least one course
	 *
	 * @return Response
	 */
	public function create() {
		$hasCourses = (count(Course::where('user_id', '=', Auth::user()->id)->get()) != 0) ? true : false;
		if (!$hasCourses) {
			return Redirect::to('/courses/create')->with('flash_message', 'You have to create a course before you can create an assessment!')->with('alert_class', 'alert-danger');
		}

		return View::make('createAssessment');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//Validation
		$validator = Validator::make(Input::all(), 
			self::$rules);

		if ($validator->fails()) {
			return Redirect::to('/assessments/create')
				->with('alert_class', 'alert-danger')
				->withInput()
				->withErrors($validator);
		}

		$assessment = new Assessment;
		$course = Course::where('id', '=', Input::get('course_id'))->firstOrFail();

		if ($course->user_id != Auth::user()->id) {
			return Redirect::to('/assessments/new')->with('flash_message', 'You can\'t create an assessment for a course you don\'t own!')->with('alert_class', 'alert-danger');
		}

		App::make('AssessmentController')->saveInput($assessment);
		return Redirect::to('/assessments/'.$assessment->id)->with('flash_message', 'Your assessment has been successfully created.')->with('alert_class', 'alert-success');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$assessment = Assessment::where('id', '=', $id)->firstOrFail();
		$course = Course::where('id', '=', $assessment->course_id)->firstOrFail();
		$user = User::where('id', '=', $course->user_id)->firstOrFail();
		if ($user->school_id == Auth::user()->school_id) {
			return View::make('readOneAssessment')->with('assessment', $assessment);
		} else {
			return Redirect::to('/')->with('flash_message', 'Sorry, you don\'t have permission to view this assessment.')->with('alert_class', 'alert-danger');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$assessment = Assessment::where('id', '=', $id)->first();

		//Make sure the specified course exists
		if (!isset($assessment)) {
			Redirect::to('/')->with('flash_message', 'Sorry, that assessment doesn\'t exist')->with('alert_class', 'alert-danger');
		} else {
			$course = Course::where('id', '=', $assessment->course_id)->first();
			if (!isset($course)) {
				Redirect::to('/')->with('flash_message', 'Sorry, the course for that assessment doesn\'t exist')->with('alert_class', 'alert-danger');
			} else {
				//Make sure the assessment belongs to the teacher
				if ($course->user_id != Auth::user()->id) {
					Redirect::to('/')->with('flash_message', 'You do not have permission to edit this assessment.')->with('alert_class', 'alert-danger');
				} else {
					return View::make('updateAssessment')->with('assessment', $assessment);
				}
			}
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$assessment = Assessment::findOrFail(Input::get('id'));
		App::make('AssessmentController')->saveInput($assessment);
		$path = '/courses/'.$assessment->course_id;
		return Redirect::to($path)->with('alert_class', 'alert-success')->with('flash_message', 'Your assessment has been successfully updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$assessment = Assessment::findOrFail($id);
		$course = Course::where('id', '=', $assessment->course_id)->firstOrFail();
		Assessment::destroy($assessment->id);
		return Redirect::to('courses/'.$course->id)->with('flash_message', 'Your assessment has been deleted.');
	}

}