
<?php 
	use App\time_table;
	
	
	function checkFreeTime($day,$room,$userdepartment){
		$occupiedtimes = time_table::where('day',$day)->where('room',$room)->where('department_code', $userdepartment)->orderby('stime')->get();
		$tempStime=7;
		$tempEtime=7;
		$freeBucket=array();
		foreach($occupiedtimes as $occupied)
		{
		if($occupied->stime > $tempEtime)
		{
				$temp=array($tempEtime,$occupied->stime);
				array_push($freeBucket,$temp);
		}
			$tempStime=$occupied->stime;
			$tempEtime=$occupied->etime;
		}
		if($tempEtime!=16){
			$temp=array($tempEtime,16);
			array_push($freeBucket,$temp);
		}
		
		return $freeBucket;
	}

?>

