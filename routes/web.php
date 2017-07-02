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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout',"Auth\LoginController@logout");

//song
Route::get('song/new',"SongController@getNewSong")->name('song.new');
Route::post('song/new', "SongController@postNewSong");

Route::get('song/{title}/{id}', "SongController@getSongDetail")->name('song.detail');
Route::post('song/add/song-detail', "SongController@postSongDetail")->name('post.song.detail');
