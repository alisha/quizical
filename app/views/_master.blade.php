<!DOCTYPE HTML>
<html>

	<head>
		@section('head')
			<title>
				@section('title')
					Quizical
				@show
			</title>

			<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
			<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
			<script type="text/javascript" src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
		@show
	</head>


	<body>
		<div class="header">
			<ul class="nav nav-tabs" role="tablist">
			<li><a href="/">Quizical</a></li>
			@if (Auth::check())
				<li><a href="/courses">All Courses</a></li>
				<li><a href="/logout">Logout</a></li>
			@else
				<li><a href="/schools/create">School Signup</a></li>
				<li><a href="/users/create">Teacher Signup</a></li>
				<li><a href="/login">Login</a></li>
			@endif
		</div>

		@if(Session::get('flash_message'))
			<div class="alert {{ Session::get('alert_class', 'alert-info') }} alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				{{ Session::get('flash_message') }}
			</div>
		@endif

		@yield('content')
	</body>

</html>
