				<div class="span3" id="sidebar">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span14">
						  <div class="well sidebar-nav">
							<ul class="nav nav-list">
							  	<li class="nav-header">Working Days</li>
							  	
									
									<li><a href='#Sunday'>Sunday</a></li>
									<li><a href='#Monday'>Monday</a></li>
									<li><a href='#Tuesday'>Tuesday</a></li>
									<li><a href='#Wednesday'>Wendesday</a></li>
									<li><a href='#Thursday'>Thursday</a></li>
									<li><a href='#Friday'>Friday</a></li>
									@include('layouts.include.freeRoomChecker')
							<?php 
							use App\Department;
							use App\User;
							use App\User_detail;
							$userdepartment = User_detail::where('id',User::where('username',$username)->first()->id)->first()->department;
							$MAX = Department::where('code',$userdepartment)->first()->total_rooms;
							$workingDays=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday");
							foreach($workingDays as $days)
							{
							?>
								<li class="nav-header">Free Time Slot for <?php echo $days; ?></li>
									<?php 
									$i=1;
									while($i<=$MAX){
									?>
										<li><a name="<?php echo $days; ?>">Room <?php echo $i; ?> Free time <?php echo $days; ?></a></li>
										<?php
											$free=checkFreeTime($days,$i,$userdepartment);
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
		
			
