@extends('_master')

@section('title')
Quizical | Your Profile
@stop

@section('content')

	<h1>Your Profile</h1>

	<p><b>Your name: </b> {{ $user->first_name }} {{ $user->last_name }}</p>
	<p><b>Your school: </b> {{ $school->name }}</p>
	<p><b>Your email: </b> {{ $user->email }}</p>

	{{-- Edit button --}}
	{{ Form::open(array('route' => array('users.edit', $user->id), 'method' => 'get')) }}
		<button class="btn btn-warning btn-sm" href="/users/{{$user->id}}/edit">Edit</button>
	{{ Form::close() }}

@stop