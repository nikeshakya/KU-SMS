@extends('layouts.main')
@section('title')
KUSMS: Offered Courses
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
<div class = "span9">	
						<?php
						use App\User_detail;
						use App\User;
						$id = User::where('username',$username)->first()->id;
						$userdetails = User_detail::where('id',$id)->first();
						$fullname = $userdetails->first_name." ".$userdetails->middle_name." ".$userdetails->last_name;
						if(str_replace(" ", "",$fullname) == null)
							$fullname = $username;
						?>
						<legend>{{ $fullname }}</legend>
						<p>These are the courses that you have registered for this academic semester:</p>
						<table class="table table-hover">
						<thead>
						<tr>
						<th>SN</th>
						<th>Course Code</th>
						<th>Course Title</th>
						<th>Credit</th>
						<th>Offered To</th>
                  
						</tr>
						</thead>
						<tbody>
						<?php
						use App\Course_detail;
						use App\Course;
						$offered_by= $username;
						$offeredcourses = Course_detail::where('offered_by', $offered_by)->orderby('course_code')->get();
						$c=1;
						
						?>
						@foreach($offeredcourses as $offeredcourse)
						<?php
						$coursedetail = Course::where('course_code', $offeredcourse->course_code)->first();
						?>
						<tr> 
								<td>{{ $c }} </td>	
								<td><a href="viewclass?courseselected=<?php echo $offeredcourse->id; ?>">{{ $offeredcourse->course_code }}</a></td>
								<td>{{ $coursedetail->course_title }}</td>
								<td>{{ $coursedetail->credit }}</td>
								<td>{{ $offeredcourse->offered_to }} ( {{ $offeredcourse->department_code }} )</td>
							
						</tr>
						<?php
						$c++;
						?>
						@endforeach
				
              </tbody>
	</table>
						
</div>

@endsection
@stop

	
	
	
	