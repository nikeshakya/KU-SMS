@extends('layouts.main')

@section('bodycontent')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        {!! Form::open(array('class'=>'form-horizontal', 'method'=>'post')) !!}
				
				<fieldset>
					<legend>Please sign up</legend>
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
							{!! Form::submit('Submit', ['class'=>'btn btn-primary','value'=>'login']) !!}
						</div>
					</div>
				</fieldset>
			{!! Form::close() !!}
    </div>

    <!-- TODO: Current Tasks -->
@endsection
