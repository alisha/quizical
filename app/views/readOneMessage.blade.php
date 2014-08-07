@extends('_master')

@section('title')
Quizical | Message: {{ $message->subject }}
@stop

@section('content')

	<h1>Message: {{ $message->subject }}</h1>
	<h4><b>With:</b>
		@for ($index = 0; $index < count($users); $index++)
			{{ $users[$index]->first_name }} {{ $users[$index]->last_name }}@if($index != count($users) - 1)@if ($index == count($users) - 2)@if (count($users) > 2), and @else and @endif @else, @endif @endif
		@endfor
	</h4>

	<br>

	@foreach ($replies as $reply)
		<p><a name="{{$reply->id}}" style="color:black;text-decoration:none;"><b>{{ $reply->user->first_name }} {{ $reply->user->last_name }}</b>:
		<br>{{ $reply->text }}</a></p>
	@endforeach

	<br>

	<h3>Reply:</h3>
	{{ Form::open(array('url' => '/messages/'.$message->id, 'class' => 'form')) }}
		<div class="form-group">
			{{ Form::textarea('text', '', array('class' => 'form-control', 'placeholder' => 'Message', 'rows' => '5')) }}
		</div>

		{{ Form::submit('Send!', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}

@stop