<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::put('/profile/{id}', [HomeController::class, 'update_profile'])->name('profile.update');
Route::delete('/delete-avatar/{id}', [HomeController::class, 'deleteAvatar'])->name('delete.avatar'); 


Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');