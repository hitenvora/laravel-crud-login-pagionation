<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});


Route::post('/index', [CrudController::class, 'index'])->name('index');
Route::post('/insert', [CrudController::class, 'insert'])->name('insert');
Route::get('/get_crud/{id}', [CrudController::class, 'get_crud'])->name('get_crud');
Route::post('/delete', [CrudController::class, 'delete'])->name('delete');
