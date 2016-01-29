<!DOCTYPE html>
<html lang="en">
	<head>
		<title>
		TEST YOUR KNOWLEDGE
		</title>
		<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/css/form.css') }}" rel="stylesheet" type="text/css" />
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
	</head>
	
	<body>
		<div class="hero-unit">
			<hgroup>
				<h1>Kathmandu University</h1>
				<h3>Schedule Management System</h3>
			</hgroup>
		</div>
		
									<div class = "row-fluid">
							<div class="navbar">
						
								<div class="navbar-inner">
									<ul class="nav">
										
										<li class="divider-vertical"></li>
										<li class="dropdown">
										<a href="home" class="dropdown-toggle">Class</a>
											<ul class="dropdown-menu">
												<li><a href="viewclass">View Class</a></li>
												<li><a href="addclass">Add Class</a></li>
												<li><a href="class1.php?action=req_sch">Request/Update Schedule</a></li>
												
												
												<li><a href="class1.php?action=withdraw">Withdraw Class</a></li>
												
											</ul>
										</li>
										<li class="divider-vertical"></li>
										<li class="dropdown">
										<a href="home" >Schedules</a>
											<ul class="dropdown-menu">
												<li><a href="class1.php?action=viewMySchedule">My Schedule</a></li>
												
												<li><a href="class1.php?action=viewSubjectSchedule">Subject Wise Schedule</a></li>
												<li><a href="class1.php?action=viewBatchSchedule">Batch Wise Schedule</a></li>
												<li><a href="class1.php?action_view=view">Room Schedule</a></li>
												
												
											</ul>
										</li>
										<li class="divider-vertical"></li>
										<li class="dropdown">
										<a href="home" class="dropdown-toggle">Setting</a>
											<ul class='dropdown-menu'>
												<li><a href="changepassword">Change password </a></li>
												<li><a href="editprofile">Change Personal Information</a></li>
											</ul>
										</li>
										
										
										<li class="divider-vertical"></li>
										
										
								
										
									</ul><!--end of nav menu-->
									
									<ul class='nav pull-right'>
									<!--<li class=\"divider-vertical\"></li>
										<p class=\"navbar-text pull-right\"><a href=\"auth/logout\">Logout</a></p> -->
										<li class='divider-vertical'><a href='auth/logout'>Logout</a></li>
										<li class='divider-vertical'><p class='navbar-text'>Logged in as {{ $username }}</p></li>
									</ul>
								</div><!--end of navbar - inner-->
							</div><!--end of navbar-->

					<div class = "row-fluid">
			<div class="span3" id="sidebar">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span14">
						  <div class="well sidebar-nav">
							<ul class="nav nav-list">
							  	<li class="nav-header">Working Days</li>
							  	
									
									<li><a href='class1.php?action=req_sch#Sunday'>Sunday</a></li>
									<li><a href='class1.php?action=req_sch#Monday'>Monday</a></li>
									<li><a href='class1.php?action=req_sch#Tuesday'>Tuesday</a></li>
									<li><a href='class1.php?action=req_sch#Wednesday'>Wendesday</a></li>
									<li><a href='class1.php?action=req_sch#Thursday'>Thursday</a></li>
									<li><a href='class1.php?action=req_sch#Friday'>Friday</a></li>
									@include('layouts.include.freeRoomChecker')
							<?php 
							$workingDays=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday");
							foreach($workingDays as $days)
							{
							$MAX = 3;
							?>
								<li class="nav-header">Free Time Slot for <?php echo $days; ?></li>
									<?php 
									$i=1;
									while($i<=$MAX){
									?>
										<li><a name="<?php echo $days; ?>">Room <?php echo $i; ?> Free time <?php echo $days; ?></a></li>
										<?php
											$free=checkFreeTime($days,$i);
											if(empty($free)){
												echo "No Classes registered.";
											}
											else
											{
											foreach ($free as $t) {
												echo array_values($t)[0]."-".array_values($t)[1]."<br>";
												/*echo "<br>Start TIme: " . array_values($t)[0];
												echo "<br>End TIme: " . array_values($t)[1]."<br>";*/
											}
										}	//END of ELSE of the if empty checking part
										$i++;
									}//End of while loop fpr Rooms
								}//End of foreach loop for the workingDays
										?>
								
							  
							  	
							  	
							</ul>
						  </div><!--/.well -->
						</div><!--/span-->
				  	</div>
				</div>
			</div><!-- end of sidebar -->
		
			

		<div class = "span9">
						
						<legend>Course Available</legend>
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
								<td><a href="viewclass">{{ $offeredcourse->course_code }}</a></td>
								<td>{{ $coursedetail->course_title }}</td>
								<td>{{ $coursedetail->credit }}</td>
								<td>{{ $offeredcourse->offered_to }}</td>
							
						</tr>
						<?php
						$c++;
						?>
						@endforeach
				
              </tbody>
	</table>
						
</div>
		
		</div>
		<div class="footer" >
			<footer class="text-center">
				<strong><p>Developed for Department of Computer Science and Engineering</p>
				<p>School of Engineering</p>
				<p>Kathmandu University</p></strong>
				<p >This project is done by  Angel Shrestha,Biswash Dahal,Nikesh Shakya and Rohit Kapali,students of Kathmandu University,CS-4th year under the course Software Engineering under the curriculam of BE/BSc.</p>
			</footer>
		</div>
		</div>
	</body>
</html>