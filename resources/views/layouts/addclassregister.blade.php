@extends('layouts.main')
@section('title')
KUSMS: Offer Course
@endsection
@section('headstyle')
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
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
@include('layouts.include.nav_teachers')
@endsection

@section('sidebar')
@include('layouts.include.sidebar')
@endsection

@section('bodycontent')
<div class="span9">
				{!! Form::open(array('class'=>'form-horizontal', 'action'=>'CourseDetailController@addclass', 'method'=>'post')) !!} 
						@if ($errors->has())
							<div class="alert alert-danger">
								@foreach($errors->all() as $error)
									{{ $error }}<br>        
								@endforeach
							</div>
						@endif
						<?php
						use App\Course;
						use App\Department;
						use App\Group;
						$courseinfo = Course::orderby('course_code')->lists('course_code','course_code');
						$value = Department::where('code', $departcode)->orderby('code')->first()->code;
						$groupinfo = Group::where('department',$value)->orderby('group_code')->lists('group_code','group_code');
						?>
						<fieldset>
						<legend>Select Course</legend>
						<div class="control-group">
						{!! Form::label('coursecode', 'Select Course:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::select('selectcoursecode', $courseinfo) !!}
						</div>
						</div>
						<div class="control-group">
						{!! Form::label('classcode', 'Offer to:', array('class' => 'control-label')) !!}
						<div class="controls">
						{!! Form::select('selectclass',$groupinfo, array('id' => 'selectclass')) !!}
						</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::hidden('departselected', $departcode) !!}
						</div>
						</div>
						<div class="control-group">
						<div class="controls">
							{!! Form::submit('Add Class', ['class'=>'btn btn-primary','value'=>'addclass', 'name'=>'addclass']) !!}
						</div>
						</div>
						</fieldset>
						
						
				{!! Form::close() !!}
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
/*$("#selectdepartment").on("change", function(){
  // This code will fire every time the user selects something
  var departmentselected = $(this).val();
  alert(departmentselected);
  makeAjaxRequest(departmentselected);
})

function makeAjaxRequest(departmentselected){
  $.ajax({
    type: "POST",
    data: '{ "departmentselected":"' + departmentselected + '" }',
	dataType: "json",
    url: "addclass",
    success: function(jsonarray) {
      // We'll put some code here in a minute
	 console.log(jsonarray);
	 displaygroup(jsonarray);
    }
  });
}

function displaygroup(jsonarray)
{
		var selectbox = document.getElementById('selectclass');
		 selectbox.length = 0;
		 for(i = 0; i < jsonarray.length; i++)
		 {
		 var opt = document.createElement('option');
		opt.value = jsonarray[i];
		opt.innerHTML =  jsonarray[i];
		selectbox.appendChild(opt);
		 }
}
function showgroup($value)
{


var mysql = require('mysql');
alert('a');
var connection = mysql.createConnection(
    {
      host     : 'localhost',
      user    : 'root',
      password : '',
      database : 'kusms',
    }
);

connection.connect();


query = connection.query("SELECT  group_code FROM groups WHERE department = '" + $value + "';");

    query
    .on('error', function(err) {
        console.log( err );

    })
    .on('result', function( data ) {
		alert(data);
         var selectbox = document.getElementById('selectdepartment');
		 selectbox.length = 0;
		 for(i = 0; i < data.length; i++)
		 {
		 var opt = document.createElement('option');
		opt.value = data[i];
		opt.innerHTML =  data[i];
		selectbox.appendChild(opt);
		 }
		
    });
}*/


</script>
@endsection
@stop

