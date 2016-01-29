@extends('layouts.main')
@section('title')
KUSMS: Batch Schedule
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
					{!! Form::open(array('action'=>'AdminScheduleController@viewbatchschedule', 'method'=>'post')) !!} 
						<?php
						use App\Department;
						use App\User;
						use App\User_detail;
						use App\Group;
					
						$batch = Group::where('department', $department)->orderby('group_code')->lists('group_code','group_code');
						?>
						<fieldset>
						<legend>Department: {{ $department }}</legend>
						<div class="control-group">
						{!! Form::label('batchcode', 'Select Batch:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::select('selectbatch', $batch) !!}
						</div>
						<div class="controls">
						{!! Form::hidden('teacherdepart', $department) !!}
						</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Check Routine', ['class'=>'btn btn-primary','value'=>'showbatchschedule', 'name'=>'showbatchschedule']) !!}
						</div>
						</div>
						</fieldset>
					{!! Form::close() !!}
					@yield('BatchSchedule')
						
</div>

@endsection
@stop

	
	
	
	