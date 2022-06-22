<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MeetingManagementController;
use App\Http\Controllers\MeetingScheduleController;
use App\Http\Controllers\RegistrationApprovalController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomRegistrationController;
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
Route::resource('register', RoomRegistrationController::class);
Route::get('schedule', [MeetingScheduleController::class, 'index'])->name('schedule.index');
Route::get('document', [HomeController::class, 'listDocument'])->name('document.list');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function(){
    Route::resource('account', AccountController::class);
    Route::patch('account/password/change/{id}', [AccountController::class, 'changePassword'])->name('account.password');
    Route::resource('room', RoomController::class)->except(['create', 'show']);
    Route::resource('department', DepartmentController::class)->except(['create']);
    Route::get('meeting', [MeetingManagementController::class, 'index'])->name('meeting.index');
    Route::get('meeting/show/{id}', [MeetingManagementController::class, 'show'])->name('meeting.show');
});

Route::group(['prefix' => 'leader', 'middleware' => ['auth', 'isLeader']], function(){
    Route::group(['prefix' => 'approval'], function(){
        Route::get('/', [RegistrationApprovalController::class, 'index'])->name('approval.index');
        Route::patch('accept/{id}', [RegistrationApprovalController::class, 'accept'])->name('approval.accept');
        Route::patch('deny/{id}', [RegistrationApprovalController::class, 'deny'])->name('approval.deny');
    });
    
});