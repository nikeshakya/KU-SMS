@extends('layouts.main')
@section('title')
KUSMS: Add Class Group
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
<?php
use App\Course;
						use App\Department;
						$departmentinfo = Department::orderby('code')->lists('code','code');
?>
@section('bodycontent')
<div class="container">
				{!! Form::open(array('class'=>'form-horizontal', 'action'=>'GroupController@addgroup','method'=>'post')) !!} 
						@if ($errors->has())
							<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									{{ $error }}<br>        
								@endforeach
							</div>
							
						@endif
						@if($registermsg != "")
							<div class ="alert alert-success">
								{{ $registermsg }}<br>  
							</div>
						@endif
						<fieldset>
						<legend>Register a Group</legend>
						<div class="control-group">
						{!! Form::label('group_code', 'Group Code:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::text('group_code', null, ['placeholder'=>'Enter code (eg. CS)', 'required']) !!}
						</div>
						</div>
						<div class="control-group">
						{!! Form::label('group_name', 'Name:', array('class' => 'control-label')) !!}
						<div class="controls">
							{!! Form::text('group_name', null, ['placeholder'=>'Computer Science', 'required']) !!}
						</div>
						</div>
						<div class="control-group">
						{!! Form::label('groupdepartment', 'Department:', array('class' => 'control-label')) !!}
						<div class="controls">
							{!! Form::select('groupdepartment', $departmentinfo) !!}
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