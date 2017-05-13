<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

/**
 * User route
 */
Route::get('user/signup', [
    'middleware' => ['guest'],
    'uses'       => 'AuthController@create'
]);
Route::post('user/signup', [
    'middleware' => ['guest'],
    'uses'       => 'AuthController@store'
]);
Route::get('user/signin',  [
    'middleware' => ['guest'],
    'uses'       => 'AuthController@getLogin'
]);
Route::post('user/signin', [
    'middleware' => ['guest'],
    'uses'       => 'AuthController@postLogin'
]);
Route::get('user/signout', 'AuthController@logout');


/*
 * Search
 */
Route::get('user/search', [
    'uses'       => 'SearchController@getSearch',
    'middleware' => 'auth'
]);

Route::get('user/edit',   'ProfileController@edit');
Route::post('user/edit', 'ProfileController@update');
Route::get('/user/friend', [
    'uses'       => 'FriendController@index',
    'middleware' => 'auth'
]);
Route::get('user/add/{username}', [
    'uses' => 'FriendController@add',
    'middleware' => 'auth'
]);
Route::get('user/accept/{username}',[
    'uses'       => 'FriendController@accept',
    'middleware' => 'auth'
]);
Route::post('user/unfriend/{username}', [
    'uses'       => 'FriendController@unfriend',
    'middleware' => 'auth'
]);
Route::get('user/{username}',  'ProfileController@index');

/**
 * Status
 */
Route::post('status', [
    'uses'       => 'StatusController@store',
    'middleware' => 'auth'
]);

Route::post('status/{statusId}/reply', [
    'uses'       => 'StatusController@reply',
    'middleware' => 'auth'
]);

Route::get('status/{statusId}/like', [
    'uses'       => 'StatusController@like',
    'middleware' => 'auth'
]);