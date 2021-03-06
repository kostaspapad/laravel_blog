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



Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');

Route::get('/toggle/{id}', 'PostsController@togglePostVisibility');
Route::resource('/posts', 'PostsController');

Route::resource('/users', 'UsersController');
Route::resource('/userprofile', 'UserProfileController');
Route::resource('/messages', 'MessagesController');

Route::get('/usernotifications/{id}', 'NotificationsController@index');
Route::get('/usernotifications/{id}','NotificationsController@delete');

Route::post('searchmessages', 'SearchController@searchMessages');
Route::post('searchposts', 'SearchController@searchPosts');
Route::get('autocomplete', 'SearchController@autoComplete');
 
Route::resource('votes', 'VotesController');


Route::get('/dashboard', 'DashboardController@index');
Route::get('/notifications/{id}','NotificationController@delete');


Auth::routes();


