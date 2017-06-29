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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('chat/index/{friend_id}', 'ChatController@index')->name('chats.friend');
Route::get('chat/{friend_id}', 'ChatController@getMessages')->name('chats.friend.messages');
Route::post('chat/send', 'ChatController@sendMessage')->name('chats.message.send');
