@extends('_master')

@section('content')

	<h1>School Sign Up</h1>
	<p>If you're a teacher and your school has already signed up, please go <a href="{{ URL::to('user/new') }}">here</a>.</p>
	<p>When you submit, you'll be given a school passcode that will allow teachers to join your school's Quizical community. Please save this passcode and give it to your teachers!</p>

	{{ Form::open(array('action' => 'SchoolController@postNew')) }}

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

		<br>

		{{ Form::submit('Submit!') }}
		
	{{ Form::close() }}

@stop