@extends('_master')

@section('title')
@parent | {{ $assessment->name }}
@stop

@section('content')

	<h1>{{ $assessment->name }} for <a href="/courses/{{Course::where('id', '=', $assessment->course_id)->firstOrFail()->id}}">{{ Course::where('id', '=', $assessment->course_id)->firstOrFail()->name }}</a></h1>
	
	<p><b>Description:</b> {{ $assessment->description }}</p>
	<p><b>Date:</b> {{ date('F j, Y', strtotime($assessment->date)) }}</p>
	<p><b>Type:</b> {{ $assessment->type }}</p>

	@if (Course::where('id', '=', $assessment->course_id)->firstOrFail()->user_id == Auth::user()->id)
		<div class="col-md-1 crudButtons">
			<div class="col-md-6">
				{{-- Edit button --}}
				{{ Form::open(array('route' => array('assessments.edit', $assessment->id), 'method' => 'get')) }}
					<button class="btn btn-warning btn-sm" href="/assessments/{{$assessment->id}}/edit">Edit</button>
				{{ Form::close() }}
			</div>

			<div class="col-md-6">
				{{-- Delete button --}}
				{{ Form::open(array('route' => array('assessments.destroy', $assessment->id), 'method' => 'delete')) }}
					<button type="submit" class="btn btn-danger btn-sm" href="{{ URL::route('assessments.destroy', $assessment->id) }}">Delete</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@stop