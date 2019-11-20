<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('teams', 'Teams\TeamController');

Route::resource('teams/{team}/users', 'Teams\TeamUserController')->names([
	'index' => 'teams.users.index'
]);