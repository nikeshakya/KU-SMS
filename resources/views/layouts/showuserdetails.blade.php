@extends('layouts.main')
@section('title')
KUSMS: Edit Profile
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
<?php
						use App\User;
						use App\user_detail;
						//$user = User::where('username',$loggeduser)->get('username');
						$user = User::where('username',$loggeduser)->first();
						$id = $user->id;
						$details = user_detail::where('id',$id)->first();
						$first_name = $details->first_name;
						
?>
<div class="container">
						@if ($errors->has())
							<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									{{ $error }}<br>        
								@endforeach
							</div>
						@endif						
				{!! Form::open(array('class'=>'form-horizontal', 'action'=>'UserController@edituserdetails','method'=>'post')) !!} 
					<fieldset>
					<legend>Edit your personal details </legend>
					<div class="control-group">
						
					{!! Form::label('username', 'Username:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::text('username', $loggeduser, array('readonly'=>'true')) !!} 
					</div>
						</div>
					<div class="control-group">
						
					{!! Form::label('firstname', 'First Name:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::text('first_name', $first_name, array('placeholder'=>'Enter your first name')) !!} 
					</div>
						</div>
						<div class="control-group">
						
					{!! Form::label('middlename', 'Middle Name:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::text('middle_name', $details->middle_name, array('placeholder'=>'Enter your middle name')) !!} 
					</div>
						</div>
						<div class="control-group">
						
					{!! Form::label('lastname', 'Last Name:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::text('last_name', $details->last_name, array('placeholder'=>'Enter your last name')) !!} 
					</div>
						</div>
						<div class="control-group">
						
					{!! Form::label('emailid', 'Email ID:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::email('email_id', $details->email_id, array('placeholder'=>'yourid@xyz.com', 'pattern' => '^.+@[^\.].*\.[a-z]*')) !!} 
					</div>
						</div>
						<div class="control-group">
						
					{!! Form::label('address', 'Address:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::text('address', $details->address, array('placeholder'=>'Your address')) !!} 
					</div>
						</div>
						<div class="control-group">
						
					{!! Form::label('department', 'Department:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::text('department', $details->department, array('readonly'=>'true')) !!} 
					</div>
						</div>

						<div class="control-group">
						
					{!! Form::label('designation', 'Designation:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::text('designation', $details->designation, array('placeholder'=>'Your post')) !!} 
					</div>
						</div>
						<div class="control-group">
						
					{!! Form::label('confirmpassword', 'Confirm by Password: (For Security Purpose)', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::password('confirmpassword', array('required')) !!} 
					</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Submit', ['class'=>'btn btn-primary','value'=>'submit']) !!}
						</div>
						</div>
					</fieldset>
		{!! Form::close() !!}

</div>
@endsection
@stop