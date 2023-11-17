<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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
    return redirect(route('home'));
});

// Temporary fix for unknown bug.
Route::get('/favicon.ico', function () {
    return redirect(route('home'));
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    //Route::get('/chat', "App\Http\Controllers\ChatController@index")->names('chat');
    Route::resource('/chats', "App\Http\Controllers\ChatController")->names('chats');
    Route::get('/rooms/{roomId}/{classroomName}', "App\Http\Controllers\RoomController@rooms");
    Route::resource('/rooms', "App\Http\Controllers\RoomController")->names('rooms');
    Route::resource('/posts', "App\Http\Controllers\PostController")->names('posts');
    Route::get('/feeds', "App\Http\Controllers\PostController@followers")->name('feeds');
    Route::resource('/manage/users', "App\Http\Controllers\UserController")->except(['show', 'store'])->names('users');
    Route::get('/{username}', "App\Http\Controllers\ProfileController@show")->name('profile');
});
