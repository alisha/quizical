@extends('_master')

@section('content')
	<h1>Forgot your password?</h1>
	<br>
	<form action="{{ action('RemindersController@postRemind') }}" method="POST">
		<input type="email" name="email" placeholder="Email address">
		<input type="submit" value="Send reminder">
	</form>
@stop