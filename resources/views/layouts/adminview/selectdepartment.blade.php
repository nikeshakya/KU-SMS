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
						$departements = Department::orderby('code')->lists('code','code');
						
						?>
						<fieldset>
						<legend>Batch-wise Schedule</legend>
						<div class="control-group">
						{!! Form::label('departmentcode', 'Select Department:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::select('selectdepartment', $departements) !!}
						</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Select', ['class'=>'btn btn-primary','value'=>'showdepartbatch', 'name'=>'showdepartbatch']) !!}
						</div>
						</div>
						</fieldset>
					{!! Form::close() !!}
					
						
</div>

@endsection
@stop

	
	
	
	