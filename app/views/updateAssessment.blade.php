@extends('_master')

@section('titile')
Quizical | Edit {{ $assessment->name }}
@stop

@section('content')

	<h1>Edit {{ $assessment->name }} for {{ Course::where('id', '=', $assessment->course_id)->first()->name }}</h1>

	{{ Form::model($assessment, array('method' => 'put', 'route' => array('assessments.update', $assessment->id))) }}

		{{ Form::input('hidden', 'id', $assessment->id) }}

		{{ Form::label('name', 'Name of the assessment: ') }}
		{{ Form::text('name', $assessment->name, array('required' => 'required')) }}

		<br><br>

		{{ Form::label('description', 'Description: ') }}
		{{ Form::text('description', $assessment->description) }}

		<br><br>

		{{ Form::label('date', 'Date: ') }}
		{{ Form::input('date', 'date', $assessment->date, array('required' => 'required')) }}

		<br><br>

		{{ Form::label('type', 'Type: ') }}
		{{ Form::text('type', $assessment->type, array('required' => 'required')) }}

		<br><br>

		{{ Form::label('course_id', 'Course:') }} <br>
		@if (count(Course::where('user_id', '=', Auth::user()->id)->get()) == 0)
			<p>Uh oh, it looks like you don't have any courses! Why don't you <a href="/courses/new">create one?</a></p>
		@else
			@foreach (Course::where('user_id', '=', Auth::user()->id)->get() as $course)
				{{ Form::radio('course_id', $course->id, true) }} {{ $course->name }} <br>
			@endforeach
		@endif

		{{ Form::submit('Update!') }}

	{{ Form::close() }}

@stop