@extends('_master')

@section('title')
Quizical | Create a Course
@stop

@section('content')

	<h1>Create a Course</h1>

	<h3 class="secondary-title"><small>All fields are required.</small></h3>

	<br>

	{{ Form::open(array('route' => 'courses.store', 'class' => 'form-horizontal')) }}

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('name', 'Name of the course: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('name', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('block', 'Block: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('block', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('start_year', 'Start year: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'start_year', date('Y'), array('class' => 'form-control', 'min' => date('Y')-1 )) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('number_of_freshmen', 'Number of freshmen:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'number_of_freshmen', '', array('class' => 'form-control', 'min' => '0')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('number_of_sophomores', 'Number of sophomores: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'number_of_sophomores', '', array('class' => 'form-control', 'min' => '0')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('number_of_juniors', 'Number of juniors: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'number_of_juniors', '', array('class' => 'form-control', 'min' => '0')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('number_of_seniors', 'Number of seniors: ') }}
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'number_of_seniors', '', array('class' => 'form-control', 'min' => '0')) }}
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
				{{ Form::label('level', 'Level: ') }} <br>
			</div>
			
			<div class="col-sm-10">
				{{ Form::radio('level', 'Foundations', true) }} Foundations <br>
				{{ Form::radio('level', 'College Prep') }} College Prep <br>
				{{ Form::radio('level', 'Honors') }} Honors <br>
				{{ Form::radio('level', 'Advanced Placement') }} Advanced Placement <br>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}
			</div>
		</div>
		
	{{ Form::close() }}

@stop