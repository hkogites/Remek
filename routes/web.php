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
