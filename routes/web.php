<?php

use Illuminate\Support\Facades\Route;

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
    $user = auth()->user();

    if ($user && $user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } else {
        return view('home');
    }
})->middleware(['auth'])->name('default.home'); // Use a different name for the default home route

// Temporary fix for unknown bug.
Route::get('/favicon.ico', function () {
    return redirect(route('default.home'));
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    // Use a different route for authenticated home
    Route::get('/home', function () {
        return view('home'); // You might need a separate view for authenticated home
    })->name('home');

    Route::get('/rooms/{room}/{classroomName}/join', "App\Http\Controllers\RoomController@join")->name('rooms.join');
    Route::get('/rooms/{room}/{classroomName}/member', "App\Http\Controllers\RoomController@member")->name('rooms.member');
    Route::get('/rooms/{room}/edit', "App\Http\Controllers\RoomController@edit")->name('rooms.edit');
    Route::get('/rooms/{roomId}/{classroomName}', "App\Http\Controllers\RoomController@rooms");
    Route::resource('/rooms', "App\Http\Controllers\RoomController")->names('rooms');
    Route::resource('/posts', "App\Http\Controllers\PostController")->names('posts');
    Route::get('/feeds', "App\Http\Controllers\PostController@followers")->name('feeds');
    Route::resource('/manage/users', "App\Http\Controllers\UserController")->except(['show', 'store'])->names('users');
    Route::get('/{username}', "App\Http\Controllers\ProfileController@show")->name('profile');
});


Route::group(['middleware' => ['auth:sanctum', 'verified', 'admin']], function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Replace 'admin.dashboard' with your actual admin dashboard view
    })->name('admin.dashboard');
}); 