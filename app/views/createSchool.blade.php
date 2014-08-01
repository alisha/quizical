@extends('_master')

@section('content')

	<h1>School Sign Up</h1>

	<p>If you're a teacher and your school has already signed up, please go <a href="{{ URL::to('users/create') }}">here</a>.</p>
	<p>When you submit, you'll be given a school ID. Please save this and give it, along with your school password, to your teachers!</p>

	<br>

	{{ Form::open(array('action' => 'SchoolController@postCreate', 'class' => 'form-horizontal')) }}

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('name', 'School name:') }} <br>
				<span class="help-block">Required</span>
			</div>
				
			<div class="col-sm-10">
				{{ Form::text('name', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('city', 'City:') }} <br>
				<span class="help-block">Required</span>
			</div>

			<div class="col-sm-10">
				{{ Form::text('city', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('state', 'State/province:') }} <br>
				<span class="help-block">Required for those in the US or Canada</span>
			</div>

			<div class="col-sm-10">
				{{ Form::text('state', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('country', 'Country:') }} <br>
				<span class="help-block">Required</span>
			</div>

			<div class="col-sm-10">
				{{ Form::text('country', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('email', 'Contact email:') }} <br>
				<span class="help-block">Required. We'll use this to contact you if you forget your password.</span>
			</div>

			<div class="col-sm-10">
				{{ Form::email('email', '', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('password', 'Password:') }}
				<span class="help-block">Required. Please make this secure so that your students cannot guess what it is.</span>
			</div>

			<div class="col-sm-10">
				{{ Form::password('password', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Submit!', array('class' => 'btn btn-primary')) }}
			</div>
		</div>
		
	{{ Form::close() }}

@stop