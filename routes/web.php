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

Route::get('/', 'HomeController@index' );
Route::post('/', 'HomeController@index' );
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@index' );
Route::get('/logout',"Auth\LoginController@logout");

//new song
Route::get('song/new',"SongController@getNewSong")->name('song.new');
Route::post('song/new', "SongController@postNewSong");


//detail song
Route::get('song/{title}/{id}', "SongController@getSongDetail")->name('song.detail');
Route::post('song/add/song-detail', "SongController@postSongDetail")->name('post.song.detail');






//add schedule
Route::post('schedule/add', 'ScheduleController@postAddSchedule')->name('post.schedule');

//add song to schedule
Route::post('schedule/add/song-detail/', "ScheduleController@postAddScheduleSongDetail")->name('post.scheduleSongDetail');

// all song in a schedule
Route::get("schedule/all-song","ScheduleController@getAllSong");
