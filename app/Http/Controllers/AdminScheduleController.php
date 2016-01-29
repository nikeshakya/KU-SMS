<?php namespace App\Http\Controllers;
use Auth;
use Redirect;
use Input;
use Validator;
use App\Group;
use App\Course_detail;
use App\Schedule;
use App\Time_table;
class AdminScheduleController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	 public function teacherindex()
	 {
		$loggeduser = Auth::user()->utype;
		if($loggeduser == 1)
			return view('layouts.adminview.teacherselect')->with('username', Auth::user()->username);
		else
			return Redirect::back();
	 }
	 public function viewteacherschedule()
	 {
		$user = Input::get('selectteacher');
		return view('layouts.adminview.viewteacherschedule')->with('username', Auth::user()->username)->with('scheduleuser', $user);
	 }
	 
	 public function departmentindex()
	 {
	  $loggeduser = Auth::user()->utype;
		if($loggeduser == 1)
			return view('layouts.adminview.showdepartments')->with('username', Auth::user()->username);
		else
			return Redirect::back();
	 }
	 
	public function viewroomschedule()
	{
		if(isset($_POST['showroomschedule']))
		{
		$department = Input::get('teacherdepart');
		$room = Input::get('selectroom');
		return view('layouts.adminview.viewroomschedule')->with('username', Auth::user()->username)->with('department',$department)->with('room',$room);
	
		}
		else if(isset($_POST['showdepartmentrooms']))
		{
		$department = Input::get('selectdepartment');
		return view('layouts.adminview.viewdepartment')->with('username', Auth::user()->username)->with('department',$department);
	 
		}
	}
	 
	  public function batchschedule()
	 {
	 $loggeduser = Auth::user()->utype;
		if($loggeduser == 1)
			return view('layouts.adminview.selectdepartment')->with('username', Auth::user()->username);
		else
			return Redirect::back();
	 }
	 
	 public function viewbatchschedule()
	 {
		if(isset($_POST['showdepartbatch']))
		{
		$department = Input::get('selectdepartment');
		return view('layouts.adminview.viewbatch')->with('username', Auth::user()->username)->with('department',$department);
		}
		else if(isset($_POST['showbatchschedule']))
		{
		$department = Input::get('teacherdepart');
		$batch = Input::get('selectbatch');
		return view('layouts.adminview.viewbatchschedule')->with('username', Auth::user()->username)->with('department',$department)->with('batch',$batch);
		}
		
	 }
	 
	 public function subjectschedule()
	 {
	 $loggeduser = Auth::user()->utype;
		if($loggeduser == 1)
			return view('layouts.adminview.showteachers')->with('username', Auth::user()->username);
		else
			return Redirect::back();
	 }
	 
	 public function viewsubjectschedule()
	 {
		if(isset($_POST['showteachercourses']))
		{
			$user = Input::get('selectuser');
			return view('layouts.adminview.viewsubjects')->with('username', Auth::user()->username)->with('scheduleuser', $user);
		}
		else if(isset($_POST['showsubjectschedule']))
		{
		$department = Input::get('teacherdepart');
		$subject = Input::get('selectsubject');
		$user = Input::get('teachername');
		return view('layouts.adminview.viewsubjectschedule')->with('username', Auth::user()->username)->with('department',$department)->with('subject',$subject)->with('scheduleuser', $user);
		}
		
	 }
}
