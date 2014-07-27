<!DOCTYPE HTML>
<html>

	<head>
		<title>
			@section('title')
				Quizical
			@show
		</title>
	</head>


	<body>
		<div class="header">
			<p><a href="/">Quizical</a>
			@if (Auth::check())
				 | <a href="/courses">All Courses</a>
				 | <a href="logout">Logout</a></p>
			@else
				 | <a href="/school/new">School Signup</a>
				 | <a href="/user/new">Teacher Signup</a>
				 | <a href="/login">Login</a></p>
			@endif
		</div>

		@if(Session::get('flash_message'))
			<div class="flash-message">
				{{ Session::get('flash_message') }}
			</div>
		@endif

		@yield('content')
	</body>

</html>
