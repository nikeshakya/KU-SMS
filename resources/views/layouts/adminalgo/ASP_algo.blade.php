<?php

	function AC_Object( &$array){//this function is the application of the Activity selection problem and this returns the classes whuch has been arranged in the classes.
		$n=sizeof($array);
		$OrderedArray=array();
		array_push($OrderedArray,$array[1]);
		$k=1;
		$m=1;
		for($m=2;$m<$n;$m++)
		{
				if($array["$m"]->start_time >= $array["$k"]->end_time)
				{
					array_push($OrderedArray,$array["$m"]);
					
					$k=$m;	
				}
		}
		return $OrderedArray;
	}
	
	?>
