@extends('_master')

@section('head')
	@parent
	{{--<link rel="stylesheet" href="{{app.path.'vendor/css/calendar.css' }}">--}}
@stop

@section('content')
	@if (Auth::check())
		<p>Want to check out your <a href="courses">courses</a>?</p>
	@else
		<h1>Welcome to Quizical!</h1>
		<h2>Quizical lets high school teachers plan their tests and quizzes.</h2>
		<h2>Get started by <a href="/schools/create">signing up</a> today!</h2>
	@endif
@stop