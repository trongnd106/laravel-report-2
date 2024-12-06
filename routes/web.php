<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [UserController::class, 'home']);

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');  
Route::get('/user', [UserController::class, 'getAll'])->name('user.index'); 

Route::get('/user/{id}/detail', [UserController::class, 'getDetail'])->name('user.edit');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');