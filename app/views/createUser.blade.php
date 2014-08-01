@extends('_master')

@section('content')

	<h1>Teacher Sign Up</h1>
	<p>This should be completed by the school's teachers only. If you're a principal, or your school has not signed up yet, please go <a href="{{ URL::to('schools/create') }}">here</a>.</p>
	<p>Contact your school's principal or technology head if you do not know your school's ID or passcode.</p>
	<p>All fields are required.</p>

	<br>

	{{ Form::open(array('action' => 'UserController@postCreate', 'class' => 'form-horizontal')) }}

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('first_name', 'First name:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('first_name', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('last_name', 'Last name:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('last_name', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('email', 'Email:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::email('email', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('password', 'Password:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::password('password', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('schoolID', 'School ID:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'schoolID', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('passcode', 'School password:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::password('passcode', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Submit!', array('class' => 'btn btn-primary')) }}
			</div>
		</div>
		
	{{ Form::close() }}

@stop