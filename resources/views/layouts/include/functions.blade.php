<?php
function no2day($a){
	switch($a){
		case 1:
			return "Sunday";
		
		case 2:
			return "Monday";
		
		case 3:
			return "Tuesday";
		
		case 4:
			return "Wednesday";
		
		case 5:
			return "Thursday";
		case 6:
			return "Friday";
		
	}
}
function day2no($a){
	switch($a){
		case "Sunday":
			return 1;
		
		case "Monday":
			return 2;
		
		case "Tuesday":
			return 3;
		
		case "Wednesday":
			return 4;
		
		case "Thursday":
			return 5;
		case "Friday":
			return 6;
		
	}
}
	
?>
