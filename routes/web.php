<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OgController;

Route::get('/', HomeController::class)->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Studio informational pages
Route::view('/photography-studio', 'pages.photography')->name('pages.photography');
Route::view('/videography-studio', 'pages.videography')->name('pages.videography');
Route::view('/podcast-studio', 'pages.podcast')->name('pages.podcast');
Route::view('/edit-room', 'pages.edit-room')->name('pages.edit-room');

Route::view('/services', 'pages.services')->name('pages.services');
Route::view('/pricing', 'pages.pricing')->name('pages.pricing');
Route::view('/about', 'pages.about')->name('pages.about');
Route::view('/contact', 'pages.contact')->name('pages.contact');
Route::view('/gallery', 'pages.gallery')->name('pages.gallery');

Route::view('/help', 'pages.help')->name('pages.help');
Route::view('/booking', 'pages.booking')->name('pages.booking');
Route::view('/location', 'pages.location')->name('pages.location');

Route::view('/studio-specs', 'pages.studio-specs')->name('pages.studio-specs');
Route::view('/use-cases', 'pages.use-cases')->name('pages.use-cases');
Route::view('/collaborations', 'pages.collaborations')->name('pages.collaborations');

// Legal & policy pages
Route::view('/terms-and-conditions', 'pages.terms')->name('pages.terms');
Route::view('/privacy-policy', 'pages.privacy')->name('pages.privacy');
Route::view('/accessibility', 'pages.accessibility')->name('pages.accessibility');
Route::view('/studio-rules', 'pages.studio-rules')->name('pages.studio-rules');
Route::view('/cancellation-policy', 'pages.cancellation')->name('pages.cancellation');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

// Dynamic OG image (SVG)
Route::get('/og', [OgController::class, 'image'])->name('og.image');
