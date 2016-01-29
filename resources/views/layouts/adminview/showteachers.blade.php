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
						use App\User;
						$users = User::where('utype', 0)->orderby('username')->lists('username','username');
						
						?>
						<fieldset>
						<legend>Subject-wise Schedule (Teacher-wise course)</legend>
						<div class="control-group">
						{!! Form::label('username', 'Select Teacher:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::select('selectuser', $users) !!}
						</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Select', ['class'=>'btn btn-primary','value'=>'showteachercourses', 'name'=>'showteachercourses']) !!}
						</div>
						</div>
						</fieldset>
					{!! Form::close() !!}
						
</div>

@endsection
@stop

	
	
	
	