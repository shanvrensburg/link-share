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

Auth::routes();

Route::get('/', 'CommunityLinksController@index');
Route::post('/', 'CommunityLinksController@store');
Route::get('/{channel}', 'CommunityLinksController@index');

Route::post('votes/{link}', 'VotesController@store');
