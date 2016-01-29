@extends('layouts.main')
@section('title')
KUSMS: Add Teacher
@endsection
@section('headstyle')
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<script type="text/javascript" src="search_class.js"></script>
		<script type="text/javascript" src="include/enroll_student.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
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
<div class="navbar">
						
								<div class="navbar-inner">
									<ul class="nav">
										
										<li class="divider-vertical"></li>
													<a href="home" >Back</a>
									</ul>
								</div>
</div>
@endsection

@section('sidebar')

@endsection

@section('bodycontent')
<div class="container">
				{!! Form::open(array('class'=>'form-horizontal', 'action'=>'UserController@registeruser','method'=>'post')) !!} 
						@if ($errors->has())
							<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									{{ $error }}<br>        
								@endforeach
							</div>
						@endif
						<fieldset>
						<?php
						use App\Department;
						$departmentinfo = Department::orderby('code')->lists('code','code');
						?>
						<legend>Register a teacher</legend>
						<div class="control-group">
						{!! Form::label('userdepartment', 'Department:', array('class' => 'control-label')) !!}
						<div class="controls">
							{!! Form::select('userdepartment', $departmentinfo) !!}
						</div>
						</div>
						<div class="control-group">
						{!! Form::label('username', 'Username:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::text('username', null, ['placeholder'=>'Enter new username']) !!}
						</div>
						</div>
						<div class="control-group">
						{!! Form::label('password', 'Password:', array('class' => 'control-label')) !!}
						<div class="controls">
							{!! Form::password('password') !!}
						</div>
						</div>
						<div class="control-group">
						{!! Form::label('re-password', 'Re-Enter Password:', array('class' => 'control-label')) !!}
						<div class="controls">
							{!! Form::password('password2') !!}
						</div>
						</div>
					
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Submit', ['class'=>'btn btn-primary','value'=>'register']) !!}
						</div>
						</div>
						</fieldset>
						
						
				{!! Form::close() !!}
</div>
@endsection
@stop