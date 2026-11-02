<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckUser;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register')->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->name('store.register')->middleware('guest');

Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login')->middleware(middleware:'guest');
Route::post('login', [AuthController::class, 'login'])->name('store.login')->middleware(middleware:'guest');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/user', [UserController::class, 'showUser'])->name('show.user')->middleware('auth',CheckUser::class);
Route::get('/user/create', [UserController::class, 'showCreateApp'])->name('show.createApp')->middleware('auth',CheckUser::class);
Route::post('/user/create', [UserController::class, 'storeCreateApp'])->name('store.createApp')->middleware('auth',CheckUser::class);
  
Route::get('/admin', [AdminController::class, 'showAdmin'])->name('show.admin')->middleware('auth',CheckAdmin::class);

Route::get('/manager', [ManagerController::class, 'showManager'])->name('show.manager');