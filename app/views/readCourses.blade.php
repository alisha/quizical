@extends('_master')

@section('title')
Quizical | Courses
@stop

@section('content')
	<h1>Your courses</h1>

	{{-- List courses --}}

	<div class="row">
		@foreach($courses as $course)
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<h3 class="courseBlock"><a href="/courses/{{$course->id}}">{{ $course->name }}</a> <br> 
						<small>{{ $course->block }} Block, {{ $course->start_year }}-{{ $course->start_year+1 }}</small></h3>

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
					</div>
				</div>
			</div>
		@endforeach
	</div>

	{{-- Add button --}}

	{{ Form::open(array('route' => 'courses.create', 'method' => 'get')) }}
		<button class="btn btn-primary" href="/courses/create">Add a course</button>
	{{ Form::close() }}
@stop