@extends('layouts.main')
@section('title')
KUSMS: Reset Password
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
						@if ($errors->has())
							<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									{{ $error }}<br>        
								@endforeach
							</div>
						@endif						
				{!! Form::open(array('class'=>'form-horizontal', 'action'=>'UserController@resetpassword','method'=>'post')) !!} 
					<fieldset>
					<legend>Select account to reset password: </legend>
					<div class="control-group">
						
					{!! Form::label('username', 'Username:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					
             	<?php
						use App\User;
						$users = User::orderBy('username')->lists('username', 'username');
						
				?>
					{!! Form::select('selected_username',$users, null) !!} 
					</div>
						</div>
						<div class="control-group">
						
					{!! Form::label('newpassword', 'New Password: ', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::password('newpassword', array('required')) !!} 
					</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Reset', ['class'=>'btn btn-primary','value'=>'submit']) !!}
						</div>
						</div>
					</fieldset>
		{!! Form::close() !!}

</div>
@endsection
@stop