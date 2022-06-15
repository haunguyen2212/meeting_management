<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'check'])->name('login.check');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::patch('change_password', [HomeController::class, 'changePassword'])->name('password.change');
Route::get('profile_edit/{id}', [HomeController::class, 'editProfile'])->name('profile.edit');
Route::patch('profile_edit/{id}', [HomeController::class, 'updateProfile'])->name('profile.update');
Route::get('avatar_edit/{id}', [HomeController::class, 'editAvatar'])->name('avatar.edit');
Route::patch('avatar_edit/{id}', [HomeController::class, 'updateAvatar'])->name('avatar.update');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::resource('account', AccountController::class);
});