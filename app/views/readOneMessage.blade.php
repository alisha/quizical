@extends('_master')

@section('title')
Quizical | Message: {{ $message->subject }}
@stop

@section('content')

	<h1>Message: {{ $message->subject }}</h1>
	<h4><b>With:</b></h4>
		<ul>
			@foreach ($users as $user)
				@if ($user->id != Auth::user()->id)
					<li>{{ $user->first_name }} {{ $user->last_name }}</li>
				@endif
			@endforeach
		</ul>

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