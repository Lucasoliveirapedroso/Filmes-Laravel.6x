<?php
Route::any('movies/search', 'MovieController@search')->name('movies.search')->middleware('auth');
Route::resource('movies', 'MovieController')->middleware('auth');



Route::get('/login', function () {
    return 'login';
})->name('login'); 

Auth::routes(['register' => false]);