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
    // Route::resource('/roles/create','RolesController');

});
