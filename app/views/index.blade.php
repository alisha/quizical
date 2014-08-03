@extends('_master')

@section('head')
	@parent
@stop

@section('content')
	@if (Auth::check())
		<h1>Upcoming Assessments in Your School</h1>
		<br>
		{{ Calendar::make()->setDate(Input::get('cdate'))->setEvents($assessments)->setTableClass('table table-calendar month table-striped table-bordered')->generate() }}
	@else
		<h1>Welcome to Quizical!</h1>
		<h3>Quizical lets high school teachers plan their tests and quizzes.</h3>
		<h3>Get started by <a href="/schools/create">signing up</a> today!</h3>
	@endif
@stop