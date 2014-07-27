@extends('_master')

@section('title')
Quizical | Create an Assessment
@stop

@section('content')

	<h1>Create an Assessment</h1>

	{{ Form::open(array('action' => 'assessments.store')) }}

		{{ Form::label('name', 'Name of the assessment: ') }}
		{{ Form::text('name', '', array('required' => 'required')) }}

		<br><br>

		{{ Form::label('description', 'Description: ') }}
		{{ Form::text('description', '') }}

		<br><br>

		{{ Form::label('date', 'Date: ') }}
		{{ Form::input('date', 'date', '', array('required' => 'required')) }}

		<br><br>

		{{ Form::label('type', 'Type: ') }}
		{{ Form::text('type', '', array('required' => 'required')) }}

		<br><br>

		{{ Form::label('course_id', 'Course:') }} <br>
		@if (count(Course::where('user_id', '=', Auth::user()->id)->get()) == 0)
			<p>Uh oh, it looks like you don't have any courses! Why don't you <a href="/courses/new">create one?</a></p>
		@else
			@foreach (Course::where('user_id', '=', Auth::user()->id)->get() as $course)
				{{ Form::radio('course_id', $course->id, true) }} {{ $course->name }} <br>
			@endforeach
		@endif

		{{ Form::submit('Create!') }}

	{{ Form::close() }}

@stop