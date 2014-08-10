@extends('_master')

@section('title')
@parent | New Message
@stop

@section('content')

	<h1>New Message <br>
	<small>All fields are required</small></h1>

	<br>

	{{ Form::open(array('route' => 'messages.store', 'class' => 'form-horizontal')) }}

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('teachers[]', 'Teachers:') }} <br>
				<span class="help-block">Hold the command button and click on a name to select multiple people</span>
			</div>

			<div class="col-sm-10">
				<select name="teachers[]" class="form-control" multiple>
					@foreach (User::where('school_id', '=', Auth::user()->school_id)->get() as $teacher)
						@if ($teacher->id != Auth::user()->id)
							<option value="{{$teacher->id}}">{{$teacher->first_name}} {{$teacher->last_name}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('subject', 'Subject:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::text('subject', '', array('class' => 'form-control', 'placeholder' => 'Subject')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2">
				{{ Form::label('text', 'Message:') }}
			</div>

			<div class="col-sm-10">
				{{ Form::textarea('text', '', array('class' => 'form-control', 'placeholder' => 'Message')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Send!', array('class' => 'btn btn-primary')) }}
			</div>
		</div>

	{{ Form::close() }}

@stop