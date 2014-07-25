@extends('_master')

@section('content')
<h1>Log in</h1>
<p>Don't have an account? <a href="/user/new">Sign up today!</a></p>

{{ Form::open(array('url' => '/login')) }}

	Email: {{ Form::text('email') }}

	<br>

	Password: {{ Form::password('password') }}

	<br>

	Remember me: {{ Form::checkbox('remember_me', '1') }}

	<br>

	{{ Form::submit('Log in') }}

{{ Form::close() }}
@stop