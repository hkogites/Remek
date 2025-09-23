<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'pages.index');
Route::redirect('/index.html', '/', 301);
Route::view('/about', 'pages.about');
Route::redirect('/about.html', '/about', 301);
Route::view('/blog', 'pages.blog');
Route::redirect('/blog.html', '/blog', 301);
Route::view('/contact', 'pages.contact');
Route::redirect('/contact.html', '/contact', 301);
Route::view('/trips', 'pages.trips');
Route::redirect('/trips.html', '/trips', 301);
Route::view('/single', 'pages.single');
Route::redirect('/single.html', '/single', 301);
Route::view('/trip-single', 'pages.trip-single');
Route::redirect('/trip-single.html', '/trip-single', 301);

// Auth routes (Hungarian)
Route::get('/bejelentkezes', [AuthController::class, 'showLogin'])->name('login');
Route::post('/bejelentkezes', [AuthController::class, 'login']);
Route::get('/regisztracio', [AuthController::class, 'showRegister'])->name('register');
Route::post('/regisztracio', [AuthController::class, 'register']);
Route::post('/kijelentkezes', [AuthController::class, 'logout'])->name('logout');

// Profil (csak bejelentkezve)
Route::middleware('auth')->group(function () {
    Route::view('/profil', 'pages.profile')->name('profile');
});
