<!DOCTYPE html>
<html lang="en">
	<head>
		<title>
		@yield('title')
		</title>
		<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/css/form.css') }}" rel="stylesheet" type="text/css" />
		@yield('headstyle')
	</head>
	
	<body>
		<div class="hero-unit">
			<hgroup>
				<h1>Kathmandu University</h1>
				<h3>Schedule Management System</h3>
			</hgroup>
		</div>
		<div class = "row-fluid">
		@yield('navigation')
		<div class = "row-fluid">
		@yield('sidebar')
		@yield('bodycontent')
		
		</div>
		<div class="footer" >
			<footer class="text-center">
				<strong><p>Developed for Department of Computer Science and Engineering</p>
				<p>School of Engineering</p>
				<p>Kathmandu University</p></strong>
				<p>This project was originally started by Anish Byanjakar and team (DoCSE passed out students).</p>
				<p>This is the extended project done by  Angel Shrestha,Biswash Dahal,Nikesh Shakya and Rohit Kapali,students of Kathmandu University,CS-4th year under the course Software Engineering under the curriculam of BE/BSc.</p>
			</footer>
		</div>
		</div>
	</body>
</html>