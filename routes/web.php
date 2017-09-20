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


Route::get('alpet/{version?}/{day?}/{month?}', 'AlpetController@getAlpet')->name('get.alpet');

// Route::get('alpet/}', 'AlpetController@getAlpet')->name('get.alpet');



Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@index' );
Route::get('/logout',"Auth\LoginController@logout");
Route::get('forgot-password','Auth\LoginController@getForgotPassword')->name('getForgotPassword');
Route::post('forgot-password','Auth\LoginController@postForgotPassword')->name('postForgotPassword');
//new song
Route::get('song/new',"SongController@getNewSong")->name('song.new');
Route::post('song/new', "SongController@postNewSong");


//detail song
Route::get('song/{title}/{id}', "SongController@getSongDetail")->name('song.detail');
Route::post('song/add/song-detail', "SongController@postSongDetail")->name('post.song.detail');



//add schedule
Route::post('schedule/add', 'ScheduleController@postAddSchedule')->name('post.schedule');
//all Scheudle
Route::get('schedule/history', 'ScheduleController@getScheduleHistory')->name('get.scheduleHistory');

//add wl
Route::post('schedule/set-worship-leader','ScheduleController@postSetWorshipLeader')->name('post.setWorshipLeader');


//add song to schedule
Route::post('schedule/add/song-detail/', "ScheduleController@postAddScheduleSongDetail")->name('post.scheduleSongDetail');
Route::delete('schedule/delete/song-detail', "ScheduleController@deleteScheduleSongDetail")->name('delete.scheduleSongDetail');

// all song in a schedule
Route::get('schedule/song-arangement/{id}',"ScheduleController@getAllSong")->name('getSongArangement');

//reorder song list
Route::post('schedule/reorder', "ScheduleController@postOrderSongDetail")->name('post.reorder');


//update list
Route::get('update',"HomeController@getUpdate")->name('get.update');

//cronJobschedule
Route::get('cronjob/add/schedule', "ScheduleController@getCronjobAddSchedule")->name('cronjob.addSchedule');



Route::get('alkitab',function(){
    $bible  = new App\Helper\Classes\CBible('  kejadian   ','1');

    return response()->json($bible->comp);
//     $test = (object) [];
//     $test->coba = 'sdf';
// ac
    return  response()->json($bible->completeChapter);
});


Route::get('coba',function(){

    //# filter songDetail based on foreign User attribute
    $songs = App\Model\SongDetail::whereHas('getUser' , function($query){
        $query->where('name','like','%david%');
        // $query->orderBy('id','asc');

    })->orderBy('id','asc')->get();


    //# will return null foreach songDetail->getUser if not satisfied current condifiont
    $eager = App\Model\SongDetail::with(['getUser' => function($query){
        $query->where('id','4');
        // $query->orderBy('id','asc');

    }])->get();



    // $songs = App\Model\SongDetail::all();
    // debug($songs);
    foreach($songs as $song){

        echo $song->getUser->name . "<br />";
        // echo"sdf";
    }
    foreach($eager as $songDetail){
        if($songDetail->getUser != null){
            echo $songDetail->getUser->id;
            echo $songDetail->title;
            echo $songDetail->getUser->name;
        }
    }


    $user = Auth::user();
    $songDetails = $user->getSongDetail;
    foreach($songDetails as $songDetail){
        // echo "<br />$songDetail->title ";

    }
});
