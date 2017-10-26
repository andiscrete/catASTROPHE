<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*
Route::get('/', function()
{
	return View::make('home');
});
*/
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

App::missing(function($exception)
{
    return View::make('errors.missing');
});

Route::put('test', 'UserController@validate');

Route::filter('member','UserController@memberFilter');

Route::get('/user/create','UserController@create');
Route::post('/user/store','UserController@store', array('before' => 'csrf'));
Route::group(array('before' => 'auth'), function()
{
  Route::get('/user/{id}/membership', 'UserController@membership');
  Route::get('user/{id}/member', 'UserController@member', array('before' => 'member'));
  Route::get('user/{id}/species', 'UserController@species', array('before' => 'member|csrf'));
  Route::put('user/{id}/validate', 'UserController@validate', array('before' => 'csrf'));
});
Route::get('login','UserController@login');
Route::post('login','UserController@authenticate', array('before' => 'csrf'));
Route::get('logout', 'UserController@logout');

Route::get('animal/{id}','AnimalController@show', array('before' => 'member'));

Route::get('403', function(){
  return View::make('errors.fourothree');
});
