@extends('_master')

@section('title')
Quizical | Message: {{ $message->subject }}
@stop

@section('content')

	<h1>Message: {{ $message->subject }}</h1>
	<h3>With: 
		@for ($index = 0; $index < count($users); $index++) {{ $users[$index]->first_name }} {{ $users[$index]->last_name }}@if (count($users) == 2 && $index == 1) and @endif @if (count($users) > 2), @if ($index == count($users) - 2)and @endif @endif @endfor
	</h3>

	<br>

	@foreach ($replies as $reply)
		<p><a name="{{$reply->id}}" style="color:black;text-decoration:none;"><b>{{ User::where('id', '=', $reply->user_id)->firstOrFail()->first_name }} {{ User::where('id', '=', $reply->user_id)->firstOrFail()->last_name }}</b>: {{ $reply->text }}</a></p>
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