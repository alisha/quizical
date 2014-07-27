@extends('_master')

@section('titile')
Quizical | Edit {{ $course->name }}
@stop

@section('content')

	<h1>Edit {{ $course->name }}</h1>

	{{ Form::model($course, array('method' => 'put', 'route' => array('courses.update', $course->id))) }}

		{{ Form::input('hidden', 'id', $course->id) }}

		{{ Form::label('name', 'Name of the course: ') }}
		{{ Form::text('name', $course->name, array('required' => 'required')) }}

		<br><br>

		{{ Form::label('block', 'Block: ') }}
		{{ Form::text('block', $course->block , array('required' => 'required')) }}

		<br><br>

		{{ Form::label('start_year', 'Start year: ') }}
		{{ Form::input('number', 'start_year', $course->start_year, array('required' => 'required')) }}

		<br><br>

		{{ Form::label('number_of_freshmen', 'Number of freshmen: ') }}
		{{ Form::input('number', 'number_of_freshmen', $course->number_of_freshmen, array('required' => 'required')) }}

		<br><br>

		{{ Form::label('number_of_sophomores', 'Number of sophomores: ') }}
		{{ Form::input('number', 'number_of_sophomores', $course->number_of_sophomores, array('required' => 'required')) }}

		<br><br>

		{{ Form::label('number_of_juniors', 'Number of juniors: ') }}
		{{ Form::input('number', 'number_of_juniors', $course->number_of_juniors, array('required' => 'required')) }}

		<br><br>

		{{ Form::label('number_of_seniors', 'Number of seniors: ') }}
		{{ Form::input('number', 'number_of_seniors', $course->number_of_seniors, array('required' => 'required')) }}

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

		{{ Form::submit('Update!') }}

	{{ Form::close() }}

@stop