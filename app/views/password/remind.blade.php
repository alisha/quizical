@extends('_master')

@section('content')
	<h1>Forgot your password?</h1>
	<br>
	<form action="{{ action('RemindersController@postRemind') }}" method="POST" class="form">
		<div class="row">
			<div class="form-group col-xs-4">
				<input type="email" name="email" placeholder="Email address" class="form-control">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Send reminder</button>
			</div>
		</div>
	</form>
@stop