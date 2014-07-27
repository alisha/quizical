@extends('_master')

@section('title')
Quizical | Courses
@stop

@section('content')
	<h1>Your courses</h1>
	<p><a href="/courses/create">Add another?</a></p>

	@foreach($courses as $course)
		<a href="/courses/{{$course->id}}">{{ $course->name }}</a> ({{ $course->start_year }}-{{ $course->start_year+1 }})

		<button href="/courses/{{$course->id}}/edit">Edit</button>
		{{ Form::open(array('route' => array('courses.destroy', $course->id), 'method' => 'delete')) }}
			<button type="submit" href="{{ URL::route('courses.destroy', $course->id) }}">Delete</button>
		{{ Form::close() }}
	@endforeach
@stop