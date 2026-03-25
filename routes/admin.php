<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PageController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/our-work', [DashboardController::class, 'ourWork'])->name('dashboard.our-work.index');
        Route::post('/dashboard/our-work', [DashboardController::class, 'updateOurWork'])->name('dashboard.our-work.update');
        Route::delete('/dashboard/our-work/images/{image}', [DashboardController::class, 'deleteOurWorkImage'])->name('dashboard.our-work.images.destroy');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        Route::resource('users', AdminUserController::class)->except(['show']);
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('posts', PostController::class)->except(['show']);
        Route::resource('pages', PageController::class)->except(['show']);
    });

});
