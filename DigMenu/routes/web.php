<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/','PagesController@index');
Route::get('/carta/{user_name}','PagesController@carta');
Route::post('/search','PagesController@search');
Route::get('/foodsearch','FoodsController@search');
Route::get('/menu/add/{food_id}','MenusController@add');

//Route::get('/menu','PagesController@menu');
Route::get('/profile','PagesController@profile');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::get('/filter/{tag}','DashboardController@filter');
Route::get('/setting', 'DashboardController@setting');

Route::get('/menufilter/{user}/{tag}','PagesController@filter');




Route::resource('food','FoodsController');
Route::resource('user','UserController');
Route::resource('menu','MenusController');
Route::resource('tag','TagsController');

