@extends('_master')

@section('titile')
Quizical | Edit {{ $course->name }}
@stop

@section('content')

	<h1>Edit {{ $course->name }}</h1>

	{{ Form::model($course, array('method' => 'put', 'route' => array('courses.update', $course->id), 'class' => 'form-horizontal')) }}

		{{ Form::input('hidden', 'id', $course->id) }}

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('name', 'Name of the course: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('name', $course->name, array('required' => 'required', 'class' => 'form-control inputField')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('block', 'Block: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('block', $course->block , array('required' => 'required', 'class' => 'form-control inputField')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('start_year', 'Start year: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'start_year', $course->start_year, array('required' => 'required', 'class' => 'form-control inputField', 'min' => date('Y'))) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('number_of_freshmen', 'Number of freshmen: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'number_of_freshmen', $course->number_of_freshmen, array('required' => 'required', 'class' => 'form-control inputField', 'min' => '0')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('number_of_sophomores', 'Number of sophomores: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'number_of_sophomores', $course->number_of_sophomores, array('required' => 'required', 'class' => 'form-control inputField', 'min' => '0')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('number_of_juniors', 'Number of juniors: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'number_of_juniors', $course->number_of_juniors, array('required' => 'required', 'class' => 'form-control inputField', 'min' => '0')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('number_of_seniors', 'Number of seniors: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'number_of_seniors', $course->number_of_seniors, array('required' => 'required', 'class' => 'form-control inputField', 'min' => '0')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('department', 'Department: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::radio('department', 'Math', true) }} Math <br>
				{{ Form::radio('department', 'Science') }} Science <br>
				{{ Form::radio('department', 'English') }} English <br>
				{{ Form::radio('department', 'History/Social Studies') }} History/Social Studies <br>
				{{ Form::radio('department', 'Foreign Languages') }} Foreign Languages <br>
				{{ Form::radio('department', 'Guidance and Support') }} Guidance and Support <br>
				{{ Form::radio('department', 'Health and Wellness') }} Health and Wellness <br>
				{{ Form::radio('department', 'Arts') }} Arts <br>
				{{ Form::radio('department', 'Other') }} Other
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('level', 'Level: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::radio('level', 'Foundations', true) }} Foundations <br>
				{{ Form::radio('level', 'College Prep') }} College Prep <br>
				{{ Form::radio('level', 'Honors') }} Honors <br>
				{{ Form::radio('level', 'Advanced Placement') }} Advanced Placement
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Update!', array('class' => 'btn btn-primary')) }}
			</div>
		</div>

	{{ Form::close() }}

@stop