@extends('_master')

@section('title')
Quizical | Create a Course
@stop

@section('content')

	<h1>Create a Course</h1>

	{{ Form::open(array('route' => 'courses.store')) }}


		{{ Form::label('name', 'Name of the course: ') }}
		{{ Form::text('name', '', array('required' => 'required')) }}

		<br><br>

		{{ Form::label('block', 'Block: ') }}
		{{ Form::text('block', '', array('required' => 'required')) }}

		<br><br>

		{{ Form::label('start_year', 'Start year: ') }}
		{{ Form::input('number', 'start_year', date('Y'), array('required' => 'required')) }}

		<br><br>

		{{ Form::label('number_of_freshmen', 'Number of freshmen: ') }}
		{{ Form::input('number', 'number_of_freshmen', '', array('required' => 'required')) }}

		<br><br>

		{{ Form::label('number_of_sophomores', 'Number of sophomores: ') }}
		{{ Form::input('number', 'number_of_sophomores', '', array('required' => 'required')) }}

		<br><br>

		{{ Form::label('number_of_juniors', 'Number of juniors: ') }}
		{{ Form::input('number', 'number_of_juniors', '', array('required' => 'required')) }}

		<br><br>

		{{ Form::label('number_of_seniors', 'Number of seniors: ') }}
		{{ Form::input('number', 'number_of_seniors', '', array('required' => 'required')) }}

		<br><br>

		{{ Form::label('department', 'Department: ') }} <br>
		{{ Form::radio('department', 'Math', true) }} Math <br>
		{{ Form::radio('department', 'Science') }} Science <br>
		{{ Form::radio('department', 'English') }} English <br>
		{{ Form::radio('department', 'History/Social Studies') }} History/Social Studies <br>
		{{ Form::radio('department', 'Foreign Languages') }} Foreign Languages <br>
		{{ Form::radio('department', 'Guidance and Support') }} Guidance and Support <br>
		{{ Form::radio('department', 'Health and Wellness') }} Health and Wellness <br>
		{{ Form::radio('department', 'Arts') }} Arts <br>
		{{ Form::radio('department', 'Other') }} Other

		<br><br>

		{{ Form::label('level', 'Level: ') }} <br>
		{{ Form::radio('level', 'Foundations', true) }} Foundations <br>
		{{ Form::radio('level', 'College Prep') }} College Prep <br>
		{{ Form::radio('level', 'Honors') }} Honors <br>
		{{ Form::radio('level', 'Advanced Placement') }} Advanced Placement <br>

		<br>

		{{ Form::submit('Create!') }}

	{{ Form::close() }}

@stop