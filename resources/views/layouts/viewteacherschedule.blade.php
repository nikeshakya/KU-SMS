@extends('layouts.main')
@section('title')
KUSMS: My Schedule
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
		<style> 
						
						th {
							color: #F8F8F8;
							background-color: rgba(50, 138, 79, 0.5);
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
@include('layouts.include.functions')
<div class = "span9">	
						<?php
						use App\User_detail;
						use App\User;
						use App\Time_table;
						use App\Course_detail;
						$id = User::where('username',$username)->first()->id;
						$userdetails = User_detail::where('id',$id)->first();
						$fullname = $userdetails->first_name." ".$userdetails->middle_name." ".$userdetails->last_name;
						?>
						<h2>{{'Department: '.$userdetails->department}}</h2>
						<?php
						if(str_replace(" ", "",$fullname) == null)
							$fullname = $username;
						$i=1;
						while($i<=6){
						${no2day($i)}=array();
						$i++;
						}
						//$teacherroutines = Time_table::where('course_code', Course_detail::where('offered_by', $username)->get())->orderby('stime', 'ASC')->get();
						$teacherroutines = Time_table::join('course_details','time_tables.course_code','=','course_details.id')->where('course_details.offered_by', $username)->select('time_tables.*')->orderby('time_tables.stime','ASC')->get();
						
						foreach($teacherroutines as $routine)
						{
							$stime=$routine->stime;
							$etime=$routine->etime;
							$room = $routine->room;
							$course_code = $routine->course_code;
							switch($routine->day)
							{
							case "Sunday":
								array_push($Sunday,array($course_code,$stime,$etime,$room));
								break;
							case "Monday":
								array_push($Monday,array($course_code,$stime,$etime,$room));
								break;
							case "Tuesday":
								array_push($Tuesday,array($course_code,$stime,$etime,$room));
								break;
							case "Wednesday":
								array_push($Wednesday,array($course_code,$stime,$etime,$room));
								break;
							case "Thursday":
								array_push($Thursday,array($course_code,$stime,$etime,$room));
								break;
							case "Friday":
								array_push($Friday,array($course_code,$stime,$etime,$room));
								break;
					
							}
						}
						$completeSchedule=array(${no2day(1)},${no2day(2)},${no2day(3)},${no2day(4)},${no2day(5)},${no2day(6)});
						$day=1;//To get the day SUnday,Monday by using thhe function
						?>
						
		<table style='width:95%' border='1'>
		  <tr>
			<td align='center'><span style='font-weight:bold'><?php echo "Instructor: ".$fullname; ?></span></td>
			<?php
				$slot=0;
				$time=7;
				$step=1;//TO make it flexible for half hour slot and hour slot
				$total_classes=9;
				
				while($slot<($total_classes/$step)){
					$slot_period=(string)$time." - ".((string)$time+$step);
					echo "<td align='center' width='7%'><span style='font-weight:bold'>".$slot_period."</span></td>";
					$time=$time+$step;
					$slot++;
				}
			?>
		  </tr>
		  <?php
	
			$i=1;
			foreach($completeSchedule as $b){
				echo "<tr>";
				echo "<td align='center' width='10%'><span style='font-weight:bold'>".no2day($i)."</span></td>";
				$i++;
				$old_stime=7;
				$old_etime=7;
				foreach ($b as $a) {
					$course=$a[0];
					$course_code = Course_detail::where('id',$course)->first()->course_code;
					$batch = Course_detail::where('id',$course)->first()->offered_to.'( '.Course_detail::where('id',$course)->first()->department_code.' )';
					$stime=$a[1];
					$etime=$a[2];
					$room = $a[3];
					
					if($stime==7){
						$fillslot=$etime-$stime;
						echo "<th colspan='".$fillslot."'>".$course_code."<br> Batch: ".$batch."<br> Room: ".$room."</th>";
					}
					else if($stime>7 && $old_etime==7){
						$fillslot=$stime-$old_etime;
						while($fillslot!=0){
							echo "<td></td>";
							$fillslot--;
						}
						$fillslot=$etime-$stime;
						echo "<th colspan='".$fillslot."'>".$course_code."<br> Batch: ".$batch."<br> Room: ".$room."</th>";
					}
					else{//Second class of the day
						if($stime==$old_etime){
							$fillslot=$etime-$stime;
							echo "<th colspan='".$fillslot."'>".$course_code."<br> Batch: ".$batch."<br> Room: ".$room."</th>";
						}
						else if($stime>$old_etime){
							$fillslot=$stime-$old_etime;
							while($fillslot!=0){
								echo "<td></td>";
								$fillslot--;
							}
							$fillslot=$etime-$stime;
							echo "<th colspan='".$fillslot."'>".$course_code."<br> Batch: ".$batch."<br> Room: ".$room."</th>";
							}
					}
					
					
					$old_stime=$stime;
					$old_etime=$etime;
				}
				if($old_etime!=16){
					$fillslot=16-$old_etime;
					while($fillslot!=0){
						echo "<td></td>";
						$fillslot--;
					}
				}
				
				echo "</tr>";
			}
			
			
			?>

		  
		  
		</table>	
	
						
						
</div>

@endsection
@stop

	
	
	
	