<?php namespace App\Http\Controllers;
use Auth;
use Redirect;
use Input;
use App\Course_detail;
use App\Schedule;
use App\Time_table;
use App\Department;
use App\User;
use App\User_detail;
use Request;
class RoutineDisplayController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	 public function teacherschedule()
	 {
	 $loggeduser = Auth::user()->utype;
		if($loggeduser == 0)
			return view('layouts.viewteacherschedule')->with('username', Auth::user()->username);
		else
			return Redirect::back();
	 }
	 
	 public function roomschedule()
	 {
	 $loggeduser = Auth::user()->utype;
		if($loggeduser == 0)
			return view('layouts.viewdepartment')->with('username', Auth::user()->username);
		else
			return Redirect::back();
	 }
	 
	 public function viewroomschedule()
	 {
		$department = Input::get('teacherdepart');
		$room = Input::get('selectroom');
		return view('layouts.viewroomschedule')->with('username', Auth::user()->username)->with('department',$department)->with('room',$room);
	 }
	 
	  public function batchschedule()
	 {
	 $loggeduser = Auth::user()->utype;
		if($loggeduser == 0)
			return view('layouts.viewbatch')->with('username', Auth::user()->username);
		else
			return Redirect::back();
	 }
	 
	 public function viewbatchschedule()
	 {
		$department = Input::get('teacherdepart');
		$batch = Input::get('selectbatch');
		return view('layouts.viewbatchschedule')->with('username', Auth::user()->username)->with('department',$department)->with('batch',$batch);
	 }
	 
	 public function subjectschedule()
	 {
	 $loggeduser = Auth::user()->utype;
		if($loggeduser == 0)
			return view('layouts.viewsubjects')->with('username', Auth::user()->username);
		else
			return Redirect::back();
	 }
	 
	 public function viewsubjectschedule()
	 {
		$department = Input::get('teacherdepart');
		$subject = Input::get('selectsubject');
		return view('layouts.viewsubjectschedule')->with('username', Auth::user()->username)->with('department',$department)->with('subject',$subject);
	 }
}