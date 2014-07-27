<?php

class AssessmentController extends BaseController {

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
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('createAssessment');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$assessment = new Assessment;
		App::make('AssessmentController')->saveInput($assessment);
		return Redirect::to('/assessments'.$assessment->id)->with('flash_message', 'Your assessment has been successfully created.');
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
			return Redirect::to('/')->with('flash_message', 'Sorry, you don\'t have permission to view this assessment.');
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
			Redirect::to('/')->with('flash_message', 'Sorry, that assessment doesn\'t exist');
		} else {
			$course = Course::where('id', '=', $assessment->course_id)->first();
			if (!isset($course)) {
				Redirect::to('/')->with('flash_message', 'Sorry, that course doesn\'t exist');
			} else {
				//Make sure the assessment belongs to the teacher
				if ($course->user_id != Auth::user()->id) {
					Redirect::to('/')->with('flash_message', 'You do not have permission to edit this assessment.');
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
		App::make('AssessmentController')->saveInput($assessment, $data);
		$path = '/courses/'.$assessment->course_id;
		return Redirect::to($path)->with('flash_message', 'Your assessment has been successfully updated.');
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