@extends('_master')

@section('titile')
Quizical | Edit {{ $assessment->name }}
@stop

@section('content')

	<h1>Edit {{ $assessment->name }} for {{ Course::where('id', '=', $assessment->course_id)->first()->name }}</h1>

	{{ Form::model($assessment, array('method' => 'put', 'route' => array('assessments.update', $assessment->id), 'class' => 'form-horizontal')) }}

		{{ Form::input('hidden', 'id', $assessment->id) }}

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('name', 'Name of the assessment: ') }} <br>
				<span class="help-block">Required</span>
			</div>

			<div class="col-sm-10">
				{{ Form::text('name', $assessment->name, array('class' => 'form-control')) }}
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('description', 'Description: ') }} <br>
				<span class="help-block">Optional</span>
			</div>

			<div class="col-sm-10">
				{{ Form::text('description', $assessment->description, array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('date', 'Date: ') }} <br>
				<span class="help-block">Required</span>
			</div>

			<div class="col-sm-10">
				{{ Form::input('date', 'date', $assessment->date, array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('type', 'Type: ') }} <br>
				<span class="help-block">E.g. "Quiz" or "Test". Required</span>
			</div>

			<div class="col-sm-10">
				{{ Form::text('type', $assessment->type, array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('course_id', 'Course:') }}
			</div>

			<div class="col-sm-10">
				@if (count(Course::where('user_id', '=', Auth::user()->id)->get()) == 0)
					<p>Uh oh, it looks like you don't have any courses! Why don't you <a href="/courses/new">create one?</a></p>
				@else
					@foreach (Course::where('user_id', '=', Auth::user()->id)->get() as $course)
						{{ Form::radio('course_id', $course->id, true) }} {{ $course->name }} <br>
					@endforeach
				@endif
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Update!', array('class' => 'btn btn-primary')) }}
			</div>
		</div>

	{{ Form::close() }}

@stop