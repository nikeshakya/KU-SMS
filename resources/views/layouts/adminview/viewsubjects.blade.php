@extends('layouts.main')
@section('title')
KUSMS: Subject Schedule
@endsection
@section('headstyle')
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap-alert.js"></script>
		<style type="text/css">
			#sidebar {
				border-right: 3px solid rgb(238,238,238);
				height: 400px;
			}
			.hero-unit
			{
				margin-bottom:0;	
			}
		</style>
@endsection

@section('navigation')
@include('layouts.include.nav_admin')
@endsection

@section('sidebar')
@include('layouts.include.adminsidebar')
@endsection

@section('bodycontent')
<div class = "span9">	
					{!! Form::open(array('action'=>'AdminScheduleController@viewsubjectschedule', 'method'=>'post')) !!} 
						<?php
						use App\Department;
						use App\User;
						use App\User_detail;
						use App\Group;
						use App\Course;
						use App\Course_detail;
						
						$id = User::where('username',$scheduleuser)->first()->id;
						$department = User_detail::where('id',$id)->first()->department;
						
						$subjects = Course_detail::where('offered_by',$scheduleuser)->groupby('course_code')->lists('course_code', 'course_code');
						?>
						<fieldset>
						<legend>Department: {{ $department }}</legend>
						<div class="control-group">
						{!! Form::label('subjectcode', 'Select Subject:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::select('selectsubject', $subjects) !!}
						</div>
						<div class="controls">
						{!! Form::hidden('teacherdepart', $department) !!}
						{!! Form::hidden('teachername', $scheduleuser) !!}
						</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Check Routine', ['class'=>'btn btn-primary','value'=>'showsubjectschedule', 'name'=>'showsubjectschedule']) !!}
						</div>
						</div>
						</fieldset>
					{!! Form::close() !!}
					@yield('SubjectSchedule')
						
</div>

@endsection
@stop

	
	
	
	