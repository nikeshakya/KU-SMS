<?php
	use App\Course_detail;
	use App\Course;
	use App\Time_table;
	function printObject($array,$store,$dayname,$department){
		if($store!=0){
			
			foreach($array as $a)
			{	
				$class_code=$a->class_name.$dayname.$store;
				$c_code=$a->class_name;
				$s_time=$a->start_time;
				$e_time=$a->end_time;
				$day=$dayname;
				$room=$store;
				
				$prevroutines = Time_table::where('course_code',$c_code)->where('day',$day)->delete();				
				
				$routine = new Time_table;
				$routine->class_id = $class_code;
				$routine->course_code = $c_code;
				$routine->stime = $s_time;
				$routine->etime = $e_time;
				$routine->day = $day;
				$routine->department_code = $department;
				$routine->room = $room;
				$routine->save();
			}
			
		}

			echo "<table border='1'>";
		
			echo "<tr align='center' border=5>";
			echo "<td>Course Code</td>";
			foreach($array as $a)
			{
				$coursecode = Course_detail::where('id',$a->class_name)->first()->course_code;
				echo "<td>".$coursecode."</td>";
			}
			echo "</tr>";
			
			echo "<tr align='center' border=5>";
			echo "<td>Instructor</td>";
			foreach($array as $a)
			{	
				$offered_by = Course_detail::where('id',$a->class_name)->first()->offered_by;
				echo "<td>".$offered_by."</td>";
			}
			echo "</tr>";
			
			echo "<tr align='center' border=5>";
			echo "<td>Offered_to</td>";
			foreach($array as $a)
			{	
				$offered_to = Course_detail::where('id',$a->class_name)->first()->offered_to;
				echo "<td>".$offered_to."</td>";
			}
			echo "</tr>";
			
			echo "<tr align='center' border=5>";
			echo "<td bgcolor='green'>Start Time</td>";
			foreach($array as $a)
			{	
				echo "<td>".$a->start_time."</td>";
			}
			echo "</tr>";		
			
			
			echo "<tr align='center' border=5>";
			echo "<td bgcolor='red'>End Time</td>";
			foreach($array as $a)
			{	
				echo "<td>".$a->end_time."</td>";
			}
			echo "</tr>";
		echo "</table>";
		echo "<br>";

	}
	
	function compare_objects($obj_a, $obj_b) {
		return $obj_a->id - $obj_b->id;
	}
	
	function arrangeArray($array){
		$temp=array();
		foreach($array as $a){
			array_push($temp,$a);
		}
		return $temp;
	}
	
	
	function CSV2Array($filepath){
		$row = 1;
		if (($handle = fopen($filepath, "r")) !== FALSE) {
			$i=0;
			while ((${"data".$i} = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count(${"data".$i});
			//	echo "<p> $num fields in line $row: <br /></p>\n";
				$row++;
				$i++;
			}
			fclose($handle);
			
			return array($data0,$data1,$data2);
		}
	}
?>
