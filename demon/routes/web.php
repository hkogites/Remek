<?php

use Illuminate\Support\Facades\Route;

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

// New trip detail pages
Route::view('/trip-olasz', 'pages.trip-olasz');
Route::redirect('/trip-olasz.html', '/trip-olasz', 301);

Route::view('/trip-mallorca', 'pages.trip-mallorca');
Route::redirect('/trip-mallorca.html', '/trip-mallorca', 301);

Route::view('/trip-norway', 'pages.trip-norway');
Route::redirect('/trip-norway.html', '/trip-norway', 301);

Route::view('/trip-turkey', 'pages.trip-turkey');
Route::redirect('/trip-turkey.html', '/trip-turkey', 301);

Route::view('/trip-prague', 'pages.trip-prague');
Route::redirect('/trip-prague.html', '/trip-prague', 301);

Route::view('/trip-lisbon', 'pages.trip-lisbon');
Route::redirect('/trip-lisbon.html', '/trip-lisbon', 301);
