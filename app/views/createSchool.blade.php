@extends('_master')

@section('content')

	<h1>School Sign Up</h1>

	<p>If you're a teacher and your school has already signed up, please go <a href="{{ URL::to('users/create') }}">here</a>.</p>
	<p>When you submit, you'll be given a school ID and passcode that will allow teachers to join your school's Quizical community. Please save these and give them to your teachers!</p>
	<p>All fields are required.</p>

	<br>

	{{ Form::open(array('action' => 'SchoolController@postCreate', 'class' => 'form-horizontal')) }}

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('name', 'School name:') }}
			</div>
				
			<div class="col-sm-10">
				{{ Form::text('name', '', array('required' => 'required', 'class' => 'form-control inputField')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('city', 'City:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('city', '', array('required' => 'required', 'class' => 'form-control inputField')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('state', 'State/province:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('state', '', array('required' => 'required', 'class' => 'form-control inputField')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('country', 'Country:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('country', '', array('required' => 'required', 'class' => 'form-control inputField')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Submit!', array('class' => 'btn btn-primary')) }}
			</div>
		</div>
		
	{{ Form::close() }}

@stop