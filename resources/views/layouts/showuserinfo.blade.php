@extends('layouts.main')
@section('title')
KUSMS: Change Password
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
						//$user = User::where('username',$loggeduser)->get('username');
						
?>
<div class="container">
						@if ($errors->has())
							<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									{{ $error }}<br>        
								@endforeach
							</div>
						@endif						
				{!! Form::open(array('class'=>'form-horizontal', 'action'=>'UserController@edituserinfo','method'=>'post')) !!} 
					<fieldset>
					<legend>Change Password for <?php echo $loggeduser; ?></legend>
					<div class="control-group">
						
					{!! Form::label('username', 'Username:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::text('username', $loggeduser, array('readonly'=>'true')) !!} 
					</div>
						</div>
					<div class="control-group">
						
					{!! Form::label('oldpassword', 'Old-Password:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::password('oldpassword', array('required')) !!} 
					</div>
						</div>
						<div class="control-group">
						
					{!! Form::label('newpassword1', 'New-Password:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::password('newpassword1', array('required')) !!} 
					</div>
						</div>
						<div class="control-group">
						
					{!! Form::label('newpassword2', 'Confirm-Password:', array('class' => 'control-label')) !!} 	
					<div class="controls">
					{!! Form::password('newpassword2', array('required')) !!} 
					</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Confirm Change', ['class'=>'btn btn-primary','value'=>'submit']) !!}
						</div>
						</div>
					</fieldset>
		{!! Form::close() !!}

</div>
@endsection
@stop