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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Auth::routes(['verify' => true]);
Route::view('v', 'auth.verify');
//AUTHENTICATED
Route::group(['middleware' => 'auth'], function(){
    Route::get('profile', 'ProfileController@edit')->name('profile');
    Route::put('profile', 'ProfileController@update')->name('profile.update');

//    ADMIN
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function(){
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
//        SEE ALL USERS
        Route::resource('user', 'UserController')->only(['index', 'show']);

//        MANAGE SUBMISSION
        Route::resource('submission', 'SubmissionController')->except('create');

    });

//    VERIFIKATOR
    Route::group(['middleware' => 'role:verifikator', 'prefix' => 'verifikator', 'namespace' => 'Verifikator', 'as' => 'verifikator.'], function(){
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

//        MANAGE SUBMISSION
        Route::resource('submission','SubmissionController')->except('create');
    });

//    USER
    Route::group(['middleware' => ['role:user', 'verified'], 'prefix' => 'user', 'namespace' => 'User', 'as' => 'user.'], function(){
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

//        MAKE SUBMISSION
        Route::resource('submission', 'SubmissionController')->except(['edit', 'destroy']);
    });
});
