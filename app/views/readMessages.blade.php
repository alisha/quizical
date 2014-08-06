@extends('_master')

@section('title')
Quizical | Messages
@stop

@section('content')
	<h1>Your Messages</h1>
	@if (count($messages) == 0)
		<p>You don't have any messages!</p>
	@else
		@foreach ($messages as $message)
			<p><a href="/messages/{{$message->id}}"><b>{{ $message->subject }}</b></a><br>With:
				{{-- Display users in the message --}}
				<ul class="userList">
				@foreach ($message->user->all() as $user)
					@if ($user->id != Auth::user()->id)
						<li>{{ $user->first_name }} {{ $user->last_name }}</li>
					@endif
				@endforeach
				</ul>
			</p>
			<br>
		@endforeach
	@endif

	{{-- Add button --}}
	{{ Form::open(array('route' => 'messages.create', 'method' => 'get')) }}
		<button class="btn btn-primary" href="/courses/create">New message</button>
	{{ Form::close() }}
@stop