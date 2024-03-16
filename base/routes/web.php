<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\{UserViewController, UserUpdateController, UserEditController, UserSingleViewController, UserDeleteController};

Route::get('/', function () {
    return redirect()->route('login');
    // return view('welcome');
});

Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::middleware(['auth'])->group(function () {
    Route::get('/home', UserViewController::class)->name('user.list');
    Route::get('/edit/{id}', UserEditController::class)->name('user.edit');
    Route::patch('/update', UserUpdateController::class)->name('user.update');
    Route::get('/single/view/{id}', UserSingleViewController::class)->name('user.view');


    Route::controller(UserDeleteController::class)->group(function () {
        Route::get('/users/trashed', 'trashed')->name('user.trashed');
        Route::get('/users/{id}/destroy', 'destroy')->name('users.destroy');
        Route::get('/users/{id}/restore', 'restore')->name('users.restore');
        Route::get('/users/{id}/forceDelete', 'forceDelete')->name('users.forceDelete');
    });
});
