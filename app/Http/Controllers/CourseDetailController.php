<?php namespace App\Http\Controllers;
use Auth;
use Redirect;
use Input;
use Validator;
use App\Course_detail;
use App\Schedule;
use App\Time_table;
use App\Department;
use App\User;
use App\User_detail;
use Request;
class CourseDetailController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$loggeduser = Auth::user()->utype;
		if($loggeduser == 0)
			return view('layouts.addclass')->with('registermsg', '')->with('username', Auth::user()->username);
		else
			return Redirect::back();
	}
	
	public function addclass()
	{
	if(isset($_POST['submitdepartment']))
	{
		
		$departcode = Input::get('selectdepartment');
		return view('layouts.addclassregister')->with('departcode',$departcode)->with('username', Auth::user()->username);
	}
	if(isset($_POST['addclass']))
	{
		$id = Input::get('selectcoursecode').Input::get('selectclass').Input::get('departselected');
		$id = str_replace(' ', '', $id);
		$existingdata = Course_detail::where('id', $id);
		if($existingdata->exists())
		{
		return redirect('addclass')->withErrors("The Course you selected has already been registered to the selected batch.");
		}
		else
		{
		$coursedetail = new Course_detail;
		$coursedetail->id = $id;
		$coursedetail->course_code = Input::get('selectcoursecode');
		$coursedetail->offered_by = Auth::user()->username;
		$coursedetail->offered_to = Input::get('selectclass');
		$coursedetail->department_code = Input::get('departselected');
		$coursedetail->save();
		return view('layouts.addclass')->with('registermsg', 'Your class has been successfully registered')->with('username', Auth::user()->username);
		}
		
	}
	
	}
	
	public function viewclass()
	{
		$loggeduser = Auth::user()->utype;
		
		if($loggeduser == 0)
			{
			if(isset($_GET['courseselected']))
			{
				return view('layouts.registercoursetime')->with('username', Auth::user()->username)->with('courseid',$_GET['courseselected']) ;
			}
			else
			return view('layouts.viewclass')->with('username', Auth::user()->username);
			}
		else
			return Redirect::back();
	}
	
	public function showclass()
	{
		$loggeduser = Auth::user()->utype;
		if($loggeduser == 0)
			return view('layouts.showclass')->with('username', Auth::user()->username);
		else
			return Redirect::back();
	}
	public function withdrawclass()
	{
	foreach($_POST['set_code'] as $id) 
	{
	//delete from course_detail, schedule and time_table
	Time_table::where('course_code',$id)->delete();
	Schedule::where('course_code',$id)->delete();
	Course_detail::where('id', $id)->delete();
	
	}
	return redirect('viewclass')->with('username', Auth::user()->username);
	}
	
	public function offerclasstime()
	{
	if(Input::get('code')!= null && isset($_POST['offer_classtime']) && isset($_POST['set']))
	{
	$errorarray = array();
	foreach($_POST['set'] as $set)
	{
	$starttime = Input::get('starttime'.$set);
	$endtime = Input::get('endtime'.$set);
	$classcode = Input::get('code');
	if($starttime == null || $endtime == null)
		$errorarray[count($errorarray)] = "You cannot leave time values empty (".$set.")";
		//return Redirect::Back()->withInput()->withErrors("Start time must be less than End time");
	else
	{
		if($starttime >= $endtime)
			$errorarray[count($errorarray)] = "Start time must be less than End time (".$set.")";
			//return Redirect::Back()->withInput()->withErrors("You cannot leave time values empty");
		else
		{
		//Checking for Batch time conflict
		$offered_to = Course_detail::where('id',$classcode)->first()->offered_to;
		$batchclasses = Course_detail::where('offered_to', $offered_to)->get();
		foreach($batchclasses as $batchclass)
		{
			$batchschedule = Schedule::where('class_id', $batchclass->id.$set)->first();
			$scheludeclasscode = $batchschedule['class_id'];
			if($scheludeclasscode != $classcode.$set)
			{
			$stime = $batchschedule['stime'];
			$etime = $batchschedule['etime'];
			$flag = 0;
			$case1 = 0;
									
								if($starttime<=$stime && $endtime>$stime ){
									$flag=1;
									$case1=1;
								}
								else if($starttime>=$stime && $endtime<$etime){
									$flag=1;
								}
								else if($starttime>=$stime && $starttime<$etime && $case1!=1){
									$flag=1;
								}
								if($flag == 1)
									$errorarray[count($errorarray)] = "Time slot: ".$starttime."-".$endtime." (".$set.") for batch ".$offered_to." is occupied by another subject ".$batchclass->course_code;
		
			}
		}
			
			//Checking for instructor time conflict
		$offered_by = Course_detail::where('id',$classcode)->first()->offered_by;
		$instructorclasses = Course_detail::where('offered_by', $offered_by)->get();
		foreach($instructorclasses as $instructorclass)
		{
			$instructorschedule = Schedule::where('class_id', $instructorclass->id.$set)->first();
			$scheludeclasscode = $instructorschedule['class_id'];
			if($scheludeclasscode != $classcode.$set)
			{
			$stime = $instructorschedule['stime'];
			$etime = $instructorschedule['etime'];
			$flag = 0;
			$case1 = 0;
									
								if($starttime<=$stime && $endtime>$stime ){
									$flag=1;
									$case1=1;
								}
								else if($starttime>=$stime && $endtime<$etime){
									$flag=1;
								}
								else if($starttime>=$stime && $starttime<$etime && $case1!=1){
									$flag=1;
								}
								if($flag == 1)
									$errorarray[count($errorarray)] = "You have another class ".$instructorclass->course_code." in Time slot: ".$starttime."-".$endtime." (".$set.") for batch ".$instructorclass->offered_to;
		
			}
		}
		//Checking time conflict for day
		
		//Teacher ko department line ho ki students ko department choose accordingly
		//for now lets use teacher's department
		$offered_by = Course_detail::where('id',$classcode)->first()->offered_by;
		$departcode = User_detail::where('id', User::where('username', $offered_by)->first()->id)->first()->department;
		$departmentmaxrooms = Department::where('code', $departcode)->first()['total_rooms'];
		
		$counter = 0;
		$dayschedules = Schedule::where('day',$set)->where('department_code',$departcode)->get();
		foreach($dayschedules as $dayschedule)
		{
								$stime = $dayschedule->stime;
								$etime = $dayschedule->etime;
								$case1 = 0;
									
								if($starttime<=$stime && $endtime>$stime ){
									$counter++;
									$case1=1;
								}
								else if($starttime>=$stime && $endtime<$etime){
									$counter++;
								}
								else if($starttime>=$stime && $starttime<$etime && $case1!=1){
									$counter++;
								}
		}
		if($counter >= $departmentmaxrooms)
			$errorarray[count($errorarray)] = "Sorry the room management is not possible for your time slots for ".$set;
		}
	}
	}
	if(count($errorarray) > 0)
		return Redirect::Back()->withInput()->withErrors($errorarray);
	else
	{
	foreach($_POST['set'] as $set)
	{
	$starttime = Input::get('starttime'.$set);
	$endtime = Input::get('endtime'.$set);
	$classcode = Input::get('code');
	Schedule::where('course_code', $classcode)->where('day', $set)->delete();
	Time_table::where('course_code', $classcode)->where('day', $set)->delete();
	//Teacher ko department line ho ki students ko department choose accordingly
		//for now lets use teacher's department
		$offered_by = Course_detail::where('id',$classcode)->first()->offered_by;
		$departcode = User_detail::where('id', User::where('username', $offered_by)->first()->id)->first()->department;
	$newschedule = new Schedule;
	$newschedule->class_id = $classcode.$set;
	$newschedule->course_code = $classcode;
	$newschedule->stime = $starttime;
	$newschedule->etime = $endtime;
	$newschedule->day = $set;
	$newschedule->department_code = $departcode;
	$newschedule->save();
	
	}
	return Redirect::back();
	}
	
	}
	else if(isset($_POST['remove_classtime']) && isset($_POST['set']))
	{
	foreach($_POST['set'] as $set)
	{
	
	$classcode = Input::get('code');
	Time_table::where('course_code', $classcode)->where('day', $set)->delete();
	Schedule::where('course_code', $classcode)->where('day', $set)->delete();
	return Redirect::back();
	}
	}
	else
	return Redirect::back();
	}
}
