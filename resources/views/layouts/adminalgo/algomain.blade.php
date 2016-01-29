@include('layouts.adminalgo.algovariables')
<?php
	use App\User;
	use App\User_detail;
	use App\Department;
	use App\Schedule;
	function main_func($name, $department){
		$MAX_Classes = Department::where('code',$department->code)->first()->total_rooms;
		
		//Thana kawaye nashi file read yaye ta kha
		/*$inputData=CSV2Array($name);//CSV2Array is a function defined inside the file functions.php and this file returns an array
		$i=0;
		foreach($inputData as $temp){//this loop will unwrap the two layered array which was stored in previous variable $inputvariable by the function CSV2Array in functions.php
			${"data".$i}=$temp;//Array ko array lai unwrap gari ra cha
			$i++;	
		}	
		$courseName=$data0;
		$start=$data1;
		$end=$data2;
		
		unset($courseName[0]);//unset array na 0th item of array ta hate yana bi
		unset($start[0]);//This chaye yanyu dhasa tho ma yata dhasa ASP algorithm le taye mau pani chau first pseudo class miss jui so tho object yu data kha
		unset($end[0]);//THisis for the first column of the csv file chaye choya tayu pani mile maju


		
		$courseName=arrangeArray($courseName);//tho arrangeArray userdefined function kha... thake yo 0th item maru ta hana milaya yana bi.... ie ..A[0] delete jui hanji so A[1] ta A[0] yana bi and A[2] ta A[1] and so on
		$start=arrangeArray($start);
		$end=arrangeArray($end);
		*/
		
		
		$scheduledata = Schedule::where('day',$name)->where('department_code',$department->code)->get();
		$courseName=array();
		$start=array();
		$end=array();
		foreach($scheduledata as $schedule)
		{
			$courseName[count($courseName)] = $schedule->course_code;
			$start[count($start)] = $schedule->stime;
			$end[count($end)] = $schedule->etime;
			//array_push($courseName,$schedule->course_code);
			//array_push($start,$schedule->stime);
			//array_push($end,$schedule->etime);
		}
		
		
		//File read yayau pati sidhala
		
		
		
		
		
		//For initializing the objects.... i.e. one object for one class
		$classes=array();
		
		$i=1;
		foreach($start as $a)
		{	
			$foo=new myClass;
			$foo->set_Data($a,$end[$i-1],$courseName[$i-1],$i);
			$i++;
			array_push($classes,$foo);	
		}


		if(count($classes))
		{
			
			echo "<h2>Routine for: ".$name."</h2><br>";
			echo "The classes mentioned below are the classes that you want to arrange for <strong>".$name."</strong> is as below.";
			
			printObject($classes,0,$name,$department->code);
		
		
		
		CustSort($classes);//Sorting accourding to the start time
		//This is the addition of A0 object at the first
		$temp=new myClass;
		$temp->set_Data(9999,0,"A0",0);
		array_unshift($classes,$temp);//array_unshift() inserts passed elements to the front of the array
		//End of the A0 object addition
		

		$i=1;
			while(sizeof($classes)!=1)
			{	
				${"abc".$i}=AC_Object($classes);//$abc.$i is the array which stores the object of the classes that is being taught in the room
				$classes=array_udiff($classes, ${"abc".$i}, 'compare_objects');//This will call the functions compare_objects defined in the function functions.php so in this case the remaining classes to be arranged is ordered back
				$classes=arrangeArray($classes);//This will arrange the items in an array. After the removal the array will empty on certain slots for eg if array element A[7] is arranged and now it empty this gap will be arranged by this function and the new sequential function will be arranged.
				$i++;		
			}//end of while for room.
			$i--;//this is fdone for counting the nof rooms required for the class rookm.
		
		
				
		$number_of_classes=$i;
		
		if($number_of_classes<=$MAX_Classes && $number_of_classes>0 )
		{
			
			echo "You will require ".$i." rooms for arranging this no of classes.";
			
		}
		else
		{
			echo "This above schedule cant be operated with existing no of classes. You will either require ".($i-$MAX_Classes)." additional classes or reschedule the following classes";
		}
		
		$a=1;
		if($i>$MAX_Classes)
		{
			while($a<=$MAX_Classes){
				echo "<br><strong>Room: ".$a."</strong>";
				printObject(${"abc".$a},$a,$name, $department->code);
				$a++;
			}	
		}//end of if($i>3
		if($number_of_classes>$MAX_Classes)
			echo "The schedule you wish to prepare cant be arranged with ".$MAX_Classes." classes. Please try to arrange the following classes in the empty slot for this day.";
		while($a<=$i){
			echo "<br><strong>Room: ".$a."</strong>";
			printObject(${"abc".$a},$a,$name, $department->code);
			$a++;
		}

		} //end of if(count)
		
	}//end of the function main_func
?>
