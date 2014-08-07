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
				@for ($index = 0; $index < count($message->getOtherUsers()); $index++)
					{{ $message->getOtherUsers()[$index]->first_name }} {{ $message->getOtherUsers()[$index]->last_name }}@if($index != count($message->getOtherUsers()) - 1)@if ($index == count($message->getOtherUsers()) - 2)@if (count($message->getOtherUsers()) > 2), and @else and @endif @else, @endif @endif
				@endfor
			</p>
			<br>
		@endforeach
	@endif

	{{-- Add button --}}
	{{ Form::open(array('route' => 'messages.create', 'method' => 'get')) }}
		<button class="btn btn-primary" href="/courses/create">New message</button>
	{{ Form::close() }}
@stop