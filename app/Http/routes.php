<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
use App\user;
use Illuminate\Http\Request;
*/
/*
Route::group(['middleware' => 'web'], function () {

    
     //Show Users Dashboard
     
    Route::get('/', function () {
        $users = User::orderBy('created_at', 'asc')->get();

		return view('users', [
        'users' => $users
		]);
		return view('users');
    });

    // Add New user
     
    Route::post('/user', function (Request $request) {
        $validator = Validator::make($request->all(), [
        'username' => 'required|max:15|min:4',
		'password' => 'required|min:6',
		'password2' => 'required|same:password',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
	
	$user = new User;
    $user->username = $request->username;
    $user->save();

    return redirect('/');
    });

    //Delete user
     
    Route::delete('/task/{task}', function (Task $task) {
        //
    });
});
*/

Route::get('/', 'WelcomeController@index');
Route::get('home','HomeController@index');

Route::get('adduser','UserController@index');
Route::post('adduser', 'UserController@registeruser');

Route::get('deleteuser','UserController@showteachers');
Route::post('deleteuser', 'UserController@removeuser');

Route::get('changepassword','UserController@showuserinfo');
Route::post('changepassword', 'UserController@edituserinfo');

Route::get('editprofile', 'UserController@showuserdetails');
Route::post('editprofile', 'UserController@edituserdetails');

Route::get('resetpassword', 'UserController@showallusers');
Route::post('resetpassword', 'UserController@resetpassword');

Route::get('adddepartment', 'DepartmentController@index');
Route::post('adddepartment', 'DepartmentController@registerdepartment');

Route::get('editdepartment', 'DepartmentController@departmentdetails');
Route::post('editdepartment', 'DepartmentController@editdepartment');

Route::get('removedepartment', 'DepartmentController@showdepartmentlist');
Route::post('removedepartment', 'DepartmentController@removedepartment');

Route::get('addcourse', 'CourseController@index');
Route::post('addcourse', 'CourseController@registercourse');

Route::get('removecourse', 'CourseController@showcourses');
Route::post('removecourse', 'CourseController@removecourse');

Route::get('addgroup', 'GroupController@index');
Route::post('addgroup', 'GroupController@addgroup');

Route::get('deletegroup', 'GroupController@showgroups');
Route::post('deletegroup', 'GroupController@removegroup');

Route::get('addclass', 'CourseDetailController@index');
Route::post('addclass', 'CourseDetailController@addclass');

Route::get('viewclass', 'CourseDetailController@viewclass');
Route::post('viewclass', 'CourseDetailController@offerclasstime');

Route::get('requestschedule', 'CourseDetailController@viewclass');
Route::post('requestschedule', 'CourseDetailController@offerclasstime');

Route::get('withdrawclass', 'CourseDetailController@showclass');
Route::post('withdrawclass', 'CourseDetailController@withdrawclass');

Route::get('viewmyschedule', 'RoutineDisplayController@teacherschedule');

Route::get('batchwiseschedule', 'RoutineDisplayController@batchschedule');
Route::post('batchwiseschedule', 'RoutineDisplayController@viewbatchschedule');

Route::get('roomschedule', 'RoutineDisplayController@roomschedule');
Route::post('roomschedule', 'RoutineDisplayController@viewroomschedule');

Route::get('subjectwiseschedule', 'RoutineDisplayController@subjectschedule');
Route::post('subjectwiseschedule', 'RoutineDisplayController@viewsubjectschedule');

Route::get('departmentschedule', 'AdminScheduleController@departmentindex');
Route::post('departmentschedule', 'AdminScheduleController@viewroomschedule');

Route::get('courseschedule', 'AdminScheduleController@subjectschedule');
Route::post('courseschedule', 'AdminScheduleController@viewsubjectschedule');

Route::get('instructorschedule', 'AdminScheduleController@teacherindex');
Route::post('instructorschedule', 'AdminScheduleController@viewteacherschedule');

Route::get('groupschedule', 'AdminScheduleController@batchschedule');
Route::post('groupschedule', 'AdminScheduleController@viewbatchschedule');
//Route::get('/task', 'HomeController@index');
//Route::post('/task', 'HomeController@register');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
