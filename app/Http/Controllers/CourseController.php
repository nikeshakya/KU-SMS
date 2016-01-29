<?php namespace App\Http\Controllers;
use Auth;
use Redirect;
use Input;
use Validator;
use App\Course;
use App\Course_detail;
use App\Schedule;
use App\Time_table;

class CourseController extends Controller {

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
		if($loggeduser == 1)
			return view('layouts.addcourse')->with('registermsg', '');
		else
			return Redirect::back();
	}
	
	public function registercourse()
	{
	$messages = array(
		'course_code.required' => 'Code is required',
		'course_code.unique' => 'This course is already registered',
		'course_code.min' => 'Code must be at least 6 characters',
		'course_code.max' => 'Code must be at most 8 characters',
		'coursename.required' => 'Course name is required',
		);
        $validator = Validator::make(Input::all(), [
        'course_code' => 'required|min:6|max:8|unique:courses',
		'coursename' => 'required',
    ], $messages);
	
    if ($validator->fails()) {
        return redirect('addcourse')
            ->withInput()
            ->withErrors($validator);
    }
	$course = new Course;
    $course->course_code = Input::get('course_code');
	$course->course_title = Input::get('coursename');
	$course->credit = Input::get('coursecredit');
    $course->save();
	
	
    return view('layouts.addcourse')->with('registermsg', "Course registered.");
	}
	
	public function showcourses()
	{
	$loggeduser = Auth::user()->utype;
		if($loggeduser == 1)
			return view('layouts.removecourse')->with('deletemsg', '');
		else
			return Redirect::back();
	}
	public function removecourse()
	{
	$course = Input::get('selectcoursecode');
	$courseclasses = Course_detail::where('course_code',$course)->get();
	foreach($courseclasses as $courseclass)
	{
	//delete schedules data
	Schedule::where('course_code', $courseclass->id)->delete();
	Time_table::where('course_code', $courseclass->id)->delete();
	}
	//delete class data
	Course_detail::where('course_code',$course)->delete();
	//delete own data
	Course::where('course_code', $course)->delete();
	return view('layouts.removecourse')->with('deletemsg', 'Course Deleted');
	}
}
