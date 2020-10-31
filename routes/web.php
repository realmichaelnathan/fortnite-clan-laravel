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

// General Page Routes (Don't Require Authorization)
Route::get('/', 'PagesController@index');
Route::get('/leaderboard', 'PagesController@leaderboard');

Route::get('/logomaker', function() {
    return redirect('/');
});

Route::get('/clan/{name}','ClansController@index');
Route::get('/user/{id}/{name}','PagesController@viewuser');

// Clan Routes
Route::get('/editclan',  'ClansController@show')->middleware('auth');
Route::get('/addclan',   'ClansController@create')->middleware('auth','verified');
Route::get('/clan-dashboard','PagesController@clan_dashboard')->middleware('auth');

Route::post('/addclan', 'ClansController@store');
Route::post('/editclan', 'ClansController@update');
Route::post('/deleteclan', 'ClansController@destroy');

// API Routes
Route::post('/vote', 'VotesController@store');
Route::post('/removevote', 'VotesController@destroy');
Route::post('/bumpclan', 'ClansController@bump');

// Auth Routes
Auth::routes(['verify' => true]);
// Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('login/twitter', 'Auth\LoginController@redirectToProvider');
Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderCallback');

// Routes for stats
Route::get('/stats', 'StatsController@stats');

//User account routes
Route::get('/myaccount', 'UserController@edit')->middleware('verified');
Route::patch('/myaccount', 'UserController@update');
Route::delete('/myaccount', 'UserController@destroy');
