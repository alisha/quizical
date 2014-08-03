@extends('_master')

@section('title')
Quizical | Edit Your Profile
@stop

@section('content')

	<h1>Edit Your Profile</h1>

	{{ Form::model($user, array('method' => 'put', 'route' => array('users.update', $user->id), 'class' => 'form-horizontal')) }}

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('first_name', 'First name:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('first_name', $user->first_name, array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('last_name', 'Last name:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('last_name', $user->last_name, array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('email', 'Email:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::email('email', $user->email, array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('oldPassword', 'Current password:') }} <br>
				<span class="help help-block">Required if you want to update your password</span>
			</div>

			<div class="col-sm-10">
				{{ Form::password('oldPassword', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('newPassword', 'New password:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::password('newPassword', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('schoolID', 'School ID:') }} <br>
				<span class="help help-block">Enter a new school ID to switch schools.</span>
			</div>

			<div class="col-sm-10">
				{{ Form::input('number', 'schoolID', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('passcode', 'School password:') }} <br>
				<span class="help help-block">Enter a new school password to switch schools.</span>
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