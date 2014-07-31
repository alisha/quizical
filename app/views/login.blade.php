@extends('_master')

@section('content')
<h1>Log in</h1>
<p>Don't have an account? <a href="/user/new">Sign up today!</a></p>

<br>

{{ Form::open(array('url' => '/login', 'class' => 'form-horizontal')) }}

	<div class="form-group">
		<div class="col-sm-1">
			{{ Form::label('email', 'Email: ') }}
		</div>
		<div class="col-sm-10">
			{{ Form::text('email', '', array('class' => 'form-control inputField')) }}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-1">
			{{ Form::label('password', 'Password: ') }}
		</div>
		<div class="col-sm-10">
			{{ Form::password('password', array('class' => 'form-control inputField')) }}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-1 col-sm-10">
			{{ Form::checkbox('remember_me', '1', array('class' => 'form-control inputField')) }}
			Remember me
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-1 col-sm-10">
			{{ Form::submit('Log in', array('class' => 'btn btn-primary btn-form')) }}
		</div>
	</div>

{{ Form::close() }}
@stop