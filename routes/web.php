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

Route::group(['middleware' => 'App\Http\Middleware\Admin'], function()
{
    Route::get('/', 'App\Http\Controllers\IndexController@index')->name('index');

    Route::get('/data-update', 'App\Http\Controllers\IndexController@dataUpdate')->name('data-update');

    Route::get('/logout', function()
    {
      Session::forget('user');

      if(!Session::has('user'))
       {
          return redirect()->route('login');
       }
    })->name('logout');

});

Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login');

Route::post('/session-start', 'App\Http\Controllers\LoginController@login')->name('session-start');
