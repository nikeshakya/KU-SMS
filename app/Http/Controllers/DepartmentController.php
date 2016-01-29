<?php namespace App\Http\Controllers;
use Auth;
use Redirect;
use Input;
use Validator;
use App\Department;
use App\User;
use App\User_detail;
use App\Course_detail;
use App\Schedule;
use App\Time_table;
use App\Group;
class DepartmentController extends Controller {

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
			return view('layouts.adddepartment')->with('registermsg','');
		else
			return Redirect::back();
	}
	public function registerdepartment()
	{
	$messages = array(
		'departmentcode.required' => 'Code is required',
		'departmentcode.min' => 'Code must be at least 4 characters',
		'departmentcode.unique' => 'This department is already registered',
		'departmentcode.max' => 'Code must be at most 8 characters',
		'departmentname.required' => 'Department name is required',
		);
        $validator = Validator::make(Input::all(), [
        'departmentcode' => 'required|min:4|max:8|unique:departments,code',
		'departmentname' => 'required',
    ], $messages);
	
    if ($validator->fails()) {
        return redirect('adddepartment')
            ->withInput()
            ->withErrors($validator);
    }
	$department = new Department;
    $department->code = Input::get('departmentcode');
	$department->name = Input::get('departmentname');
	$department->total_rooms = Input::get('departmentrooms');
    $department->save();
	
	
    return view('layouts.adddepartment')->with('registermsg','Department added successfully');
	}
	
	public function departmentdetails()
	{
	$loggeduser = Auth::user()->utype;
		if($loggeduser == 1)
			return view('layouts.selectdepartment');
		else
			return Redirect::back();
	}
	
	public function editdepartment()
	{
	if(isset($_POST['showdepartinfo']))
	{
		
		$departcode = Input::get('selectdepartmentcode');
		return view('layouts.editdepartment')->with('departcode',$departcode);
	}
	if(isset($_POST['editdetails']))
	{
		$rooms = Input::get('departmentrooms');
		$departcode = Input::get('departmentcode');
		$departrow = Department::where('code',$departcode)->update(['total_rooms' => $rooms]);
		return redirect('/home');
	}
	}
	
	public function showdepartmentlist()
	{
	$loggeduser = Auth::user()->utype;
		if($loggeduser == 1)
			return view('layouts.removedepartment')->with('deletemsg','');
		else
			return Redirect::back();
	}
	public function removedepartment()
	{
		$departcode = Input::get('selectdepartmentcode');
		//delete schedules data
		$departcourses = Course_detail::where('department_code', $departcode)->get();
		foreach($departcourses as $departcourse)
		{
		Schedule::where('course_code', $departcourse->id)->delete();
		Time_table::where('course_code', $departcourse->id)->delete();
		}
		//Delete course details data
		Course_detail::where('department_code', $departcode)->delete();
		//Delete groups data
		Group::where('department',$departcode)->delete();
		//Delete user data
		$departusers = User_detail::where('department',$departcode)->get();
		foreach($departusers as $departuser)
		{
		if(User::where('id', $departuser->id)->first()->utype == 0)
		{
		User_detail::where('id',$departuser->id)->delete();
		User::where('id', $departuser->id)->delete();
		}
		}
		Department::where('code',$departcode)->delete();
		return view('layouts.removedepartment')->with('deletemsg','Department Deleted');
		
	}
}
