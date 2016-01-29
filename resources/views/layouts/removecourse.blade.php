@extends('layouts.main')
@section('title')
KUSMS: Remove Course
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
				{!! Form::open(array('class'=>'form-horizontal', 'action'=>'CourseController@removecourse', 'method'=>'post')) !!} 
						<div class="alert alert-block">
									{{ "Warning!" }}<br> 
									{{ "Deleting Course will delete records from all related entities." }}<br>  
						</div>
						@if ($errors->has())
							<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									{{ $error }}<br>        
								@endforeach
							</div>
						@endif
						@if($deletemsg != '')
							<div class="alert alert-success">
									{{ $deletemsg }}<br>        
							</div>
						@endif
						<?php
						use App\Course;
						$courseinfo = Course::orderby('course_code')->lists('course_code','course_code');
						?>
						<fieldset>
						<legend>Select Course</legend>
						<div class="control-group">
						{!! Form::label('coursecode', 'Course Code:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::select('selectcoursecode', $courseinfo) !!}
						</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Delete', ['class'=>'btn btn-primary','value'=>'removecourse', 'name'=>'removecourse']) !!}
						</div>
						</div>
						</fieldset>
						
						
				{!! Form::close() !!}
</div>
@endsection
@stop