@extends('_master')

@section('title')
Quizical | {{ $course->name }}
@stop

@section('content')

	<h1>{{ $course->name }}</h1>

	@if ($course->user_id != Auth::user()->id)
		<p><b>Teacher:</b> <a href="/users/{{$teacher->id}}">{{ $teacher->first_name }} {{ $teacher->last_name }}</a></p>
	@endif

	<p><b>Block:</b> {{ $course->block }}</p>
	<p><b>Year:</b> {{ $course->start_year }}-{{ $course->start_year+1 }}</p>
	<p><b>Department:</b> {{ $course->department }}</p>
	<p><b>Level:</b> {{ $course->level }}</p>
	<p><b>Number of freshmen:</b> {{ $course->number_of_freshmen }}</p>
	<p><b>Number of sophomores:</b> {{ $course->number_of_sophomores }}</p>
	<p><b>Number of juniors:</b> {{ $course->number_of_juniors }}</p>
	<p><b>Number of seniors:</b> {{ $course->number_of_seniors }}</p>

	@if ($teacher->id == Auth::user()->id)
		<div class="col-md-1 crudButtons">
			<div class="col-md-6">
				{{-- Edit button --}}
				{{ Form::open(array('route' => array('courses.edit', $course->id), 'method' => 'get')) }}
					<button class="btn btn-warning btn-sm" href="/courses/{{$course->id}}/edit">Edit</button>
				{{ Form::close() }}
			</div>

			<div class="col-md-6">
				{{-- Delete button --}}
				{{ Form::open(array('route' => array('courses.destroy', $course->id), 'method' => 'delete')) }}
					<button type="submit" class="btn btn-danger btn-sm" href="{{ URL::route('courses.destroy', $course->id) }}">Delete</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif

	<br><br>

	<h2>Assessments</h2>
	@if (count(Assessment::where('course_id', '=', $course->id)->get()) == 0)
		<p>This course doesn't have any assessments.</p>
	@else
		<div id="assessments">
			<ul>
				@foreach (Assessment::where('course_id', '=', $course->id)->get() as $assessment)
					<li><a href="/assessments/{{ $assessment->id }}">{{ $assessment->name }}</a> on {{ date('F j, Y', strtotime($assessment->date)) }}</li>
				@endforeach
			</ul>
		</div>	
	@endif

	@if ($teacher->id == Auth::user()->id)
		{{-- Add button --}}
		{{ Form::open(array('route' => array('assessments.create'), 'method' => 'get')) }}
			<button type="submit" class="btn btn-primary btn-sm" href="{{ URL::route('assessments.create') }}">Add an assessment</button>
		{{ Form::close() }}
	@endif

@stop