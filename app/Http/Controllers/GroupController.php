<?php namespace App\Http\Controllers;
use Auth;
use Redirect;
use Input;
use Validator;
use App\Group;
use App\Course_detail;
use App\Schedule;
use App\Time_table;
class GroupController extends Controller {

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
			return view('layouts.addgroup')->with('registermsg', '');
		else
			return Redirect::back();
	}
	
	public function addgroup()
	{
	$messages = array(
		'group_code.required' => 'Code is required',
		'group_name.required' => 'Group name is required',
		);
        $validator = Validator::make(Input::all(), [
        'group_code' => 'required',
		'group_name' => 'required',
    ], $messages);
	
    if ($validator->fails()) {
        return redirect('addgroup')
            ->withInput()
            ->withErrors($validator);
    }
	
	$existinggroup = Group::where('group_code', Input::get('group_code').'_1')->where('department',Input::get('groupdepartment'))->first();
	if( !empty($existinggroup))
	{
		 return redirect('addgroup')
            ->withInput()
            ->withErrors("Group Code Already Exists for this department");
	}
	else
	{
		for($i = 1; $i < 9; $i++)
		{
		$group = new Group;
		$code = Input::get('group_code').'_'.$i;
		$group->group_code = $code;
		$group->group_name = Input::get('group_name');
		$group->department = Input::get('groupdepartment');
		$group->save();
		}
		return view('layouts.addgroup')->with('registermsg', "group registered.");
	}    
	}
	
	public function showgroups()
	{
	$loggeduser = Auth::user()->utype;
		if($loggeduser == 1)
			return view('layouts.removegroup')->with('deletemsg', '');
		else
			return Redirect::back();
	}
	public function removegroup()
	{
	$groupname = Input::get('selectgroup_name');
	
	$groups = Group::where('group_name', $groupname)->get();
	foreach($groups as $group)
	{
	$offered_to = $group->group_code;
	$batchcourses = Course_detail::where('offered_to',$offered_to)->get();
	foreach($batchcourses as $batchcourse)
	{ //delete schedules data
	Schedule::where('course_code', $batchcourse->id)->delete();
	Time_table::where('course_code', $batchcourse->id)->delete();
	}
	// delete class data
	Course_detail::where('offered_to',$offered_to)->delete();
	}
	//delete the group
	Group::where('group_name', $groupname)->delete();
	return view('layouts.removegroup')->with('deletemsg', 'group Deleted');
	}
}
