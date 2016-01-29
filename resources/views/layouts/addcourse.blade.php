@extends('layouts.main')
@section('title')
KUSMS: Add Course
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
				{!! Form::open(array('class'=>'form-horizontal', 'action'=>'CourseController@registercourse','method'=>'post')) !!} 
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
						<legend>Register a Course</legend>
						<div class="control-group">
						{!! Form::label('course_code', 'Course Code:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::text('course_code', null, ['placeholder'=>'Enter code (eg. COMP 101)', 'required']) !!}
						</div>
						</div>
						<div class="control-group">
						{!! Form::label('coursename', 'Name:', array('class' => 'control-label')) !!}
						<div class="controls">
							{!! Form::text('coursename', null, ['placeholder'=>'Enter Course Name', 'required']) !!}
						</div>
						</div>
						<div class="control-group">
						{!! Form::label('coursecredit', 'Course credit:', array('class' => 'control-label')) !!}
						<div class="controls">
							{!! Form::number('coursecredit', 1, ['required', 'min'=>'1', 'max'=>'4']) !!}
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