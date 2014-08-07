<?php

class MessageController extends \BaseController {

	/**
	 *Get the users associated with an array, excluding the logged in user
	 *
	 * @param  int  $id
	 * @return array
	 *
	 */
	public function getOtherUsers($id) {
		$allUsers = Message::findOrfail($id)->user->all();
		$returnUsers = [];

		foreach ($allUsers as $user) {
			if ($user->id != Auth::user()->id) {
				array_push($returnUsers, $user);
			}
		}

		return $returnUsers;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$messages = Auth::user()->message->all();

		return View::make('readMessages')->with('messages', $messages);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('createMessage');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$message = new Message;

		//Validation
		$rules = array(
			'teachers' => 'required',
			'subject' => 'required',
			'text' => 'required'
		);
		$validator = Validator::make(Input::all(), 
			$rules);

		if ($validator->fails()) {
			return Redirect::to('/courses/create')
				->withInput()
				->withErrors($validator);
		}

		$message->subject = Input::get('subject');
		$message->save();

		$message->user()->attach(Auth::user()->id);
		foreach (Input::get('teachers') as $id) {
			$message->user()->attach($id);
		}

		$reply = new Reply;
		$reply->text = Input::get('text');
		$reply->message_id = $message->id;
		$reply->user_id = Auth::user()->id;
		$reply->save();

		return Redirect::to('/messages')
			->with('flash_message', 'Your message has been sent')
			->with('alert_class', 'alert-success');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$message = Message::find($id);

		if (!(isset($message))) {
			return Redirect::to('/messages')
				->with('flash_message', 'That message doesn\'t exist!')
				->with('alert_class', 'alert-danger');
		}

		$users = $message->user->all();

		//If the user isn't part of the conversation, don't let them view it
		$inArray = false;
		foreach ($users as $user) {
			if ($user->id == Auth::user()->id) {
				$inArray = true;
			}
		}

		if (!$inArray) {
			return Redirect::to('/messages')
				->with('flash_message', 'You don\'t have permission to view this message')
				->with('alert_class', 'alert-danger');
		}

		$replies = Reply::where('message_id', '=', $message->id)->get();
		return View::make('readOneMessage')->with(array(
			'message' => $message,
			'users' => $message->getOtherUsers(),
			'replies' => $replies
		));
	}

	/**
	 * Send a reply
	 *
	 * @param int 	$id
	 * @return Response
	*/
	public function reply($id) {
		$message = Message::findOrfail($id);
		$user = Auth::user();

		$reply = new Reply;
		$reply->text = Input::get('text');
		$reply->message_id = $message->id;
		$reply->user_id = $user->id;
		$reply->save();

		return Redirect::to('/messages/'.$id.'#'.$reply->id)
			->with('flash_message', 'Your message has been sent!')
			->with('alert_class', 'alert-success');
	}
}
