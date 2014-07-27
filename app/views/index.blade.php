@extends('_master')

@section('content')
	@if (Auth::check())
		<p>Want to check out your <a href="courses">courses</a>?</p>
	@else
		<h1>Welcome to Quizical!</h1>
		<h2>Quizical lets high school teachers plan their tests and quizzes.</h2>
		<p>Get started by <a href="/school/new">signing up</a> today!</p>
	@endif
@stop