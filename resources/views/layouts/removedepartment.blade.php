@extends('layouts.main')
@section('title')
KUSMS: Remove Department
@endsection
@section('headstyle')
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<script type="text/javascript" src="search_class.js"></script>
		<script type="text/javascript" src="include/enroll_student.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap-alert.js"></script>
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
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
				{!! Form::open(array('class'=>'form-horizontal', 'action'=>'DepartmentController@removedepartment', 'method'=>'post')) !!} 
							
						@if ($errors->has())
							<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									{{ $error }}<br>        
								@endforeach
							</div>
						@endif
						@if ($deletemsg != '')
							<div class="alert alert-success">
									{{ $deletemsg }}<br>        
							</div>
						@endif
						<?php
						use App\Department;
						$departmentinfo = Department::orderby('code')->lists('code','code');
						?>
						<fieldset>
						<legend>Select Department</legend>
						<div class="alert alert-block">
									{{ "Warning!" }}<br> 
									{{ "Deleting Department will delete records from all related entities." }}<br> 
									{{ "Even user records (teachers) will be deleted. Make sure you want to do it." }}<br>
							</div>
						<div class="control-group">
						{!! Form::label('departmentcode', 'Department Code:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::select('selectdepartmentcode', $departmentinfo) !!}
						</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Delete', ['class'=>'btn btn-primary','value'=>'removedepartment', 'name'=>'removedepartment']) !!}
						</div>
						</div>
						</fieldset>
						
						
				{!! Form::close() !!}
</div>
@endsection
@stop