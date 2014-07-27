@extends('_master')

@section('title')
Quizical | {{ $course->name }}
@stop

@section('content')

	<h1>{{ $course->name }}</h1>
	
	<button href="/courses/{{$course->id}}/edit">Edit</button>
	{{ Form::open(array('route' => array('courses.destroy', $course->id), 'method' => 'delete')) }}
		<button type="submit" href="{{ URL::route('courses.destroy', $course->id) }}">Delete</button>
	{{ Form::close() }}

	<p>Block: {{ $course->block }}</p>
	<p>Year: {{ $course->start_year }}-{{ $course->start_year+1 }}</p>
	<p>Department: {{ $course->department }}</p>
	<p>Level: {{ $course->level }}</p>
	<p>Number of freshmen: {{ $course->number_of_freshmen }}</p>
	<p>Number of sophomores: {{ $course->number_of_sophomores }}</p>
	<p>Number of juniors: {{ $course->number_of_juniors }}</p>
	<p>Number of seniors: {{ $course->number_of_seniors }}</p>

	<h2>Assessments</h2>
	@if (count(Assessment::where('course_id', '=', $course->id)->get()) == 0)
		<p>This course doesn't have any assessments. Would you like to <a href="/assessments/create">add one?</a></p>
	@else
		<ul>
			@foreach (Assessment::where('course_id', '=', $course->id)->get() as $assessment)
				<li><a href="/assessments/{{ $assessment->id }}">{{ $assessment->name }}</a> on {{ $assessment->date }}</li>
			@endforeach
		</ul>
		<p><a href="/assessments/new">Add another?</a></p>
	@endif

@stop