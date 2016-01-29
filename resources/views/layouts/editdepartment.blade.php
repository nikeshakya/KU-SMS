@extends('layouts.main')
@section('title')
KUSMS: Edit Department
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
				{!! Form::open(array('id'=>'departedit','class'=>'form-horizontal', 'action'=>'DepartmentController@editdepartment','method'=>'post')) !!} 
						@if ($errors->has())
							<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									{{ $error }}<br>        
								@endforeach
							</div>
						@endif
						<?php
						use App\Department;
						$departmentinfo = Department::where('code', $departcode)->get()->first();
						$name = $departmentinfo->name;
						$rooms = $departmentinfo->total_rooms;
						?>
						<fieldset>
						<legend>Edit Department Details</legend>
						<div class="control-group">
						{!! Form::label('departmentcode', 'Department Code:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::text('departmentcode', $departcode, array('readonly'=> 'true')) !!}
						</div>
						</div>
						<div class="control-group">
						{!! Form::label('departmentname', 'Name:', array('class' => 'control-label')) !!}
						<div class="controls">
							{!! Form::text('departmentname',$name, ['readonly'=>'true']) !!}
						</div>
						</div>
						<div class="control-group">
						{!! Form::label('departmentrooms', 'Total available rooms:', array('class' => 'control-label')) !!}
						<div class="controls">
							{!! Form::number('departmentrooms', $rooms, ['min'=>'1', 'max'=>'8']) !!}
						</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Submit', ['class'=>'btn btn-primary','value'=>'editdetails', 'name' =>'editdetails']) !!}
						</div>
						</div>
						</fieldset>
						
						
				{!! Form::close() !!}
</div>

@endsection
@stop