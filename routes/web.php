<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TripsController;
use App\Http\Controllers\TripDetailController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Middleware\AdminMiddleware;

Route::view('/', 'pages.index');
Route::redirect('/index.html', '/', 301);
Route::view('/about', 'pages.about');
Route::redirect('/about.html', '/about', 301);
Route::view('/blog', 'pages.blog');
Route::redirect('/blog.html', '/blog', 301);
Route::view('/contact', 'pages.contact');
Route::redirect('/contact.html', '/contact', 301);
Route::get('/trips', [TripsController::class, 'index']);
Route::redirect('/trips.html', '/trips', 301);
Route::view('/single', 'pages.single');
Route::redirect('/single.html', '/single', 301);
Route::view('/trip-single', 'pages.trip-single');
Route::redirect('/trip-single.html', '/trip-single', 301);

// Extra trip detail pages
// Dynamic detail page by slug
Route::get('/trip/{slug}', [TripDetailController::class, 'show'])->name('trip.show');

// Back-compat redirects from previous static endpoints to dynamic route
Route::redirect('/trip-olasz', '/trip/trip-olasz', 301);
Route::redirect('/trip-olasz.html', '/trip/trip-olasz', 301);
Route::redirect('/trip-mallorca', '/trip/trip-mallorca', 301);
Route::redirect('/trip-mallorca.html', '/trip/trip-mallorca', 301);
Route::redirect('/trip-norway', '/trip/trip-norway', 301);
Route::redirect('/trip-norway.html', '/trip/trip-norway', 301);
Route::redirect('/trip-turkey', '/trip/trip-turkey', 301);
Route::redirect('/trip-turkey.html', '/trip/trip-turkey', 301);
Route::redirect('/trip-prague', '/trip/trip-prague', 301);
Route::redirect('/trip-prague.html', '/trip/trip-prague', 301);
Route::redirect('/trip-lisbon', '/trip/trip-lisbon', 301);
Route::redirect('/trip-lisbon.html', '/trip/trip-lisbon', 301);

// Auth routes (Hungarian)
Route::get('/bejelentkezes', [AuthController::class, 'showLogin'])->name('login');
Route::post('/bejelentkezes', [AuthController::class, 'login']);
Route::get('/regisztracio', [AuthController::class, 'showRegister'])->name('register');
Route::post('/regisztracio', [AuthController::class, 'register']);
Route::post('/kijelentkezes', [AuthController::class, 'logout'])->name('logout');

// Profile (auth only)
Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'show'])->name('profile');

    // Reservations
    Route::get('/trip/{slug}/reserve', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/trip/{slug}/reserve', [ReservationController::class, 'store'])->name('reservations.store');
});

// Contact form submit
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Admin routes (auth + admin only)
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::redirect('/', '/admin/destinations', 302)->name('home');
        Route::resource('destinations', AdminDestinationController::class)->except(['show']);
    });
