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
			<a href="/">Quizical</a>
		</div>

		@if(Session::get('flash_message'))
			<div class="flash-message">
				{{ Session::get('flash_message') }}
			</div>
		@endif

		@yield('content')
	</body>

</html>
