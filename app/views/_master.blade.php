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
			<nav class="navbar navbar-default" role="navigation" id="navbar">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="navbar-collapse">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <span class="navbar-brand">Quizical</span>
					</div>

					<div class="collapse navbar-collapse" id="navbar-collapse">
						<ul class="nav navbar-nav">
							@if (Auth::check())
								<li><a href="/">Calendar</a></li>
								<li><a href="/courses">Your Courses</a></li>
								<li><a href="/users/{{Auth::user()->id}}">Your Profile</a></li>
								<li><a href="/logout">Logout</a></li>
							@else
								<li><a href="/">Home</a></li>
								<li><a href="/schools/create">School Signup</a></li>
								<li><a href="/users/create">Teacher Signup</a></li>
								<li><a href="/login">Login</a></li>
							@endif
						</ul>
					</div>
				</div>
			</nav>
		</div>

		@if(Session::get('flash_message'))
			<div class="alert {{ Session::get('alert_class', 'alert-info') }} alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				{{ Session::get('flash_message') }}
			</div>
		@endif

		{{-- If there are any errors with the input, give the user a warning --}}
		@if (count($errors) != 0)
			@foreach($errors->all() as $message)
				<div class="alert alert-danger alert-dismissable" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				{{ $message }} <br>
			</div>		
			@endforeach
		@endif

		@yield('content')
	</body>

</html>
