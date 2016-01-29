@include('layouts.adminalgo.algofunctions')
@include('layouts.adminalgo.algovariables')
@include('layouts.adminalgo.algoclass')
@include('layouts.adminalgo.insertionSort')
@include('layouts.adminalgo.ASP_Algo')
@include('layouts.adminalgo.algomain')
<style> 
						
						nu {
							color: #FF0000;
							}
</style>
<?php	
	use App\Department;
	use App\Schedule;
	use App\Time_table;
	if(isset($_GET['depart']))
	{
		$department = Department::where('code', $_GET['depart'])->first();
		$weekdays=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');
		$scheduledata = Schedule::where('department_code',$department->code);
		if($scheduledata->exists())
		{
		echo "<h1>Department: ".$department->code."</h1><br>";
		}
		foreach($weekdays as $a)
		{	
		//echo "<h2>Routine for: ".strtoupper($a)."</h2><br>";
		main_func($a, $department);
		
		}
		echo "<br><br>";
	}
	else
	{
	echo "<h1> Hello ".$username."  </h1>";
	
	$totalschedules = count(Schedule::all());
	$totaltimetables = count(Time_table::all());
	if( ($totalschedules > 0) && ($totaltimetables != $totalschedules) )
	{
	echo "<p> You have <strong><nu>new update(s)</nu></strong>. The following are departments that have been recently updated: </p><br>";
	$departs = Department::orderby('code')->get();
	foreach($departs as $depart)
	{
	$schedulecount = count(Schedule::where('department_code',$depart->code)->get());
	if($schedulecount > 0)
	{
	$timetablecount = count(Time_table::where('department_code',$depart->code)->get());
	if($schedulecount != $timetablecount)
	{
	?>
	<a href='home?depart=<?php echo $depart->code;?>'> <nu>{{ $depart->code }} </nu></a>
	
	<?php
	}
	}
	
	
	}
	}
	
	else
	echo "<p> The routines are all up to date. Please make sure you visit the page when any update has been recorded. </p><br>";
	
	}
	
?>
