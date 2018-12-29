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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::prefix('projects')->name('projects.')->group(function(){
        
        Route::get('/create', 'Projects@create')->name('create');
        Route::post('/store', 'Projects@store')->name('store');
        

        Route::get('/edit/{project}', 'Projects@edit')->name('edit');
        Route::post('/update/{project}', 'Projects@update')->name('update');

        Route::get('/{project}', 'Projects@show')->name('show');
        Route::get('/{project}/destroy', 'Projects@destroy')->name('destroy');
        Route::get('/{project}/close', 'Projects@close')->name('close');
        Route::get('/{project}/open', 'Projects@open')->name('open');

        Route::get('/remove-permisison/{member}', 'Projects@removeMember')->name('permission.remove');
        Route::get('/change-permisison/{member}', 'Projects@changeMemberPermission')->name('permission.change');
    });
});
