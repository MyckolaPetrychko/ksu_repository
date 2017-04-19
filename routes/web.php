<?php

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
Route::get('/', 'Repos\RepoController@index');
Route::get('/login', 'Repos\LoginController@index')->middleware(\App\Http\Middleware\LoginMiddle::class);
Route::get('/statistics', 'Repos\StatisticsController@index');
Route::get('/statistics/dist', 'Repos\StatisticsController@dist');
Route::get('/availableDisert', 'Repos\RepoController@availableDisert');
Route::get('/profile', 'Repos\ProfileController@index')->middleware(\App\Http\Middleware\Auth::class);
Route::get('/logout', 'Repos\LogoutController@index')->middleware(\App\Http\Middleware\Auth::class);
Route::get('/adminpanel', 'Repos\AdminPanel@index')->middleware(\App\Http\Middleware\Admin::class);
Route::get('/dashboard', 'Repos\Dashboard@index')->middleware(\App\Http\Middleware\Auth::class);
Route::get('/files/get', 'Repos\RepoController@download');
Route::get('/repo/search', 'Repos\RepoController@search');

Route::post('/login/authenticate', 'Repos\LoginController@authenticate');
Route::post('/updatepassword', 'Repos\UpdatePassword@index')->middleware(\App\Http\Middleware\Auth::class);
Route::post('/admin/adduser', 'Repos\AdminPanel@adduser')->middleware(\App\Http\Middleware\Admin::class);
Route::post('/dashboard/adddisert', 'Repos\Dashboard@addDisert')->middleware(\App\Http\Middleware\Auth::class);
Route::post('/admin/addnewdissert', 'Repos\AdminPanel@addNewDisert')->middleware(\App\Http\Middleware\Auth::class);
