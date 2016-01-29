@extends('layouts.viewbatch')
@section('BatchSchedule')
					<style> 
						
						th {
							width: 10%;
							color: #F8F8F8;
							background-color: rgba(50, 138, 79, 0.5);
							}
					</style>
@include('layouts.include.functions')
@include('layouts.adminview.batchschedulefunction')
						<?php
						use App\Department;
						use App\Time_table;
						use App\Course_detail;
						use App\Course;
						use App\User;
						use App\User_detail;
						use App\Group;
						
						
						echo "<br> The schedule for the <strong>Batch: ".$batch."( ".$department." ) </strong>is as follows: <br><br>";
						$batchcode = $batch;
						$routinedepart = array();
						$departcheck = Time_table::join('course_details','time_tables.course_code','=','course_details.id')->where('course_details.offered_to', $batch)->select('time_tables.department_code')->groupby('department_code')->get();
						foreach($departcheck as $departroutine)
						{
						array_push($routinedepart, $departroutine->department_code);
						}
						foreach($routinedepart as $block)
						{
						echo "<br> <h3>Department: ".$block." </h3> <br><br>";
						$batchschedule = Time_table::join('course_details','time_tables.course_code','=','course_details.id')->where('time_tables.department_code', $block)->where('course_details.offered_to', $batch)->select('time_tables.*')->orderby('time_tables.stime','ASC')->get();
						showbatchschedule($batchschedule, $batch, $department);
						
						?>
		</table>	
		<br>
		<table border='1'>
			<tr> 
				<td><span style='font-weight:bold'>Course Code</span></td>
				<td><span style='font-weight:bold'>Course Title</span></td>
				<td><span style='font-weight:bold'>Course Instructor</span></td>
				
			</tr>
			<?php
				
				$batchschedule = Time_table::join('course_details','time_tables.course_code','=','course_details.id')->where('time_tables.department_code', $block)->where('course_details.offered_to', $batch)->select('time_tables.*')->orderby('time_tables.stime','ASC')->get();
						
						
				foreach($batchschedule as $routine)
				{
				$course_code = Course_detail::where('id', $routine->course_code)->first()->course_code;
				$course_title = Course::where('course_code',$course_code)->first()->course_title;
				$offered_by = Course_detail::where('id', $routine->course_code)->first()->offered_by;
				$id = User::where('username',$offered_by)->first()->id;
						$userdetails = User_detail::where('id',$id)->first();
						$fullname = $userdetails->first_name." ".$userdetails->middle_name." ".$userdetails->last_name;
					if(str_replace(" ", "",$fullname) == null)
							$fullname = $offered_by;
					echo "<tr>";
					echo "<td>".$course_code."</td>";
					echo "<td>".$course_title."</td>";
					echo "<td>".$fullname."</td>";
					echo "</tr>";
				}
				
			?>
		
		</table>
						<?php
						}
						
						?>
						

@endsection
@stop

	
	
	
	