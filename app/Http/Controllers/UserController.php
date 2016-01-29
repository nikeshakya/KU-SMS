<?php namespace App\Http\Controllers;
use Auth;
use App\User;
use App\user_detail;
use App\Course_detail;
use App\Schedule;
use App\Time_table;
use Validator;
use Input;
use Redirect;
use Hash;
use DB;
class UserController extends Controller {


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	 protected $loggeduser;
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
		if(Auth::user()->utype == 1)
			return view('layouts.addteacher');
		else
			return Redirect::back();
	}
	public function registeruser()
	{
		$messages = array(
		'username.required' => 'Username is required',
		'username.unique' => 'Username is already taken',
		'username.min' => 'Username must be at least 4 characters',
		'username.max' => 'Username must not be more than 15 characters long',
		'password.required' => 'Password is required',
		'password.min' => 'Password must be atleast 6 characters long',
		'password2.required' => 'Confirm Password is required',
		'password2.same' => 'Two Password fields must be same',
    );
        $validator = Validator::make(Input::all(), [
        'username' => 'required|max:15|min:4|unique:users,username',
		'password' => 'required|min:6',
		'password2' => 'required|same:password',
    ], $messages);
	
    if ($validator->fails()) {
        return redirect('adduser')
            ->withInput()
            ->withErrors($validator);
    }
	$pass= Hash::make(Input::get('password'));
	$user = new User;
    $user->username = Input::get('username');
	$user->password = $pass;
    $user->save();
	
	$details = new user_detail;
	$userextract = User::where('username', Input::get('username'))->first();
	$details->id = $userextract->id;
	$details->department = Input::get('userdepartment');
	$details->save();
	
    return redirect('/home');
    }
	
	public function showteachers()
	{
		if(Auth::user()->utype == 1)
			return view('layouts.showteachers');
		else
			return Redirect::back();
	}
	public function removeuser()
	{
		$username = Input::get('selected_username');
		$id = User::where('username',$username)->first()->id;
		
		$usercourses = Course_detail::where('offered_by', $username)->get();
		foreach($usercourses as $usercourse)
		{
		Schedule::where('course_code', $usercourse->id)->delete();
		Time_table::where('course_code', $usercourse->id)->delete();
		}
		
		Course_detail::where('offered_by', $username)->delete();
		user_detail::where('id', $id)->delete();
		User::where('username',$username)->delete();
		
		return redirect('/home');
	}
	public function showuserinfo()
	{
		return view('layouts.showuserinfo')->with('loggeduser', Auth::user()->username);
	}
	public function edituserinfo()
	{
	$rules = array(
		'oldpassword' => 'required|passcheck',
		'newpassword1' => 'required|min:6|newpasscheck',
		'newpassword2' => 'required|same:newpassword1',
		);
			Validator::extend('passcheck', function ($attribute, $value, $parameters, $validator) 
			{
				return Hash::check($value, Auth::user()->getAuthPassword());
			});
			Validator::extend('newpasscheck', function ($attribute, $value, $parameters, $validator) 
			{
				return !(Hash::check($value, Auth::user()->getAuthPassword()));
			});
			$messages = array(
        'passcheck' => 'Your old password was incorrect',
		'newpasscheck' => 'You cannot enter same old password',
		'newpassword1.required' => 'New Password is required',
		'newpassword1.min' => 'Password must be atleast 6 characters long',
		'newpassword2.required' => 'Confirm Password is required',
		'newpassword2.same' => 'Two Password fields must be same',
    );
	$validator = Validator::make(Input::all(),$rules, $messages);

    if($validator->fails()) {
        return redirect('changepassword')
            ->withInput()
            ->withErrors($validator);
    }

	$pass= Hash::make(Input::get('newpassword1'));
	$user = User::where('username', Input::get('username'))->first();
    $user->password = $pass;
    $user->save();

    return redirect('/home');
	}
	
	public function showuserdetails()
	{
		return view('layouts.showuserdetails')->with('loggeduser', Auth::user()->username);
	}
	
	public function edituserdetails()
	{
	$rules = array(
		'confirmpassword' => 'required|passcheck',
		
		);
			Validator::extend('passcheck', function ($attribute, $value, $parameters, $validator) 
			{
				return Hash::check($value, Auth::user()->getAuthPassword());
			});
			$messages = array(
        'passcheck' => 'Your password is incorrect',
    );
	$validator = Validator::make(Input::all(),$rules, $messages);

    if($validator->fails()) {
        return redirect('editprofile')
            ->withInput()
            ->withErrors($validator);
    }

	$user = User::where('username', Input::get('username'))->first();
    $details = user_detail::find($user->id);
	$details->first_name = Input::get('first_name');
	$details->middle_name = Input::get('middle_name');
	$details->last_name = Input::get('last_name');
	$details->email_id = Input::get('email_id');
	$details->address = Input::get('address');
	$details->department = Input::get('department');
	$details->designation = Input::get('designation');
	$details->save();
    return redirect('/home');
	}
	
	public function showallusers()
	{
		if(Auth::user()->utype == 1)
			return view('layouts.userpasswordreset');
		else
			return Redirect::back();
	}
	public function resetpassword()
	{
		$username = Input::get('selected_username');
		$messages = array(
		'newpassword.required' => 'Password is required',
		'newpassword.min' => 'Password must be atleast 6 characters long',
		);
        $validator = Validator::make(Input::all(), [
		'newpassword' => 'required|min:6',
		], $messages);
	
		if ($validator->fails()) {
			return redirect('resetpassword')
				->withInput()
				->withErrors($validator);
		}
		$pass= Hash::make(Input::get('newpassword'));
		$user = User::where('username', $username)->get()->first();
		$user->password = $pass;
		$user->save();
		
		return redirect('/home');
	}
}
