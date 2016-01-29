<?php

class myClass{//THis is the class which keeps the data of the single class as an object. Here all the attributes of the class are bundled and stored in one class.
		
		public $id;
		public $start_time;
		public $end_time;
		public $class_name;
		
		function set_Data($s,$e,$cname,$no){
			$this->start_time=$s;
			$this->end_time=$e;
			$this->class_name=$cname;
			$this->id=$no;
		
		}
		function start_time(){
			echo $start_time;
			return $this->start_time;	
		}
		function end_time(){
			return $this->end_time;
		}
		function classname(){
			return $this->class_name;
		}
		
		
		
	}

?>
