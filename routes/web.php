<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::put('/profile/{id}', [HomeController::class, 'update_profile'])->name('profile.update');
Route::delete('/delete-avatar/{id}', [HomeController::class, 'deleteAvatar'])->name('delete.avatar'); 
