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

Route::get('/', function() 
{
	return view('index');
});

Route::get('/user', function() 
{
	$user = \App\TimeEntry::find(12);
	$date = Carbon\Carbon::now('America/Vancouver')->toDateString();
	$date_now = Carbon\Carbon::today();
	$dates = \App\TimeEntry::all();
	foreach ($dates as $day)
	{
		$carbon = $day->start_time->toDateString();
		echo $carbon;
	}
	
	echo $date;
	echo " current carbon object: ";
	echo $date_now;
	echo " user data";
	echo $user;
	echo " carbon timestamp accessor: ";
	echo $user->end_time->toDateString();
	echo " foreach loop: ";
	echo $carbon;
	
	
	dd($date_now);
	dd($user->start_time);
});

Route::group(array('prefix' => 'api'), function()
{
	Route::resource('time', 'TimeEntriesController');
	Route::resource('users', 'UsersController');
	Route::resource('comments', 'CommentsController');
	Route::resource('hours', 'EmployeeHoursController');
});

//Route::get('home', 'HomeController@index');

//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);
