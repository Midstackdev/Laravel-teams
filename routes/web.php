<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('teams', 'Teams\TeamController');

Route::get('teams/{team}/delete', 'Teams\TeamController@delete')->name('teams.delete');

Route::resource('teams/{team}/users', 'Teams\TeamUserController')->names([
	'index' => 'teams.users.index',
	'store' => 'teams.users.store',
]);