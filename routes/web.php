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

Route::get('/', function () {
    return view('welcome');
});

 Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// admin routes
Route::prefix('admin')->group(function () {

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('roles','RolesController',['names' => 'admin.roles']);
    Route::resource('users','UsersController',['names' => 'admin.users']);
    Route::resource('admins','AdminController',['names' => 'admin.admins']);

    //admin auth routes
    Route::get('/login', 'admin\Auth\LoginController@showLogin')->name('admin.login');
    Route::post('/login/submit', 'admin\Auth\LoginController@login')->name('admin.login.submit');
    //logout
    Route::post('/logout/submit', 'admin\Auth\LoginController@logout')->name('admin.logout.submit');

    // password reset
    Route::get('/password/reset', 'admin\Auth\ResetPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'admin\Auth\ResetPasswordController@reset')->name('admin.password.update');



});
