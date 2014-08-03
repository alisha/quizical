@extends('_master')

@section('content')
	<form action="{{ action('RemindersController@postReset') }}" method="POST">
	    <input type="hidden" name="token" value="{{ $token }}">
	    <input type="email" name="email" placeholder="Email address">
	    <input type="password" name="password" placeholder="New password">
	    <input type="password" name="password_confirmation" placeholder="Confirm new password">
	    <input type="submit" value="Reset Password">
	</form>
@stop