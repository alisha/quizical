@extends('_master')

@section('title')
Quizical | {{ $assessment->name }}
@stop

@section('content')

	<h1>{{ $assessment->name }} for <a href="/courses/{{Course::where('id', '=', $assessment->course_id)->firstOrFail()->id}}">{{ Course::where('id', '=', $assessment->course_id)->firstOrFail()->name }}</a></h1>

	<button href="/assessments/{{$assessment->id}}/edit">Edit</button>
	{{ Form::open(array('route' => array('assessments.destroy', $assessment->id), 'method' => 'delete')) }}
		<button type="submit" href="{{ URL::route('assessments.destroy', $assessment->id) }}">Delete</button>
	{{ Form::close() }}
	
	<p>Description: {{ $assessment->description }}</p>
	<p>Date: {{ $assessment->date }}</p>
	<p>Type: {{ $assessment->type }}</p>

@stop