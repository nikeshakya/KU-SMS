<?php namespace App\Http\Controllers;
use Auth;
use Redirect;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

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
		$loggeduser = Auth::user()->utype;
		if($loggeduser == 1)
			return view('layouts.adminpanel')->with('username',Auth::user()->username);
		else
			return redirect('viewclass');
	}

}
