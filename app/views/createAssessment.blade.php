@extends('_master')

@section('title')
Quizical | Create an Assessment
@stop

@section('content')

	{{-- If there are any errors with the input, give the user a warning --}}
	@if (count($errors) != 0)
		@foreach($errors->all() as $message)
			<div class="alert alert-danger alert-dismissable" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			{{ $message }} <br>
		</div>		
		@endforeach
	@endif

	<h1>Create an Assessment</h1>

	<br>

	{{ Form::open(array('action' => 'assessments.store', 'class' => 'form-horizontal')) }}

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('name', 'Name of the assessment: ') }} <br>
				<span class="help-block">Required</span>
			</div>

			<div class="col-sm-10">
				{{ Form::text('name', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('description', 'Description: ') }} <br>
				<span class="help-block">Optional</span>
			</div>

			<div class="col-sm-10">
				{{ Form::textarea('description', '', array('class' => 'form-control', 'rows' => '3')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('date', 'Date: ') }} <br>
				<span class="help-block">Required</span>
			</div>

			<div class="col-sm-10">
				{{ Form::input('date', 'date', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('type', 'Type: ') }} <br>
				<span class="help-block">E.g. "Quiz" or "Test". Required</span>
			</div>

			<div class="col-sm-10">
				{{ Form::text('type', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('course_id', 'Course:') }} <br>
				<span class="help-block">Required</span>
			</div>

			<div class="col-sm-10">
				@if (count(Course::where('user_id', '=', Auth::user()->id)->get()) == 0)
					<p>Uh oh, it looks like you don't have any courses! Why don't you <a href="/courses/create">create one?</a></p>
				@else
					@foreach (Course::where('user_id', '=', Auth::user()->id)->get() as $course)
						{{ Form::radio('course_id', $course->id, true) }} {{ $course->name }} <br>
					@endforeach
				@endif
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}
			</div>
		</div>

	{{ Form::close() }}

@stop