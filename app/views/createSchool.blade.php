@extends('_master')

@section('content')

	<h1>School Sign Up</h1>
	<p>This should be completed by the school's principal only. If you're a teacher and your school has already signed up, please go <a href="{{ URL::to('user/new') }}">here</a>.</p>

	{{ Form::open(array('action' => 'SchoolController@postNew')) }}

		<h2>About the School</h2>

		{{ Form::label('name', 'School name:') }}
		{{ Form::text('name', '', array('required' => 'required')) }}

		<br>

		{{ Form::label('city', 'City:') }}
		{{ Form::text('city', '', array('required' => 'required')) }}

		<br>

		{{ Form::label('state', 'State/province:') }}
		{{ Form::text('state', '', array('required' => 'required')) }}

		<br>

		{{ Form::label('country', 'Country:') }}
		{{ Form::text('country', '', array('required' => 'required')) }}

		<h2>About the Principal</h2>
		<p>Principals are able to view all tests/quizzes, and approve a teacher's request to join the school on Quizical.</p>

		{{ Form::label('first_name', 'First name:') }}
		{{ Form::text('first_name', '', array('required' => 'required')) }}

		<br>

		{{ Form::label('last_name', 'Last name:') }}
		{{ Form::text('last_name', '', array('required' => 'required')) }}

		<br>

		{{ Form::label('name', 'School name:') }}
		{{ Form::text('name', '', array('required' => 'required')) }}

		<br>

		{{ Form::label('email', 'Email:') }}
		{{ Form::email('email', '', array('required' => 'required')) }}

		<br>

		{{ Form::label('password', 'Password:') }}
		{{ Form::password('password', '', array('required' => 'required')) }}

		<br>

		{{ Form::submit('Submit!') }}
		
	{{ Form::close() }}

@stop