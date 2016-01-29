@extends('layouts.main')
@section('title')
KUSMS-Login
@stop
@section('bodycontent')
<div class="container">
			{!! Form::open(array('class'=>'form-horizontal','method'=>'post')) !!}
				@if ($errors->has())
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
						{{ $error }}<br>        
					@endforeach
				</div>
				@endif
				<fieldset>
					<legend>Please sign in</legend>
					<div class="control-group">
						{!! Form::label('username', 'Username:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::text('username', null, ['placeholder'=>'Enter your username']) !!}
						</div>
					</div>
					<div class="control-group">
						{!! Form::label('password', 'Password:', array('class' => 'control-label')) !!}
						<div class="controls">
							{!! Form::password('password') !!}
						</div>
					</div>
					<div class="control-group">
							<div class="controls">
								<div class="checkbox">
									{!! Form::checkbox('remember') !!}
									{!! Form::label('remember', 'Remember Me', array('class' => 'control')) !!}
										
				
								</div>
							</div>
						</div>
					<div class="control-group">
						<div class="controls">
							{!! Form::submit('Submit', ['class'=>'btn btn-primary','value'=>'login']) !!}
						</div>
					</div>
				</fieldset>
			{!! Form::close() !!}
</div>
@stop