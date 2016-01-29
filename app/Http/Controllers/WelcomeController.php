<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Validator;
use Input;
use Redirect;
use Hash;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	
	public function index()
	{
		return view('layouts.firstpage');
	}
	
	/*
	public function register()
	{
		//Admin Registration test
		
		$username = Input::get('username');
		$password = Input::get('password');
		if($username == 'admin' && $password == 'admin')
			{
				$password = Hash::make($password);
				$user = new User;
				$user->username = $username;
				$user->password = $password;
				$user->utype = 1;
				$user->save();
				return redirect('/home');
			}
		else
			echo "Admin registration fail";
		
	}*/

}
