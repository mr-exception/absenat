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

    });
    Route::prefix('members')->name('members.')->group(function(){
        Route::get('/create/{project}', 'Members@create')->name('create');
        Route::post('/store', 'Members@store')->name('store');
        
        Route::get('/destroy/{member}', 'Members@destroy')->name('destroy');
        Route::get('/change/{member}', 'Members@change')->name('change');
    });
    Route::prefix('epics')->name('epics.')->group(function(){
        Route::get('/create/{project}', 'Epics@create')->name('create');
        Route::post('/store', 'Epics@store')->name('store');

        Route::get('/edit/{epic}', 'Epics@edit')->name('edit');
        Route::post('/update/{epic}', 'Epics@update')->name('update');

        Route::get('/destroy/{epic}', 'Epics@destroy')->name('destroy');
        Route::get('/{epic}', 'Epics@show')->name('show');
        Route::get('/{epic}/start', 'Epics@start')->name('start');
        Route::get('/{epic}/finish', 'Epics@finish')->name('finish');
    });
    Route::prefix('sprints')->name('sprints.')->group(function(){
        Route::get('/create/{project}', 'Sprints@create')->name('create');
        Route::post('/store', 'Sprints@store')->name('store');

        Route::get('/edit/{sprint}', 'Sprints@edit')->name('edit');
        Route::post('/update/{sprint}', 'Sprints@update')->name('update');

        Route::get('/destroy/{sprint}', 'Sprints@destroy')->name('destroy');
        Route::get('/{sprint}', 'Sprints@show')->name('show');
    });
});
