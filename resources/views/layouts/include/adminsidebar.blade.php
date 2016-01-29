				<div class="span3" id="sidebar">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span14">
						  <div class="well sidebar-nav">
						  <li class="nav-header">Departments with active routine</li>
							<?php
							use App\Schedule;
							use App\Department;
							$routineval = 0;
							$departments = Department::orderby('code')->get();
							
							foreach($departments as $department)
							{
							$schedules = Schedule::where('department_code',$department->code);
							if($schedules->exists())
							{
							$routineval = 1;
							?>
							<li><a href='home?depart=<?php echo $department->code;?>'>{{ $department->code }}</a></li>
							<?php
							}
							}
							?>
							@if($routineval == 0)
							<li>No Schedule added yet. </li>
							@endif
						  </div><!--/.well -->
						</div><!--/span-->
				  	</div>
				</div>
			</div><!-- end of sidebar -->
		
			
