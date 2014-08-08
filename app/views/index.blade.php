@extends('_master')

@section('head')
	@parent
@stop

@section('content')
	@if (Auth::check())
		<h1>Upcoming Assessments in Your School</h1>
		<br>
		<div class="row">
			<div class="col-sm-9">
				{{ Calendar::make()->setDate(Input::get('cdate'))->setEvents($assessments)->setTableClass('table table-calendar month table-striped table-bordered')->generate() }}
			</div>
			<div class="col-sm-3">
				<h2>Filter</h2>
				{{ Form::open(array('url' => '/', 'method' => 'get')) }}
					<div class="col-sm-6">
						<h4>Grades</h4>
						{{ Form::checkbox('grade[]', '9', (in_array('9', $data['grade']) ? true : false)) }} 9 <br>
						{{ Form::checkbox('grade[]', '10', (in_array('10', $data['grade']) ? true : false)) }} 10 <br>
						{{ Form::checkbox('grade[]', '11', (in_array('11', $data['grade']) ? true : false)) }} 11 <br>
						{{ Form::checkbox('grade[]', '12', (in_array('12', $data['grade']) ? true : false)) }} 12 <br><br>
						<h4>Level</h4>
						{{ Form::checkbox('level[]', 'Foundations', (in_array('Foundations', $data['level']) ? true : false)) }} Foundations <br>
						{{ Form::checkbox('level[]', 'College Prep', (in_array('College Prep', $data['level']) ? true : false)) }} College Prep <br>
						{{ Form::checkbox('level[]', 'Honors', (in_array('Honors', $data['level']) ? true : false)) }} Honors <br>
						{{ Form::checkbox('level[]', 'Advanced Placement', (in_array('Advanced Placement', $data['level']) ? true : false)) }} Advanced Placement <br><br>
						{{ Form::submit('Filter', array('class' => 'btn btn-primary')) }}
					</div>
					<div class="col-sm-6">
						<h4>Departments</h4>
						{{ Form::checkbox('department[]', 'Math', (in_array('Math', $data['department']) ? true : false)) }} Math <br>
						{{ Form::checkbox('department[]', 'Science', (in_array('Science', $data['department']) ? true : false)) }} Science <br>
						{{ Form::checkbox('department[]', 'English', (in_array('English', $data['department']) ? true : false)) }} English <br>
						{{ Form::checkbox('department[]', 'History/Social Studies', (in_array('History/Social Studies', $data['department']) ? true : false)) }} History/Social Studies <br>
						{{ Form::checkbox('department[]', 'Foreign Languages', (in_array('Foreign Languages', $data['department']) ? true : false)) }} Foreign Languages <br>
						{{ Form::checkbox('department[]', 'Guidance and Support', (in_array('Guidance and Support', $data['department']) ? true : false)) }} Guidance and Support <br>
						{{ Form::checkbox('department[]', 'Health and Wellness', (in_array('Health and Wellness', $data['department']) ? true : false)) }} Health and Wellness <br>
						{{ Form::checkbox('department[]', 'Art', (in_array('Art', $data['department']) ? true : false)) }} Art <br>
						{{ Form::checkbox('department[]', 'Other', (in_array('Other', $data['department']) ? true : false)) }} Other <br>
					</div>
				{{ Form::close() }}
			</div>
		</div>
	@else
		<h1>Quizical</h1>
		<h3>The first web app for high school teachers to plan tests and quizzes</h3>
		<h3>Get started by <a href="/schools/create">signing up</a> today!</h3>
		<br>
		<p>Schools, <a href="#">forgot your password?</a></p>
	@endif
@stop