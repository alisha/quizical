@extends('_master')

@section('content')
<h1>Log in</h1>
<p>Don't have an account? <a href="/user/new">Sign up today!</a></p>

<br>

{{ Form::open(array('url' => '/login', 'class' => 'form-horizontal', 'role' => 'form')) }}

	<div class="form-group">
		{{ Form::label('email', 'Email: ', array('class' => 'col-sm-2 control-label', 'for' => 'email')) }}
		<div class="col-sm-10">
			<div class="col-xs-4">
				{{ Form::text('email', '', array('class' => 'form-control')) }}
			</div>
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Password: ', array('class' => 'col-sm-2 control-label', 'for' => 'password')) }}
		<div class="col-sm-10">
			<div class="col-xs-4">	
				{{ Form::password('password', array('class' => 'form-control')) }}
				<br>
				<a href="/password/remind">Forgot your password?</a>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<div class="col-xs-4">	
				{{ Form::checkbox('remember_me', '1', array('class' => 'form-control')) }} Remember me
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<div class="col-xs-4">	
				{{ Form::submit('Log in', array('class' => 'btn btn-primary btn-form')) }}
			</div>
		</div>
	</div>

{{ Form::close() }}
@stop