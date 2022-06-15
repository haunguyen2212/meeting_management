<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'check'])->name('login.check');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::patch('password/change', [HomeController::class, 'changePassword'])->name('password.change');
Route::get('profile/edit/{id}', [HomeController::class, 'editProfile'])->name('profile.edit');
Route::patch('profile/edit/{id}', [HomeController::class, 'updateProfile'])->name('profile.update');
Route::get('avatar/edit/{id}', [HomeController::class, 'editAvatar'])->name('avatar.edit');
Route::patch('avatar/edit/{id}', [HomeController::class, 'updateAvatar'])->name('avatar.update');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::resource('account', AccountController::class);
    Route::patch('account/password/change/{id}', [AccountController::class, 'changePassword'])->name('account.password');
    Route::resource('room', RoomController::class)->except(['create', 'show']);
    Route::resource('department', DepartmentController::class)->except(['create']);
});