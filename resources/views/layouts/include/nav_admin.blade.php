							<div class="navbar">
						
								<div class="navbar-inner">
									<ul class="nav">
										
										<li class="divider-vertical"></li>
										<li class="dropdown">
										<a href="home" class="dropdown-toggle">Users</a>
											<ul class="dropdown-menu">
												<li><a href="adduser">Add user</a></li>
												<li><a href="deleteuser">Delete User</a></li>
												<li><a href="resetpassword">Reset Password</a></li>
												
											</ul>	
										</li>
										<li class="divider-vertical"></li>
										<li class="dropdown">
										<a href="home" class="dropdown-toggle">Department</a>
											<ul class="dropdown-menu">
												<li><a href="adddepartment">Add Department</a></li>
												<li><a href="editdepartment">Edit Department Details</a></li>
												<li><a href="removedepartment">Delete Department</a></li>
												<li><a href="addgroup">Add Group</a></li>
												<li><a href="deletegroup">Delete Group</a></li>
												
											</ul>	
										</li>
										<li class="divider-vertical"></li>
										<li class="dropdown">
										<a href="home" class="dropdown-toggle">Course</a>
											<ul class="dropdown-menu">
												<li><a href="addcourse">Add Course</a></li>
												<li><a href="removecourse">Remove Course</a></li>
												
											</ul>	
										</li>
										<li class="divider-vertical"></li>
										<li class="dropdown">
										<a href="departmentschedule" class="dropdown-toggle">Schedule</a>
											<ul class="dropdown-menu">
												<li><a href="departmentschedule">Department-wise Schedule</a></li>
												<li><a href="instructorschedule">Instructor-wise Schedule</a></li>
												<li><a href="courseschedule">Course-wise Schedule</a></li>
												<li><a href="groupschedule">Batch-wise Schedule</a></li>
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
