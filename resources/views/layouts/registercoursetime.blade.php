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
@include('layouts.include.functions')
@section('bodycontent')

<div class = "span9">		
<?php
use App\Course_detail;
use App\Course;
use App\Schedule;

$course= $courseid;
$coursedetails = Course_detail::where('id', $course)->first();
$title = Course::where('course_code', $coursedetails->course_code)->first()->course_title;
?>
<h1>{{ $coursedetails->course_code }}</h1>
<p>Please enter the timings for the enrollment <strong>{{ $title }}</strong></p>
<p>Batch: <strong>{{ $coursedetails->offered_to }}</strong></p>
<p>Department: <strong>{{ $coursedetails->department_code }}</strong></p>
{!! Form::open(array('action'=>'CourseDetailController@offerclasstime', 'method'=>'post')) !!} 
					@if ($errors->has())
							<div class="alert alert-danger">
								@foreach($errors->all() as $error)
									{{ $error }}<br>        
								@endforeach
							</div>
						@endif
					<table class="table table-hover">
						<thead>
							<tr>
							  <th>SN</th>
							  <th>Day</th>
							  <th>Start Time</th>
							  <th>End Time</th>
							  <th>Select</th>
							</tr>
						</thead>
						
						<tbody>
							
							<?php
								$i=1;
								while($i<7)
								{
									$class_code=$course.no2day($i);	
									//echo $class_code."<br>";
									$listschedules = Schedule::where('class_id', $class_code);
							?>
							@if($listschedules->exists())
							<?php
							$listschedules = $listschedules->first();
							?>
							<tr>
							<td>{{ $i }}</td>		
							<td>{{ no2day($i) }}</td>					
							<td>
							<?php
							$starttimename = "starttime".no2day($i);
							$endtimename = "endtime".no2day($i);
							$checkboxvalue = no2day($i);
							?>
							{!! Form::number($starttimename, $listschedules->stime, ['step' => '1', 'min'=>'7', 'max'=>'16']) !!}
							</td>
							<td>
								{!! Form::number($endtimename, $listschedules->etime, ['step' => '1', 'min'=>'7', 'max'=>'16']) !!}
							</td>
							<td>
								{!! Form::checkbox('set[]', $checkboxvalue) !!}
							</td>
							<?php
							$i++;								
							?>
							</tr>
							@else
							<tr>
							<td>{{ $i }}</td>		
							<td>{{ no2day($i) }}</td>	
							<?php
							$starttimename = "starttime".no2day($i);
							$endtimename = "endtime".no2day($i);
							$checkboxvalue = no2day($i);
							?>							
							<td>
							{!! Form::number($starttimename, null, ['step' => '1', 'min'=>'7', 'max'=>'16']) !!}
							</td>
							<td>
								{!! Form::number($endtimename, null, ['step' => '1', 'min'=>'7', 'max'=>'16']) !!}
							</td>
							<td>
								{!! Form::checkbox('set[]', $checkboxvalue) !!}
							</td>
							<?php
							$i++;								
							?>
							</tr>
							@endif	
									
									
							<?php									
							}//END OF WHILE
							?>
						</tbody>
						
						{!! Form::hidden('code', $course) !!}
						
				</form>
				{!! Form::close() !!}	
				</table>
				<table>
				<tr>
							<td>
							{!! Form::submit('Offer Class', ['class'=>'btn btn-primary','value'=>'Enroll', 'name'=>'offer_classtime']) !!}
							{!! Form::submit('Remove Time', ['class'=>'btn btn-primary','value'=>'Enroll', 'name'=>'remove_classtime']) !!}
							</td>
						</tr>
				</table>
		
		
</div>
@endsection
@stop


	
	
	
	


