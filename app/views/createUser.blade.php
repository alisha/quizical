@extends('_master')

@section('content')

	<h1>Teacher Sign Up</h1>
	<p>This should be completed by the school's teacher only. If you're a principal, or your school has not signed up yet, please go <a href="{{ URL::to('school/new') }}">here</a>.</p>

	{{ Form::open(array('action' => 'UserController@postNew')) }}

		{{ Form::label('first_name', 'First name:') }}
		{{ Form::text('first_name', '', array('required' => 'required')) }}

		<br>

		{{ Form::label('last_name', 'Last name:') }}
		{{ Form::text('last_name', '', array('required' => 'required')) }}

		<br>

		{{ Form::label('email', 'Email:') }}
		{{ Form::email('email', '', array('required' => 'required')) }}

		<br>

		{{ Form::label('password', 'Password:') }}
		{{ Form::password('password', '', array('required' => 'required')) }}

		<br>

		{{ Form::label('passcode', 'School passcode (from your principal):') }}
		{{ Form::password('passcode', '', array('required' => 'required')) }}

		<br>

		{{ Form::submit('Submit!') }}
		
	{{ Form::close() }}

@stop